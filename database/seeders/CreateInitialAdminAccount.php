<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateInitialAdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::unguard();

        User::create([
            'email' => "tranhuy105@admin.com",
            'password' => "12345678",
            'first_name' => "Huy",
            'last_name' => "Tran",
            'username' => "admin",
            'name' => "admin",
            'is_active' => true,
            'is_admin' => true,
        ]);
    }
}
