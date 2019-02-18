<?php

namespace fixit\EvaluationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('fixitEvaluationBundle:Default:index.html.twig');
    }
}
