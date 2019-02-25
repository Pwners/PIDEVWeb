<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
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
        $em = $this->getDoctrine()->getManager();
        //2-création de formulaire
        $form = $this->createForm(UserType::class,$pro);
        //4- récupération des données
        $form = $form->handleRequest($request);
        //5- validation du formulaire

            if ($form->isValid() && $form->isSubmitted()) {
                $pro->setUpdatedAt(new \DateTime('now'));
                // $file stores the uploaded PDF file
                /** @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file=$pro->getDiplome();
                $file2 = $pro->getImageCin();
                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $fileName2 = md5(uniqid()).'.'.$file2->guessExtension();
                $file->move($this->getParameter('brochures_directory'), $fileName);
                $file2->move($this->getParameter('imagage_directory'),$fileName2);
                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                //$notesrv->setUpload(new File($this->getParameter('news_directory').'/'.$notesrv->getUpload()));
                $pro->setDiplome($fileName);
                $pro->setImageCin($fileName2);
                $role = array('ROLE_PROFESSIONEL');
                $pro->setRoles($role);
                $em->persist($pro);
                $em->flush();

                return $this->redirectToRoute("affiche_pro");
            }

        return $this->render('@App/User/registration_pro.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/affichepro", name="affiche_pro")
     */
    public function afficheProAction(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        return $this->render('@App/User/profile_pro.html.twig',array(
           'user'=>$user
        ));
    }

}
