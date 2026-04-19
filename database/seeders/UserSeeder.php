<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Fuad',
                'username' => 'kepsek',
                'role'     => UserRole::KEPALA_SEKOLAH,
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Rahma',
                'username' => 'waka_kurikulum',
                'role'     => UserRole::WAKA,
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Hambali',
                'username' => 'waka_kesiswaan',
                'role'     => UserRole::WAKA,
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'Ratna',
                'username' => 'katu',
                'role'     => UserRole::KEPALA_TU,
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'TU1',
                'username' => 'tu1',
                'role'     => UserRole::TU,
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
