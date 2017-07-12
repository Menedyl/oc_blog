<?php

namespace AppBundle\Controller;


use AppBundle\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AppController
{
    public function listAction()
    {

        return new Response($this->twig->render('post_list.twig'));

    }

    public function postAction($id)
    {

        /** @var PostRepository $var */
        $post = $this->em->getEntityManager()->getRepository("AppBundle\Entity\Post")->find($id);

        return new Response($this->twig->render('Post/post.twig', array('post' => $post)));
    }


}