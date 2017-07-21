<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use AppBundle\ManagerEntity;
use AppBundle\Twig;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Yaml\Yaml;

class AppController
{

    protected $twig;
    protected $em;
    protected $session;
    protected $formFactory;

    public function __construct()
    {
        $this->twig = New Twig();
        $this->em = new ManagerEntity();
        $this->session = new Session();
        $this->formFactory = Forms::createFormFactory();

    }


    public function homeAction(Request $request)
    {
        /** @var Form $formContact */
        $formContact = $this->createForm(ContactType::class);

        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {

            $config = Yaml::parse(file_get_contents(__DIR__ . '/../../../app/config/config.yml'));
            $swiftMailerConfig = $config['swiftmailer']['config'];


            /** @var \Swift_SmtpTransport $transport */
            $transport = (new \Swift_SmtpTransport($swiftMailerConfig['host'], $swiftMailerConfig['port']))
                ->setUsername($swiftMailerConfig['username'])
                ->setPassword($swiftMailerConfig['password']);


            /** @var \Swift_Mailer $mail */
            $mailer = new \Swift_Mailer($transport);


            /** @var \Swift_Message $message */
            $message = new \Swift_Message();

            $message->setSubject("Message provenant de " . ($formContact->get('name')->getData()))
                ->setFrom(array($formContact->get("mail")->getData() => $formContact->get('name')->getData()))
                ->setTo("blog.contact@bostjancic.fr")
                ->setBody($formContact->get('content')->getData());

            $mailer->send($message);

            $this->session->getFlashBag()->add("info", "Le formulaire à bien été envoyé !");
            $info = $this->session->getFlashBag()->get('info', array());

            return $this->twig->render('home.twig', array(
                'formContact' => $formContact->createView(),
                'info' => $info
            ));
        }

        return $this->twig->render('home.twig', array(
            'formContact' => $formContact->createView()
        ));
    }

    protected function createForm($type, $data = null)
    {

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($this->session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $this->twig->addFormExtension($csrfManager);

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension(Validation::createValidator()))
            ->getFormFactory();

        return $formFactory->create($type, $data);
    }


    protected function redirectToRoute(Request $request, $route, $parameters = array(), $status = 302)
    {
        $routes = include __DIR__ . '/../../../app/config/routing.php';

        $context = new RequestContext();
        $context->fromRequest($request);

        $urlGenerator = new UrlGenerator($routes, $context);
        $url = $urlGenerator->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_URL);

        return new RedirectResponse($url, $status);
    }


}