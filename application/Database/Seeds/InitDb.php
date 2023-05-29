<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitDb extends Seeder
{
    public function run()
    {
        $builderGroups = $this->db->table('groups');

        $builderGroups->insertBatch([
            ['id' => '1', 'name' => 'Admin'],
            ['id' => '2', 'name' => 'Member'],
        ]);

        $builderUsers = $this->db->table('users');

        $builderUsers->insertBatch([
            ['username' => 'admin', 'password' => 'admin', 'group' => '1'],
            ['username' => 'bob', 'password' => '123', 'group' => '2'],
        ]);
    }
}
