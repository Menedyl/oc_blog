<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Image;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use AppBundle\Repository\PostRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AppController
{


    public function listAction()
    {

        return $this->twig->render('post_list.twig');

    }

    public function addAction(Request $request)
    {

        /** @var Post $post */
        $post = new Post();


        /** @var Form $formPost */
        $formPost = $this->createForm(PostType::class, $post);

        $formPost->handleRequest($request);


        if ($formPost->isSubmitted() && $formPost->isValid()) {

            /** @var Post $post */
            $post = $formPost->getData();



            foreach ($post->getImages() as $image) {

                /** @var Image $image */
                $image->upload();
            }

            $this->em->getEntityManager()->persist($post);
            $this->em->getEntityManager()->flush();

            return $this->twig->render('Post/add.twig', array('formPost' => $formPost->createView()));

        }


        return $this->twig->render('Post/add.twig', array('formPost' => $formPost->createView()));

    }

    public function postAction($id)
    {

        /** @var PostRepository $repo */
        $repo = $this->em->getEntityManager()->getRepository("AppBundle\Entity\Post");

        /** @var Post $post */
        $post = $repo->findWithImage($id);

        return $this->twig->render('Post/post.twig', array('post' => $post));
    }


}