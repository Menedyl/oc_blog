<?php

namespace AppBundle\Controller;

use AppBundle\ManagerEntity;
use AppBundle\Twig;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Validator\Validation;

class AppController
{

    protected $twig;
    protected $em;
    protected $formFactory;

    public function __construct()
    {
        $this->twig = New Twig();
        $this->em = new ManagerEntity();
        $this->formFactory = Forms::createFormFactory();

    }


    public function homeAction()
    {
        return $this->twig->render('home.twig');
    }

    protected function createForm($type = null, $data)
    {
        $session = new Session();

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $this->twig->addFormExtension($csrfManager);

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension(Validation::createValidator()))
            ->getFormFactory();

        if ($type) {
            return $formFactory->create($type, $data);
        }

        return $formFactory->create();
    }


}