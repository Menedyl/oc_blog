<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AppController
{
    public function listAction(Request $request)
    {


        extract($request->attributes->all(), EXTR_SKIP);

        return new Response($this->environment->render($_route . '.twig'));

    }

}