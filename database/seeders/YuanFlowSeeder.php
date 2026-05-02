<?php

namespace Database\Seeders;

use App\Models\YuanFlow\ExchangeRate;
use App\Models\YuanFlow\TransactionFee;
use App\Models\YuanFlow\YfNotification;
use App\Models\YuanFlow\YfRecipient;
use App\Models\YuanFlow\YfTransaction;
use App\Models\YuanFlow\YfUser;
use App\Models\YuanFlow\YfWallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class YuanFlowSeeder extends Seeder
{
    public function run(): void
    {
        // ── Taux de change ────────────────────────────────────────────────────
        $rates = [
            ['rate' => 0.01215, 'change_percentage' => 0.85,  'trend' => 'up',   'valid_from' => now()->subHours(24)],
            ['rate' => 0.01208, 'change_percentage' => -0.22, 'trend' => 'down', 'valid_from' => now()->subHours(18)],
            ['rate' => 0.01219, 'change_percentage' => 0.91,  'trend' => 'up',   'valid_from' => now()->subHours(12)],
            ['rate' => 0.01222, 'change_percentage' => 0.25,  'trend' => 'up',   'valid_from' => now()->subHours(6)],
            ['rate' => 0.01225, 'change_percentage' => 0.25,  'trend' => 'up',   'valid_from' => now()->subHour()],
        ];

        foreach ($rates as $rateData) {
            ExchangeRate::create(array_merge($rateData, [
                'from_currency' => 'XOF',
                'to_currency'   => 'CNY',
                'valid_until'   => now()->addHours(6),
                'source'        => 'manual',
                'is_active'     => true,
            ]));
        }

        // ── Frais de transaction ──────────────────────────────────────────────
        if (TransactionFee::count() === 0) {
            TransactionFee::insert([
                ['min_amount' => 0,       'max_amount' => 50000,   'fee_type' => 'fixed',      'fixed_fee' => 500,  'percentage_fee' => 0,   'created_at' => now(), 'updated_at' => now()],
                ['min_amount' => 50001,   'max_amount' => 200000,  'fee_type' => 'percentage', 'fixed_fee' => 0,    'percentage_fee' => 1.0, 'created_at' => now(), 'updated_at' => now()],
                ['min_amount' => 200001,  'max_amount' => 500000,  'fee_type' => 'percentage', 'fixed_fee' => 0,    'percentage_fee' => 0.8, 'created_at' => now(), 'updated_at' => now()],
                ['min_amount' => 500001,  'max_amount' => 1000000, 'fee_type' => 'percentage', 'fixed_fee' => 0,    'percentage_fee' => 0.6, 'created_at' => now(), 'updated_at' => now()],
                ['min_amount' => 1000001, 'max_amount' => null,    'fee_type' => 'percentage', 'fixed_fee' => 0,    'percentage_fee' => 0.5, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // ── Utilisateur de test ───────────────────────────────────────────────
        $user = YfUser::firstOrCreate(
            ['phone' => '+2210700000001'],
            [
                'country_code'      => '+221',
                'first_name'        => 'Amadou',
                'last_name'         => 'Diallo',
                'email'             => 'test@yuanflow.app',
                'pin_hash'          => Hash::make('1234'),
                'status'            => 'active',
                'kyc_status'        => 'verified',
                'phone_verified_at' => now(),
                'country'           => 'SN',
                'is_profile_complete' => true,
            ]
        );

        // ── Portefeuille ──────────────────────────────────────────────────────
        YfWallet::firstOrCreate(
            ['yf_user_id' => $user->id],
            [
                'balance_xof' => 150000,
                'balance_cny' => 0,
            ]
        );

        // ── Destinataires ─────────────────────────────────────────────────────
        YfRecipient::firstOrCreate(
            ['yf_user_id' => $user->id, 'alipay_id' => 'zhang.wei@alipay'],
            [
                'name'           => 'Zhang Wei',
                'payment_method' => 'alipay',
                'is_favorite'    => true,
                'last_used'      => now()->subDays(3),
            ]
        );

        YfRecipient::firstOrCreate(
            ['yf_user_id' => $user->id, 'wechat_id' => 'li_xiao_2024'],
            [
                'name'           => 'Li Xiao',
                'payment_method' => 'wechat',
                'is_favorite'    => false,
                'last_used'      => now()->subWeek(),
            ]
        );

        // ── Transaction d'exemple ─────────────────────────────────────────────
        $recipient = YfRecipient::where('yf_user_id', $user->id)->first();

        YfTransaction::firstOrCreate(
            ['transaction_ref' => 'YF-TEST-000001'],
            [
                'yf_user_id'      => $user->id,
                'yf_recipient_id' => $recipient->id,
                'send_amount'    => 50000,
                'receive_amount' => 612.50,
                'exchange_rate'  => 0.01225,
                'transfer_fee'   => 500,
                'total_amount'   => 50500,
                'payment_method' => 'alipay',
                'status'         => 'completed',
                'payment_completed_at' => now()->subDays(5),
                'payout_completed_at'  => now()->subDays(5)->addMinutes(15),
            ]
        );

        // ── Notifications ─────────────────────────────────────────────────────
        YfNotification::firstOrCreate(
            ['yf_user_id' => $user->id, 'type' => 'welcome'],
            [
                'title'   => 'Bienvenue sur YuanFlow !',
                'message' => 'Votre compte est prêt. Transférez en toute sécurité vers la Chine.',
                'data'    => [],
                'read_at' => null,
            ]
        );

        $this->command->info('YuanFlow seeder terminé.');
    }
}
