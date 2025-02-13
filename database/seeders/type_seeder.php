<?php

namespace Database\Seeders;

use App\Models\receipt_type;
use Illuminate\Database\Seeder;

class type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['type' => 'Diagnostics Charges', 'updatedBy' => 1], 
            ['type' => 'Consultation Fee', 'updatedBy' => 1], 
            ['type' => 'Advance Deposit', 'updatedBy' => 1], 
            ['type' => 'Operation Charges', 'updatedBy' => 1], 
            ['type' => 'OutDoor Proceedure Charges', 'updatedBy' => 1]
        ];
        receipt_type::insert($types);
    }
}
