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
                'name' => 'isUser',
            ],
            [
                'id' => '2',
                'name' => 'isAdmin',
            ]
        ];
        foreach($role as $key => $value){
            Role::create($value);
        }
    }
}
