<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Alexis TH',
            'phone' => '2461765663',
            'email' => 'alexistenorio1230@gmail.com',
            'profile' => 'ADMIN',
            'status' => 'ACTIVO',
            'password' => bcrypt('123')
        ]);

        User::create([
            'name' => 'Ruby',
            'phone' => '2461235663',
            'email' => 'ruby.fir@gmail.com',
            'profile' => 'EMPLEADO',
            'status' => 'ACTIVO',
            'password' => bcrypt('123')
        ]);
    }
}
