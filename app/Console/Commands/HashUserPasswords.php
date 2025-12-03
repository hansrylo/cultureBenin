<?php

namespace App\Console\Commands;

use App\Models\Utilisateur;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash all plain text passwords in the utilisateurs table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Hashing plain text passwords...');

        $users = Utilisateur::all();
        $updated = 0;

        foreach ($users as $user) {
            // Vérifier si le mot de passe n'est pas déjà hashé
            // Les mots de passe Bcrypt commencent toujours par "$2y$"
            if (!str_starts_with($user->mot_de_passe, '$2y$')) {
                $plainPassword = $user->mot_de_passe;
                $user->mot_de_passe = Hash::make($plainPassword);
                $user->save();
                
                $this->line("✓ Hashed password for user: {$user->email}");
                $updated++;
            }
        }

        $this->info("Done! {$updated} password(s) hashed.");
        
        if ($updated > 0) {
            $this->warn('IMPORTANT: Make sure to remember your passwords. The plain text passwords have been replaced with hashed versions.');
        }

        return 0;
    }
}
