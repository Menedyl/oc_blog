<?php

namespace AppBundle;

use Twig_Environment;
use Twig_Loader_Filesystem;


class Twig
{
    protected $environement;
    private $loader;

    public function __construct()
    {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/../../app/Ressources/views/');
        $this->environement = new Twig_Environment($this->loader);

        $this->addFunctions();

    }

    private function addFunctions()
    {
        $this->environement->addFunction(new \Twig_SimpleFunction('css', function ($path) {
            return '/oc_blog/web/css/' . $path . '.css';
        }));

        $this->environement->addFunction(new \Twig_SimpleFunction('img', function ($path) {
            return '/oc_blog/web/img/' . $path;
        }));
    }

    public function render($name, $context = array())
    {
        return $this->environement->render($name, $context);
    }


}