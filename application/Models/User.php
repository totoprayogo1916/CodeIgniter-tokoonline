<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'password',
        'group',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function check_credential()
    {
        $username = set_value('username');
        $password = set_value('password');

        $hasil = $this->db->where('username', $username)
            ->where('password', $password)
            ->limit(1)
            ->get('users');

        if ($hasil->num_rows() > 0) {
            return $hasil->row();
        }

        return [];
    }
}
