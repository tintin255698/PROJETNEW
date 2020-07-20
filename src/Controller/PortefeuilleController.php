<?php

namespace App\Controller;

use App\Entity\Placement;
use App\Entity\Portefeuille;
use App\Entity\User;
use App\Form\PortefeuilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PortefeuilleController extends AbstractController
{
    /**
     * @Route("/portefeuille", name="portefeuille")
     */
    public function index(Request $request)
    {

        $post = new Portefeuille();

        $post->setUser($this->getUser());

        $form = $this->createForm(PortefeuilleType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                foreach ($post->getPlacements() as $placement){
                    $placement->setPortefeuille($post);
                    $doctrine = $this->getDoctrine()->getManager();
                    $doctrine->persist($placement);
                }
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($post);
            $doctrine->flush();
        }

        return $this->render('portefeuille/index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/portefeuille/afficher", name="portefeuille_affichage")
     */
    public function affichage(EntityManagerInterface $em)
    {

        $user = $this->getUser()->getId();

        $repo = $this->getDoctrine()->getRepository(Portefeuille::class)->findByExampleField($user);

        dump($repo);


        return $this->render('portefeuille\show.html.twig', array(
            'user' => $user,
        ));






    }


}