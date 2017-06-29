<?php

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AppController
{
    public function listAction()
    {

        return new Response($this->twig->render('post_list.twig'));

    }

    public function postAction(Request $request, $id)
    {

        return new Response($this->twig->render('Post/post.twig', array('id' => $id)));
    }

}