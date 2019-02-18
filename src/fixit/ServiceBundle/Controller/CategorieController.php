<?php

namespace fixit\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
    public function AjoutAction()
    {
        return $this->render('fixitServiceBundle:Categorie:ajout.html.twig', array(
            // ...
        ));
    }

    public function SupprimerAction()
    {
        return $this->render('fixitServiceBundle:Categorie:supprimer.html.twig', array(
            // ...
        ));
    }

    public function ModifierAction()
    {
        return $this->render('fixitServiceBundle:Categorie:modifier.html.twig', array(
            // ...
        ));
    }

    public function AfficherAction()
    {
        return $this->render('fixitServiceBundle:Categorie:afficher.html.twig', array(
            // ...
        ));
    }

}
