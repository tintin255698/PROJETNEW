<?php

namespace App\Controller;

    use App\Entity\User;
    use App\Form\EditUserType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function users()
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $pla = $repo->findall();

        return $this->render('admin/index.html.twig', [
            'pla' => $pla,
        ]);
    }

    /**
     * @Route("admin/modification/{id}", name="admin_modifier")
     */

    public function modification(Request $request, User $user)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/edit.user.html.twig', [
            'usersform' => $form->createView()
        ]);
    }

}
