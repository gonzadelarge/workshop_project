<?php

    namespace App\Controller;

use App\Entity\Vehiculo;
use App\Form\VehiculosFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    class VehiculosController extends AbstractController
    {


        /**
         * @Route("/vehiculos", name="showVehiculos")
         */
        public function showVehiculos(EntityManagerInterface $doctrine) {
            
            $repo = $doctrine->getRepository(Vehiculo::class);
            $vehiculo = $repo->findAll();

            return $this->render("vehiculos/listVehiculos.html.twig", ["vehiculos" => $vehiculo]);
        }


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
                $vehiculo->setCodUser($user);

                $em->persist($vehiculo);
                $em->flush();

                return $this->redirectToRoute('showVehiculos');
            }

            return $this->render("forms/formNewVehiculo.html.twig",['formVehiculo' => $form->createView()]);

        }

       
        /**
         * @Route ("/vehiculos/edit/{id}", name = "editVehiculo")
         */
        public function editVehiculo(Vehiculo $vehiculo, Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $flag =false;
            $form = $this->createForm(VehiculosFormType::class, $vehiculo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $vehiculo = $form->getData();
                $user = $this->getUser();
                $vehiculo->setCodUser($user);

                $em->persist($vehiculo);
                $em->flush();

                return $this->redirectToRoute('showVehiculos');
            }

            return $this->render("forms/formNewVehiculo.html.twig",['formVehiculo' => $form->createView(), 'flag'=>$flag, 'vehicle'=>$vehiculo]);
        }


        // BORRAR UN SOLO COCHE

         /**
         * @Route ("/vehiculos/delete/{id}", name = "deleteVehiculo")
         */
        public function deleteVehicle(EntityManagerInterface $doctrine, $id)
        {
            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Vehiculo::class);
            $vehiculo = $repo->find($id);
            $doctrine->remove($vehiculo);
            $doctrine->flush();
            return $this->redirectToRoute("showVehiculos");
        }

        // MOSTRAR UN SOLO COCHE

        /**  
         * @Route("/vehiculos/{id}", name="showVehiculo") 
         */
        public function postVehicleDetails(Vehiculo $vehiculo, EntityManagerInterface $doctrine, $id){

            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Vehiculo::class);
            $vehiculo = $repo->find($id);

            return $this->render("vehiculos/oneVehiculo.html.twig",["vehiculo" => $vehiculo]);
        }
    }