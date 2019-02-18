<?php

namespace fixit\OrganisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('fixitOrganisationBundle:Default:index.html.twig');
    }
}
