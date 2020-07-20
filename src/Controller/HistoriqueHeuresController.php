<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HistoriqueHeuresController extends AbstractController
{
    /**
     * @Route("/historique/heures", name="historique_heures")
     */
    public function index(HttpClientInterface $httpClient)
    {
        $json = file_get_contents('https://min-api.cryptocompare.com/data/v2/histohour?fsym=BTC&tsym=EUR&limit=24&=b33fc847fb8ce25afe2257eaef4fccea04219ca2d3022f0289bb5708bfe9efca');
        $parsed_json = json_decode($json);
        $high = $parsed_json->{'Data'}->{'Data'}[0]->{'high'};
        $high1 = $parsed_json->{'Data'}->{'Data'}[1]->{'high'};
        $high2 = $parsed_json->{'Data'}->{'Data'}[2]->{'high'};
        $high3 = $parsed_json->{'Data'}->{'Data'}[3]->{'high'};
        $high4 = $parsed_json->{'Data'}->{'Data'}[4]->{'high'};
        $high5 = $parsed_json->{'Data'}->{'Data'}[5]->{'high'};
        $high6 = $parsed_json->{'Data'}->{'Data'}[6]->{'high'};
        $high7 = $parsed_json->{'Data'}->{'Data'}[7]->{'high'};
        $high8 = $parsed_json->{'Data'}->{'Data'}[8]->{'high'};
        $high9 = $parsed_json->{'Data'}->{'Data'}[9]->{'high'};
        $high10 = $parsed_json->{'Data'}->{'Data'}[10]->{'high'};



        return $this->render('historique_heures/index.html.twig', [
            'high' => $high,
            'high1' => $high1,
            'high2' => $high2,
            'high3' => $high3,
            'high4' => $high4,
            'high5' => $high5,
            'high6' => $high6,
            'high7' => $high7,
            'high8' => $high8,
            'high9' => $high9,
            'high10' => $high10,
        ]);
    }
}
