<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug','admin')->first();
        User::factory(1)->create([
            'name' => 'Hannan',
            'email' => 'hannan@admin.com',
            'password' => bcrypt('adgjmp420'),
            'role_id' => $adminRole->id
        ]);
    }
}
