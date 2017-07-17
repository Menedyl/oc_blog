<?php

namespace AppBundle;

use Symfony\Component\Asset\Package;
use Symfony\Bridge\Twig\Extension\AssetExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Translation\Translator;
use Twig_Environment;
use Twig_Loader_Filesystem;


class Twig
{
    protected $environement;
    private $loader;

    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem(array(
            __DIR__ . '/../../app/Ressources/views/',
            __DIR__ . '/../../vendor/symfony/twig-bridge/Resources/views/Form'
        ));

        $this->environement = new Twig_Environment($this->loader);

        $this->addFunctions();
        $this->addExtensions();

    }

    private function addFunctions()
    {
        $this->environement->addFunction(new \Twig_SimpleFunction('css', function ($path) {
            return '/oc_blog/web/css/' . $path . '.css';
        }));

        $this->environement->addFunction(new \Twig_SimpleFunction('img', function ($path) {
            return '/oc_blog/web/img/' . $path;
        }));

        $this->environement->addFunction(new \Twig_SimpleFunction('js', function ($path) {
            return '/oc_blog/web/js/' . $path . '.js';
        }));

    }

    private function addExtensions()
    {
        $routes = include __DIR__ . '/../../app/config/routing.php';
        $context = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());
        $this->environement->addExtension(new RoutingExtension(new UrlGenerator($routes, $context)));

        $this->environement->addExtension(new FormExtension());

        $translator = new Translator('fr');
        $this->environement->addExtension(new TranslationExtension($translator));
    }


    public function render($name, $context = array())
    {
        return $this->environement->render($name, $context);
    }


    public function addFormExtension($csrfManager)
    {

        $defaultFormTheme = 'form_div_layout.html.twig';

        $formEngine = new TwigRendererEngine(array($defaultFormTheme), $this->environement);

        $this->environement->addRuntimeLoader(
            new \Twig_FactoryRuntimeLoader(array(
                TwigRenderer::class => function () use ($formEngine, $csrfManager) {
                    return new TwigRenderer($formEngine, $csrfManager);
                },
            )));
    }

}