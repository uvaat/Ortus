<?php

namespace App\Crawler;

use SKAgarwal\GoogleApi\PlacesApi;
use Goutte\Client;

class CrawlerLyon
{

    public static function request($callBack)
    {

        $client = new Client();
        $go = true;
        $nbPage = 1;

        // $fakedatas = array(
        //     array('Jardin Aubigny Flandin   ','16 rue d\'Aubigny - 3ème arrondissement')
        //     );

        // foreach ($fakedatas as $data) {

        //     $title = trim($data[0]);
        //     $adress = trim($data[1]);

        //     $a = explode('-', $adress);

        //     $request = trim($a[0]);

        //    try {

        //     	$geoCoding = new CrawlerGeoCoding('AIzaSyDgpW1FNFI5NKLvmehA8pkAACw1vi2YZHo');
        //         $adressInfo = $geoCoding->getByAdress($request, 'lyon');
        //         $info = $adressInfo[0];
                
        //         $s = new \StdClass();
        //         $s->title = $title;
        //         $s->adress = $request;
        //         $s->lat = $info->geometry->location->lat;
        //         $s->lng = $info->geometry->location->lat;

        //         $callBack($s);
                
        //     } catch (\Exception $e) {

        //         echo 'Exception reçue : ',  $e->getMessage(), "\n";

        //     }

        // }

        while($go){
            
            $urlPage = 'http://www.lyon.fr/cs/Satellite?pagename=RecherchePost&searchtype=Equipement&pagenumber='.$nbPage.'&type=Parcs+et+Jardins&Rechercher=1';
            $crawler = $client->request('GET', $urlPage);
            $items = $crawler->filter('.resultat_recherche_avancee_liste_critere_item');
            //if(!$items->count()) $go = false;
            if($nbPage == 1) $go = false;

            $items->each(function($node) use ($callBack) {

                $title = $node->filter('.resultat_recherche_avancee_liste_titre')->first();
                $adress = $node->filter('p')->eq(2)->first();

                $title = trim($title->text());
                $adress = trim($adress->text());

                $a = explode('-', $adress);

                $request = trim($a[0]);

                try {

                    $geoCoding = new CrawlerGeoCoding('AIzaSyDgpW1FNFI5NKLvmehA8pkAACw1vi2YZHo');
                    $adressInfo = $geoCoding->getByAdress($request, 'lyon');

                    if($adressInfo){

                        $info = $adressInfo[0];
                    
                        $s = new \StdClass();
                        $s->name = $title;
                        $s->adress = $request;
                        $s->lat = $info->geometry->location->lat;
                        $s->lng = $info->geometry->location->lng;

                        $callBack($s);
                        
                    }

                } catch (\Exception $e) {

                    echo 'Exception reçue : ',  $e->getMessage(), "\n";

                }

                // $node->filter('.resultat_recherche_avancee_liste_titre')->each(function($node) use ($googlePlaces) {

                //     //$c = $googlePlaces.textSearch($node->text());
                //     echo $node->text();
                //     echo '<br><hr><br>';

                // });

            });

           $nbPage++;

        }

    }

}