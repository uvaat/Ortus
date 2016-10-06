<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Square;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('equipments_squares')->delete();
        DB::table('equipments')->delete();
        DB::table('equipment_types')->delete();
        DB::table('squares')->delete();
        DB::table('cities')->delete();

        $city = City::create(array('name' => 'Poissy'));

        $this->command->info('Ville ok');

        $this->command->info('Square ok');

    }
}
