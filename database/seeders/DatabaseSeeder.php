<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $polis = [
            'Poli Umum',
            'Poli Gigi',
            'Poli KIA (Kesehatan Ibu dan Anak)',
            'Poli KB (Keluarga Berencana)',
            'Poli Lansia',
            'Poli Gizi'
        ];
        foreach ($polis as $poli) {
            Poli::create(
                ['nama_poli' => $poli]
            );
        }
        Role::create([
            'nama_role' => 'Admin'
        ]);
        User::create([
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asdasd'),
        ]);
    }
}
