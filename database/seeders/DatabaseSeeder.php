<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RefJenisSeeder::class,
            StatusSeeder::class,
            RefAkarSeeder::class,
            RefKondisiSeeder::class,
            RefTajukSeeder::class,
            RefAduanSeeder::class,
        ]);
    }
}
