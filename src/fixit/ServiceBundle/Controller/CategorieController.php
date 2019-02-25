<?php

namespace fixit\ServiceBundle\Controller;

use AppBundle\Entity\User;
use fixit\ServiceBundle\Entity\Categorie;
use fixit\ServiceBundle\Entity\tache;
use fixit\ServiceBundle\Form\CategorieType;
use fixit\ServiceBundle\Form\RechercheType;
use fixit\ServiceBundle\Repository\UserCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function AjoutAction(Request $request)
    {
        //1-préparation d'un objet vide
        $categorie = new Categorie();
        //2-création de formulaire
        $form = $this->createForm(CategorieType::class,$categorie);
        //4- récupération des données
        $form = $form->handleRequest($request);
        //5- validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('_afficher');
        }
        return $this->render('@fixitService/Categorie/ajout.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function SupprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(Categorie::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('_afficher');
    }

    public function ModifierAction($id,Request $request)
    {
        //1-Préparation de l'entity manager
        $em=$this->getDoctrine()->getManager();
        //2-Préparation de notre objet
        $categorie=$em->getRepository(Categorie::class)->find($id);
        //3-Préparation du formulaire
        $form=$this->createForm(CategorieType::class,$categorie);
        //5-Récupération du formulaire
        $form=$form->handleRequest($request);
        //6-validation du formulaire
        if($form->isValid()){
            //7-update dans la base de données
            $em->flush();
            //8-redirection
            return $this->redirectToRoute('_afficher');
        }
        return $this->render('@fixitService/Categorie/modifier.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function AfficherAction()
    {
        $categories=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        return $this->render('@fixitService/Categorie/afficher.html.twig', array(
            'categories'=>$categories
        ));
    }

    public function AfficherUserAction($type)
    {

        $user= $this->container->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($type == "all"){
            $categories = $em->getRepository(Categorie::class)->findAll();
            return $this->render('@fixitService/Categorie/afficherUser.html.twig',array(
                'categories'=>$categories
            ));
        }
        $categories = $em->getRepository(Categorie::class)->findByType($type);
        return $this->render('@fixitService/Categorie/afficherUser.html.twig',array(
            'categories'=>$categories
        ));
    }
    public function rechercheTacheByTypeAction($type){

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findByType($type);
        return $this->render('@fixitService/Categorie/afficherUser.html.twig',array(
            'categories'=>$categories
        ));
    }
    public function rechercheAction(Request $request){
        $categorie=new Categorie();
        //2-création de formulaire
        $form=$this->createForm(RechercheType::class,$categorie);
        //4-recuperation des données
        $form=$form->handleRequest($request);
        //5-validation
        if($form->isValid()&& $form->isSubmitted()){
            //6-lancer la recherche
            $nom=$categorie->getNom();
            $type=$categorie->getType();
            $categorie=$this->getDoctrine()->getRepository(Categorie::class)->findByNom($nom);
            $categorie=$this->getDoctrine()->getRepository(Categorie::class)->findByType($type);
            return $this->render('@fixitService/Categorie/afficher.html.twig', array(
                'categories'=>$categorie));
        }
        //3-envoi du formulaire
        return $this->render('@fixitService/Categorie/rechercheCategorie.html.twig', array(
            'searchform'=>$form->createView()));
    }

    public function stepByStepDevisAction(){
        $em= $this->getDoctrine()->getManager();
        $taches = $em->getRepository(tache::class)->findAll();
        return $this->render('@fixitService/Categorie/stepBystepDevis.html.twig',array(
            'taches'=>$taches
        ));
    }
    public function devisAction(Request $request){

        $em= $this->getDoctrine()->getManager();
        $taches = $em->getRepository(tache::class)->findAll();
        return $this->render('@fixitService/Categorie/devis.html.twig',array(
            'taches'=>$taches
        ));
    }
    public function genererDevisAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $n = $request->get('nbr');
        $somme = 0;

        for ($i=1;$i<=$n;$i++){
            $tache = $em->getRepository(tache::class)->find($request->get('tache'.$i));
            $somme+= $tache->getPrix();
            $taches[]= $tache;
        }

        return $this->render('@fixitService/Categorie/devise.html.twig',array('taches'=>$taches,'somme'=>$somme));
    }
    public function pdfAction(){


    }
}
