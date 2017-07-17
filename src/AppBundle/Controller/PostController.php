<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Image;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use AppBundle\Repository\PostRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends AppController
{

    const NB_POST_PER_PAGE = 4;


    public function listAction($page)
    {



        /** @var PostRepository $repo */
        $repo = $this->em->getEntityManager()->getRepository('AppBundle\Entity\Post');

        $postList = $repo->findAllWithImage($page, self::NB_POST_PER_PAGE);

        $nbPages = ceil(count($postList) / self::NB_POST_PER_PAGE);

        if ($page > $nbPages){
            throw new NotFoundHttpException("La page demandé n'existe pas");
        }

        return $this->twig->render('Post/list.twig', array(
            'postList' => $postList,
            'nbPages' => $nbPages,
            'page' => $page
        ));

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


    public function editAction(Request $request, $id)
    {
        /** @var PostRepository $repo */
        $repo = $this->em->getEntityManager()->getRepository("AppBundle\Entity\Post");

        /** @var Post $post */
        $post = $repo->findWithImage($id);

        /** @var Form $formPost */
        $formPost = $this->createForm(PostType::class, $post);


        $formPost->handleRequest($request);


        if ($formPost->isSubmitted() && $formPost->isValid()) {

            $post = $formPost->getData();


            $post->setDateUpdate(new \DateTime());

            foreach ($post->getImages() as $image) {

                $image->upload();
            }


            $this->em->getEntityManager()->persist($post);
            $this->em->getEntityManager()->flush();


            return $this->postAction($post->getId());

        }


        return $this->twig->render('Post/edit.twig', array('formPost' => $formPost->createView()));


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