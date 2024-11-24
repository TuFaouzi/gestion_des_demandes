<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Seeder;

class CreateTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Deleted'],
                'default' => 'Active',
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
        $this->forge->createTable('types');

        $seeder = \Config\Database::seeder();
        $seeder->call('TypeSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('types');
    }
}
