<?php

namespace Database\Seeders;

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
        \DB::table('users')->truncate();
        ;
        \App\Models\User::factory(1)->create([
             'name' => 'Dev Geek',
             'email' => 'devgeek@gmail.com',
             'role_id' => 1,
         ]);
        $this->call(RoleSeeder::class);
    }
}
