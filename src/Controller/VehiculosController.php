<?php

    namespace App\Controller;

use App\Form\VehiculosFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    class VehiculosController extends AbstractController
    {
        /**
         * @Route("/vehiculos/new", name="newVehiculo")
         */
        public function createVehiculo(Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $form = $this->createForm(VehiculosFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $vehiculo = $form->getData();
                $user = $this->getUser();
                $vehiculo->setIdUser($user);

                $em->persist($vehiculo);
                $em->flush();

                return $this->redirectToRoute('app_login');
            }

            return $this->render("forms/formNewVehiculo.html.twig",['formVehiculo' => $form->createView()]);

        }
    }