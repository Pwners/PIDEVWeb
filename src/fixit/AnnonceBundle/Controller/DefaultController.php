<?php

namespace fixit\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('fixitAnnonceBundle:Default:index.html.twig');
    }
}
