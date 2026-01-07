<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'make:admin';
    protected $description = 'Buat admin baru untuk login';

    public function handle()
    {
        $this->info('===========================================');
        $this->info('         BUAT ADMIN BARU');
        $this->info('===========================================');
        
        $name = $this->ask('Nama Admin');
        $email = $this->ask('Email Admin');
        $password = $this->secret('Password (min 6 karakter)');
        $passwordConfirm = $this->secret('Konfirmasi Password');

        // Validasi
        if ($password !== $passwordConfirm) {
            $this->error('Password tidak sama!');
            return 1;
        }

        if (strlen($password) < 6) {
            $this->error('Password minimal 6 karakter!');
            return 1;
        }

        if (Admin::where('email', $email)->exists()) {
            $this->error('Email sudah terdaftar!');
            return 1;
        }

        // Buat admin
        $admin = Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('');
        $this->info('✅ Admin berhasil dibuat!');
        $this->info('');
        $this->table(
            ['ID', 'Nama', 'Email'],
            [[$admin->id, $admin->name, $admin->email]]
        );
        $this->info('');
        
        
        return 0;
    }
}