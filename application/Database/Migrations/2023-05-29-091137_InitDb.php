<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Config\Database;

class InitDb extends Migration
{
    public function up()
    {
        // db `groups`
        $this->forge->addField([
            'id'   => ['type' => 'TINYINT', 'constraint' => 1, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 25],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('groups', true);

        // db `invoices`
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 10, 'auto_increment' => true],
            'date'     => ['type' => 'DATETIME'],
            'due_date' => ['type' => 'DATETIME'],
            'status'   => ['type' => 'ENUM', 'constraint' => ['paid', 'unpaid', 'canceled', 'expired']],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('invoices', true);

        // db `orders`
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 10, 'auto_increment' => true],
            'invoice_id'   => ['type' => 'INT', 'constraint' => 10],
            'product_id'   => ['type' => 'INT', 'constraint' => 10],
            'product_name' => ['type' => 'VARCHAR', 'constraint' => 50],
            'qty'          => ['type' => 'INT', 'constraint' => 3],
            'price'        => ['type' => 'INT', 'constraint' => 9],
            'options'      => ['type' => 'TEXT'],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('orders', true);

        // db `products`
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 10, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 50],
            'description' => ['type' => 'TEXT'],
            'price'       => ['type' => 'INT', 'constraint' => 9],
            'stock'       => ['type' => 'INT', 'constraint' => 3],
            'image'       => ['type' => 'TEXT'],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('products', true);

        // db `toko_sessions`
        $this->forge->addField([
            'session_id'    => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => '0'],
            'ip_address'    => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => '0'],
            'user_agent'    => ['type' => 'VARCHAR', 'constraint' => 120],
            'last_activity' => ['type' => 'INT', 'constraint' => 10, 'default' => '0', 'unsigned' => true],
            'user_data'     => ['type' => 'TEXT'],
        ]);

        $this->forge->addPrimaryKey('session_id');
        $this->forge->addKey('last_activity', false, false, 'last_activity_idx');
        $this->forge->createTable('toko_sessions', true);

        // db `users`
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 10, 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 25],
            'password' => ['type' => 'VARCHAR', 'constraint' => 60],
            'group'    => ['type' => 'TINYINT', 'constraint' => 1],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users', true);

        // seeder
        $seeder = Database::seeder();
        $seeder->call('InitDb');
    }

    public function down()
    {
        $this->forge->dropTable('groups');
        $this->forge->dropTable('invoices');
        $this->forge->dropTable('orders');
        $this->forge->dropTable('products');
        $this->forge->dropTable('toko_sessions');
        $this->forge->dropTable('users');
    }
}
