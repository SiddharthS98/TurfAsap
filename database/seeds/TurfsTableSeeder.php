<?php

use App\Model\Turf;
use Illuminate\Database\Seeder;

class TurfsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Turf::class, 50)->create();
    }
}
