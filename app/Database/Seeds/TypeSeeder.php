<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['label' => 'Vacation', 'status' => 'Active'],
            ['label' => 'Sick Leave', 'status' => 'Active'],
            ['label' => 'Other', 'status' => 'Active'],
        ];

        $this->db->table('types')->insertBatch($data);

        foreach ($data as $type) {
            $exists = $this->db->table('types')
                ->where('label', $type['label'])
                ->countAllResults();

            if ($exists == 0) {
                $this->db->table('types')->insert($type);
            }
        }

    }
}
