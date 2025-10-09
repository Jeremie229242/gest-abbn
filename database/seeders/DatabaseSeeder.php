<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\User::factory(3)->create();

      //   $this->call(CarburationTableSeeder::class);
         $this->call(RoleTableSeeder::class);

        $this->call(PermissionTableSeeder::class);

        \App\Models\User::find(1)->roles()->attach(1);


        \App\Models\User::find(1)->permissions()->attach(1);
        \App\Models\User::find(2)->permissions()->attach(2);
    }

}
