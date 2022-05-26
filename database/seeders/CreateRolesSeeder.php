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
                'name' => 'BAAK',
            ],
            [
                'id' => '3',
                'name' => 'Dekan',
            ],
            [
                'id' => '4',
                'name' => 'Wakil Dekan 3',
            ],
            [
                'id' => '5',
                'name' => 'Pembimbing',
            ],
            [
                'id' => '6',
                'name' => 'Badan Legislatif Mahasiswa',
            ],
            [
                'id' => '7',
                'name' => 'Badan Eksekutif Mahasiswa',
            ],
            [
                'id' => '8',
                'name' => 'Unit Kegiatan Mahasiswa',
            ]
        ];
        foreach($role as $key => $value){
            Role::create($value);
        }
    }
}
