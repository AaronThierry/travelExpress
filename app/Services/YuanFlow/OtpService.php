<?php

namespace App\Services\YuanFlow;

use App\Models\YuanFlow\OtpCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    const EXPIRY_MINUTES  = 5;
    const MAX_PER_WINDOW  = 30;
    const WINDOW_MINUTES  = 5;
    const MAX_ATTEMPTS    = 3;

    /**
     * Générer et envoyer un OTP
     */
    public function send(string $type, string $value, string $otpType = 'login'): array
    {
        $identifier = $this->normalize($type, $value);

        // Rate limiting
        $recent = OtpCode::where('phone', $identifier)
            ->where('created_at', '>', now()->subMinutes(self::WINDOW_MINUTES))
            ->count();

        if ($recent >= self::MAX_PER_WINDOW) {
            return [
                'success' => false,
                'code'    => 'OTP_RATE_LIMIT',
                'message' => 'Trop de tentatives. Réessayez dans ' . self::WINDOW_MINUTES . ' minutes.',
            ];
        }

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpCode::create([
            'phone'      => $identifier,
            'code'       => $code,
            'type'       => $otpType,
            'expires_at' => now()->addMinutes(self::EXPIRY_MINUTES),
        ]);

        // Dispatch selon le canal
        if ($type === 'email') {
            $this->sendByEmail($value, $code);
        } else {
            $this->sendBySms($value, $code);
        }

        return [
            'success'    => true,
            'expires_in' => self::EXPIRY_MINUTES * 60,
            'debug_code' => config('app.debug') ? $code : null,
        ];
    }

    /**
     * Vérifier un OTP
     */
    public function verify(string $type, string $value, string $code, string $otpType = 'login'): array
    {
        $identifier = $this->normalize($type, $value);

        $otp = OtpCode::where('phone', $identifier)
            ->where('type', $otpType)
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otp) {
            return ['valid' => false, 'code' => 'INVALID_OTP', 'message' => 'Code OTP incorrect ou introuvable'];
        }

        if ($otp->isExpired()) {
            return ['valid' => false, 'code' => 'OTP_EXPIRED', 'message' => 'Code OTP expiré'];
        }

        if ($otp->attempts >= self::MAX_ATTEMPTS) {
            return ['valid' => false, 'code' => 'OTP_MAX_ATTEMPTS', 'message' => 'Trop de tentatives échouées'];
        }

        $otp->increment('attempts');

        if ($otp->code !== $code) {
            $remaining = self::MAX_ATTEMPTS - $otp->attempts;
            return [
                'valid'   => false,
                'code'    => 'INVALID_OTP',
                'message' => "Code OTP incorrect. Il vous reste $remaining tentative(s).",
            ];
        }

        $otp->update(['verified' => true, 'verified_at' => now()]);

        return ['valid' => true];
    }

    /**
     * Vérifier qu'un OTP a bien été validé récemment
     */
    public function wasVerified(string $type, string $value, string $otpType, int $withinMinutes = 10): bool
    {
        return OtpCode::where('phone', $this->normalize($type, $value))
            ->where('type', $otpType)
            ->where('verified', true)
            ->where('verified_at', '>', now()->subMinutes($withinMinutes))
            ->exists();
    }

    // ── Privé ──────────────────────────────────────────────────────────────────

    private function normalize(string $type, string $value): string
    {
        return $type === 'email' ? 'email:' . strtolower($value) : $value;
    }

    private function sendBySms(string $phone, string $code): void
    {
        // TODO: Intégrer Twilio / Orange SMS API
        Log::channel('single')->info("[YuanFlow OTP SMS] $phone → $code");
    }

    private function sendByEmail(string $email, string $code): void
    {
        Log::channel('single')->info("[YuanFlow OTP Email] $email → $code");

        Mail::raw(
            "Votre code de vérification YuanFlow : $code\n\nCe code est valable 5 minutes.\n\nSi vous n'avez pas demandé ce code, ignorez ce message.",
            function ($m) use ($email, $code) {
                $m->to($email)
                  ->subject("[$code] Code de vérification YuanFlow");
            }
        );
    }
}
