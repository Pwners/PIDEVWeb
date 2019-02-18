<?php

namespace fixit\PartenariatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('fixitPartenariatBundle:Default:index.html.twig');
    }
}
