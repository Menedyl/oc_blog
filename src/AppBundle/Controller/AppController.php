<?php

namespace AppBundle\Controller;

use AppBundle\ManagerEntity;
use AppBundle\Twig;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController
{

    protected $twig;
    protected $managerEntity;

    public function __construct()
    {
        $this->twig = New Twig();
        $this->managerEntity = new ManagerEntity();

    }


    public function homeAction($name)
    {

        return new Response($this->twig->render('home.twig', array('name' => $name)));
    }





}