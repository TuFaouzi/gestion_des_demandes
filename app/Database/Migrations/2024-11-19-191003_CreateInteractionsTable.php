<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInteractionsTable extends Migration
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
            'comment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'request_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addForeignKey('status_id', 'request_statuses', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('request_id', 'requests', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('interactions');
    }

    public function down()
    {
        $this->forge->dropTable('interactions');
    }
}
