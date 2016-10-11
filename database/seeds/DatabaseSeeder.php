<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();
        DB::table('equipments_squares')->delete();
        DB::table('equipments')->delete();
        DB::table('equipment_types')->delete();
        DB::table('squares')->delete();
        DB::table('cities')->delete();

        $user = App\User::create([
            'name'     => 'aurelien',
            'email'    => 'aur.dum@mail.com',
            'password' => bcrypt('aurelien'),
        ]);
        
        $this->command->info('User >> ok');

        $cities = [
            [ 'name' => 'Poissy', 'zip' => '78300' ],
            [ 'name' => 'Lyon', 'zip' => '69000' ],
        ];

        foreach ($cities as $city) {

            $city['slug'] = str_slug($city['name']);
            App\City::create($city);

        }

        $this->command->info('Ville >> ok');

        $jeuxEnfants = App\EquipmentType::create([ 'name' => 'Jeux pour enfant', 'slug' => str_slug('jeux pour enfant', '-') ]);

        $this->command->info('Jeux enfant >> ok');

        $equipments = [
            [ 'name' => 'Balançoire'],
            [ 'name' => 'Toboggan'],
            [ 'name' => 'Maisonnette enfant'],
            [ 'name' => 'Jeux sur ressort'],
            [ 'name' => 'Jeux de sable'],
            [ 'name' => 'Jeu à bascule'],
            [ 'name' => 'Jeux d\'escalade'],
        ];

        foreach ($equipments as $equipment) {

            $equipment['slug'] = str_slug($equipment['name']);
            $e = App\Equipment::create($equipment);

            $jeuxEnfants->equipments()->save($e);

            $this->command->info($equipment['name'] . ' >> ok');

        }

        $sport = App\EquipmentType::create([ 'name' => 'Sport', 'slug' => str_slug('sport', '-') ]);

        $this->command->info('Sport >> ok');

        $equipments = [
            [ 'name' => 'Parcours'],
            [ 'name' => 'Fitness plein air'],
        ];

        foreach ($equipments as $equipment) {

            $equipment['slug'] = str_slug($equipment['name']);
            $e = App\Equipment::create($equipment);

            $sport->equipments()->save($e);

            $this->command->info($equipment['name'] . ' >> ok');

        }

        $this->command->info('Ville ok');



    }
}
