<?php

namespace App\Console\Commands;

use App\Models\StudentApplication;
use App\Models\User;
use Illuminate\Console\Command;

class CreateDefaultDossiers extends Command
{
    protected $signature   = 'dossier:create-defaults {--dry-run : Simulate without writing}';
    protected $description = 'Create a default complementary dossier for every user who does not have one';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $users = User::all();
        $this->info("Checking {$users->count()} user(s)...");

        $created = 0;
        $skipped = 0;

        foreach ($users as $user) {
            $exists = StudentApplication::where('student_email', $user->email)->exists();

            if ($exists) {
                $this->line("  <fg=gray>SKIP</> {$user->email} — dossier already exists");
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->line("  <fg=yellow>WOULD CREATE</> {$user->email}");
                $created++;
                continue;
            }

            try {
                $app = StudentApplication::create([
                    'student_name'         => $user->name,
                    'student_email'        => $user->email,
                    'dossier_type'         => 'complementaire',
                    'status'               => 'pending',
                    'complementary_status' => 'in_progress',
                    'current_step'         => 2,
                    'program_type'         => 'license',
                ]);
                $app->generateAccessToken(365);

                $this->line("  <fg=green>CREATED</> {$user->email} (application #{$app->id})");
                $created++;
            } catch (\Exception $e) {
                $this->error("  FAILED {$user->email}: {$e->getMessage()}");
            }
        }

        $this->newLine();

        if ($dryRun) {
            $this->warn("DRY RUN — no changes written. Would create {$created} dossier(s), skip {$skipped}.");
        } else {
            $this->info("Done — created: {$created} | skipped (already have dossier): {$skipped}.");
        }

        return self::SUCCESS;
    }
}
