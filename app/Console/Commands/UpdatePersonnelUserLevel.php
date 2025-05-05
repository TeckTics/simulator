<?php

namespace App\Console\Commands;

use App\Models\Personnel_formation;
use App\Models\Personnel_user;
use Illuminate\Console\Command;

class UpdatePersonnelUserLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-personnel-user-level';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met à jour le niveau des utilisateurs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Récupérer les utilisateurs (vous pouvez adapter la requête selon vos besoins)
        $users = Personnel_user::where('delete', null)->all();

        foreach ($users as $user) {
            $formation = Personnel_formation::where('personnel_user_id', $user->id)->first();
            if ($formation) {
                $user->niveau = $formation->niveau;
                $user->save();
            }

            $this->info("Niveau de l'utilisateur {$user->id} mis à jour à {$user->niveau}");
        }

        $this->info('Mise à jour des niveaux terminée.');
    }
}
