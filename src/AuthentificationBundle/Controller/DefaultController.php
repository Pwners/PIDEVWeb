<?php

namespace AuthentificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Authentification/Default/index.html.twig');
    }
    public function loginAction()
    {
        return $this->render('@Authentification/Default/login.html.twig');
    }
}