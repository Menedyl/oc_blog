<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController
{
    protected $filesystem;
    protected $requestAttr = array();


    public function __construct()
    {
        $this->environment = new \Twig_Environment(
            new \Twig_Loader_Filesystem(__DIR__ . '/../../../app/Ressources/views'),
            [
                'cache' => false, // __DIR__ . '/../var'
            ]);

    }

    /*
     * @Route("/home", name="home")
     */
    public function homeAction(Request $request)
    {
        $this->extractAttr($request);

        return new Response($this->environment->render($this->requestAttr['_route'] . '.twig', array('name' => $this->requestAttr['name'])));
    }


    protected function extractAttr(Request $request)
    {

        foreach ($request->attributes->all() as $key => $value) {
            $this->requestAttr[$key] = $value;
        }

    }


}