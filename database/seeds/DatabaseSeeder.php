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

        DB::table('squares')->delete();
        DB::table('cities')->delete();

        $city = City::create(array('name' => 'Poissy'));

        $this->command->info('Ville ok');

        $square = Square::create(
        	array(
        		'name' => 'Square Des Frères Rose',
        		'lat' => 12345,
        		'lng' => 12345,
        		'city_id' =>  $city->id
        	)
        );

        $this->command->info('Square ok');

    }
}
