<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Ahmad Fathoni',
                'email' => 'ahmad@gemail.com',
            ],
            [
                'name' => 'Abid Ghani',
                'email' => 'Abid@gemail.com',
            ],
            [
                'name' => 'Aabu Bakar',
                'email' => 'Abu@gemail.com',
            ],
            [
                'name' => 'Ratu Carmenita',
                'email' => 'ratu@gemail.com',
            ],
            [
                'name' => 'Ilham Antonika',
                'email' => 'hom123@gemail.com',
            ],
            [
                'name' => 'Fayyad Hudzaqi',
                'email' => 'fayyad@gemail.com',
            ],
        ];

        foreach ($members as $member) {
            User::updateOrCreate(
                ['email' => $member['email']],
                [
                    'name' => $member['name'],
                    'password' => Hash::make('password123'),
                ]
            );
        }
    }
}
