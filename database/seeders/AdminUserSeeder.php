<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email','admin@foodrescue.com')->first();

        if($user) {
            $user->role = 'admin';
            $user->save();

            return;
        }

        User::create([
            'name'=>'Admin',
            'email'=>'admin@foodrescue.com',
            'password'=>Hash::make('Admin@12345'),
            'role' => 'admin',
        ]);
    }
}