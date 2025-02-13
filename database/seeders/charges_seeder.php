<?php

namespace Database\Seeders;

use App\Models\charges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class charges_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $charges = [
            ['typeID' => 1, 'name' => 'Ultra Sound', 'rate' => '500', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'ECG', 'rate' => '500', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'Urin RE', 'rate' => '300', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'Blood Glucose', 'rate' => '400', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'Lipit Profile', 'rate' => '500', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'HBA1C', 'rate' => '200', 'updatedBy' => 1],
            ['typeID' => 1, 'name' => 'CT Scan', 'rate' => '2000', 'updatedBy' => 1],
            ['typeID' => 2, 'name' => 'OPD Fee', 'rate' => '800', 'updatedBy' => 1],
            ['typeID' => 3, 'name' => 'Advance', 'rate' => '50000', 'updatedBy' => 1],
        ];

        charges::insert($charges);
    }
}
