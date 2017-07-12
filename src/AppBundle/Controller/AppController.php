<?php

namespace AppBundle\Controller;

use AppBundle\ManagerEntity;
use AppBundle\Twig;
use Symfony\Component\HttpFoundation\Response;

class AppController
{

    protected $twig;
    protected $em;

    public function __construct()
    {
        $this->twig = New Twig();
        $this->em = new ManagerEntity();

    }


    public function homeAction()
    {

        return new Response($this->twig->render('home.twig'));
    }


}