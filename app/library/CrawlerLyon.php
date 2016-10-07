<?php

namespace App\library;

use SKAgarwal\GoogleApi\PlacesApi;
use Goutte\Client;

class CrawlerLyon
{

    public static function request()
    {
        
        //$googlePlaces = new PlacesApi('AIzaSyDoyJH-HmpK9xe6f61Bg89kRTYFU1sXh8g');

        $client = new Client();
        $go = true;
        $nbPage = 1;

        $fakedatas = array(
            array('Jardin Aubigny Flandin   ','16 rue d\'Aubigny - 3ème arrondissement')
            );

        foreach ($fakedatas as $data) {

            $title = trim($data[0]);
            $adress = trim($data[1]);

            $a = explode('-', $adress);

            $request = trim($a[0]);

            try {

            	$geoCoding = new GoogleGeoCoding('AIzaSyDgpW1FNFI5NKLvmehA8pkAACw1vi2YZHo');
            	$adressInfo = $geoCoding->getByAdress($request, 'lyon');
                // $c = $googlePlaces->textSearch($request . '+lyon');
                // $infos = $c->get('results');
                // if($infos->count() <= 1){
                //     $info = $infos[0];
                //     var_dump($info);
                // }
                // echo '<hr><br>';

            } catch (\Exception $e) {

                echo 'Exception reçue : ',  $e->getMessage(), "\n";

            }

        }

        // while($go){
            
        //     $urlPage = 'http://www.lyon.fr/cs/Satellite?pagename=RecherchePost&searchtype=Equipement&pagenumber='.$nbPage.'&type=Parcs+et+Jardins&Rechercher=1';
        //     $crawler = $client->request('GET', $urlPage);
        //     $items = $crawler->filter('.resultat_recherche_avancee_liste_critere_item');
        //     //if(!$items->count()) $go = false;
        //     if($nbPage == 1) $go = false;

        //     $items->each(function($node) use ($googlePlaces) {

        //         $title = $node->filter('.resultat_recherche_avancee_liste_titre')->first();
        //         $adress = $node->filter('p')->eq(2)->first();

        //         echo $title->text();
        //         echo '<br>';
        //         echo $adress->text();
        //         echo '<hr>';

        //         // $node->filter('.resultat_recherche_avancee_liste_titre')->each(function($node) use ($googlePlaces) {

        //         //     //$c = $googlePlaces.textSearch($node->text());
        //         //     echo $node->text();
        //         //     echo '<br><hr><br>';

        //         // });

        //     });

        //     $nbPage++;

        // }

    }

}