<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\Seeder;

class CreateRequestStatusesTable extends Migration
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
                'type' => 'ENUM',
                'constraint' => ['Waiting', 'Forwarded', 'Validated', 'DeclinedByManager', 'DeclinedByBoss', 'Deleted'],
                'unique' => true,
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
        $this->forge->createTable('request_statuses');

        $seeder = \Config\Database::seeder();
        $seeder->call('RequestStatusSeeder');
    }

    public function down()
    {
        $this->forge->dropTable('request_statuses');
    }
}
