<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'id' => '1',
                'name' => 'Super Admin',
            ],
            [
                'id' => '2',
                'name' => 'Admin',
            ],
            [
                'id' => '3',
                'name' => 'Staff',
            ]
        ];
        foreach($role as $key => $value){
            Role::create($value);
        }
    }
}
