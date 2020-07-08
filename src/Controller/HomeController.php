<?php

namespace App\Controller;

use OpenWeather2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        
        /*
        $OWClass = new OpenWeather("a15539bece1d4d14d330c6e6cc4f7bad");
        $Value = $OWClass->getToday("Basel");
        */

        $OWClass = new OpenWeather2();
        $Value = $OWClass->getResult();

        /*var_dump($Value);*/

        return $this->render('home/home.html.twig', [
            'value' => $Value
        ]);
    }


    
}
