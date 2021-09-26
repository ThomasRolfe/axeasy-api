<?php

namespace Database\Seeders;

use App\Models\Earnable\Earnable;
use Illuminate\Database\Seeder;

class EarnablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $earnables = [
            'SLP',
            'AXS',
            'LAND'
        ];

        foreach ($earnables as $earnable) {
            Earnable::create(['label' => $earnable]);
        }
    }
}
