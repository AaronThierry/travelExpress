<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Token expiration time in minutes
     */
    private const TOKEN_EXPIRATION_MINUTES = 60;

    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Return success even if user not found (security best practice)
            return response()->json([
                'success' => true,
                'message' => 'Si cette adresse existe, un e-mail de réinitialisation a été envoyé.',
            ], 200);
        }

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Generate new token
        $token = Str::random(64);

        // Store token in database
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // Send email
        $resetUrl = url('/reset-password?token=' . $token . '&email=' . urlencode($request->email));

        try {
            Mail::send('emails.password-reset', [
                'user' => $user,
                'resetUrl' => $resetUrl,
                'expirationMinutes' => self::TOKEN_EXPIRATION_MINUTES,
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Réinitialisation de votre mot de passe - Travel Express');
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de l\'e-mail. Veuillez réessayer.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Si cette adresse existe, un e-mail de réinitialisation a été envoyé.',
        ], 200);
    }

    /**
     * Reset password with token
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'token.required' => 'Le token est requis.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        // Find the token record
        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Ce lien de réinitialisation est invalide.',
            ], 400);
        }

        // Check if token matches
        if (!Hash::check($request->token, $tokenRecord->token)) {
            return response()->json([
                'success' => false,
                'message' => 'Ce lien de réinitialisation est invalide.',
            ], 400);
        }

        // Check if token is expired
        $tokenCreatedAt = Carbon::parse($tokenRecord->created_at);
        if ($tokenCreatedAt->addMinutes(self::TOKEN_EXPIRATION_MINUTES)->isPast()) {
            // Delete expired token
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return response()->json([
                'success' => false,
                'message' => 'Ce lien de réinitialisation a expiré. Veuillez en demander un nouveau.',
            ], 400);
        }

        // Find user and update password
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé.',
            ], 404);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Revoke all tokens (logout from all devices)
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.',
        ], 200);
    }

    /**
     * Verify token validity
     */
    public function verifyToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        $tokenRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenRecord) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Ce lien de réinitialisation est invalide.',
            ], 400);
        }

        if (!Hash::check($request->token, $tokenRecord->token)) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Ce lien de réinitialisation est invalide.',
            ], 400);
        }

        $tokenCreatedAt = Carbon::parse($tokenRecord->created_at);
        if ($tokenCreatedAt->addMinutes(self::TOKEN_EXPIRATION_MINUTES)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Ce lien de réinitialisation a expiré.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'valid' => true,
            'message' => 'Token valide.',
        ], 200);
    }
}
