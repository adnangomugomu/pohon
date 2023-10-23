<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id' => Uuid::uuid4()->toString(),
                    'role_id' => 1,
                    'name' => 'Akun Admin',
                    'username' => 'akun_admin',
                    'kode_prop' => '35',
                    'kode_kab' => '3521',
                    'kode_kec' => '352103',
                    'kode_kel' => '3521032010',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'id' => Uuid::uuid4()->toString(),
                    'role_id' => 2,
                    'name' => 'Akun Operator',
                    'username' => 'akun_operator',
                    'kode_prop' => '35',
                    'kode_kab' => '3521',
                    'kode_kec' => '352103',
                    'kode_kel' => '3521032009',
                    'email' => 'operator@gmail.com',
                    'password' => Hash::make('operator123'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
