<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/registrationPro", name="registration_pro")
     */
    public function registrationProAction(Request $request)
    {
        //1-préparation d'un objet vide
        $pro = new User();
        //2-création de formulaire
        $form = $this->createForm(UserType::class);
        //4- récupération des données
        $form = $form->handleRequest($request);
        //5- validation du formulaire
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $role = array ('ROLE_PROFESSIONEL');
            $pro->setRoles($role);
            $em->persist($pro);
            $em->flush();
            return $this->render('@App/User/registration_pro.html.twig', array(
                'form' => $form->createView()
                // ...
            ));
        }
        return $this->render('@App/User/registration_pro.html.twig', array(
            'form' => $form->createView()));
    }

}
