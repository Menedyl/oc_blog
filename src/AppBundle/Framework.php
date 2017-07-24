<?php

namespace AppBundle;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{

    protected $matcher;
    protected $controllerResolver;
    protected $argumentsResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentsResolver = $argumentResolver;

    }


    public function handle(Request $request)
    {

        $request->attributes->add($this->matcher->match($request->getPathInfo()));

        $controller = $this->controllerResolver->getController($request);
        $arguments = $this->argumentsResolver->getArguments($request, $controller);


        return new Response(call_user_func_array($controller, $arguments));

        /*
        try {



        } catch (ResourceNotFoundException $exception) {
            return new Response('Not found', 404);

        } catch (\Exception $exception) {
            return new Response('An error occured', 500);
        }
        */


    }


}