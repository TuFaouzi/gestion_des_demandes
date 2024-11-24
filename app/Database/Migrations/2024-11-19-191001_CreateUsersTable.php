<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'firstName' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'lastName' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'phoneNumber' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['Admin', 'Boss', 'Manager', 'Employee'],
                'default'    => 'Employee',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // Add default user
        $this->db->table('users')->insert([
            'firstName'   => 'Admin',
            'lastName'    => 'User',
            'phoneNumber' => '0000000000',
            'email'       => 'admin@gmail.com',
            'password'    => password_hash('admin', PASSWORD_DEFAULT),
            'role'        => 'Admin',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'firstName'   => 'Boss',
            'lastName'    => 'Boss',
            'phoneNumber' => '0000000001',
            'email'       => 'boss@gmail.com',
            'password'    => password_hash('azerty', PASSWORD_DEFAULT),
            'role'        => 'Boss',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'firstName'   => 'Manager 1',
            'lastName'    => 'Manager 1',
            'phoneNumber' => '0000000002',
            'email'       => 'manager1@gmail.com',
            'password'    => password_hash('azerty', PASSWORD_DEFAULT),
            'role'        => 'Manager',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'firstName'   => 'Manager 2',
            'lastName'    => 'Manager 2',
            'phoneNumber' => '0000000003',
            'email'       => 'manager2@gmail.com',
            'password'    => password_hash('azerty', PASSWORD_DEFAULT),
            'role'        => 'Manager',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'firstName'   => 'Employee 1',
            'lastName'    => 'Employee 1',
            'phoneNumber' => '0000000004',
            'email'       => 'employee1@gmail.com',
            'password'    => password_hash('azerty', PASSWORD_DEFAULT),
            'role'        => 'Employee',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('users')->insert([
            'firstName'   => 'Employee 2',
            'lastName'    => 'Employee 2',
            'phoneNumber' => '0000000005',
            'email'       => 'employee2@gmail.com',
            'password'    => password_hash('azerty', PASSWORD_DEFAULT),
            'role'        => 'Employee',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
