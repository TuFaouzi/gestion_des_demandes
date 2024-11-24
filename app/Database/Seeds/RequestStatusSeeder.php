<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestStatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['label' => 'Waiting'],
            ['label' => 'Forwarded'],
            ['label' => 'Validated'],
            ['label' => 'DeclinedByManager'],
            ['label' => 'DeclinedByBoss'],
            ['label' => 'Deleted'],
        ];

        $this->db->table('request_statuses')->insertBatch($data);

        foreach ($data as $status) {
            $exists = $this->db->table('request_statuses')
                ->where('label', $status['label'])
                ->countAllResults();

            if ($exists == 0) {
                $this->db->table('request_statuses')->insert($status);
            }
        }
    }
}
