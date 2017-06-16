<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController
{
    protected $filesystem;


    public function __construct()
    {
        $this->environment = new \Twig_Environment(
            new \Twig_Loader_Filesystem(__DIR__ . '/../Ressources/views'),
            [
                'cache' => false, // __DIR__ . '/../var'
            ]);

    }

    public function homeAction(Request $request)
    {

        extract($request->attributes->all(), EXTR_SKIP);

        return new Response($this->environment->render($_route . '.twig', array('name' => $name)));
    }


}