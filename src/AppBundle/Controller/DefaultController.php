<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function AdminAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Admin.html.twig'

        );
    }
    /**
     * @Route("/pro", name="pro")
     */
    public function ProAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('dashbord_pro.html.twig'
        );
    }
    /**
     * @Route("/user", name="user")
     */
    public function UserAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('dashbord_user.html.twig'
        );
    }
}
