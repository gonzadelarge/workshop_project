<?php

    namespace App\Controller;

use App\Entity\Vehiculo;
use App\Form\VehiculosFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class VehiculosController extends AbstractController
    {


        // CREAR UN NUEVO VEHICULO

        /**
         * @Route("/vehiculos/new", name="newVehiculo")
         */
        public function createVehiculo(Request $request, EntityManagerInterface $em, SluggerInterface $slugger) {

            $this->denyAccessUnlessGranted('ROLE_USER');

            $form = $this->createForm(VehiculosFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $image = $form->get('Image')->getData();
                $vehiculo = $form->getData();

                $path = $this->getParameter('kernel.project_dir').'/public/images/vehiculos';
                $filename = $slugger->slug($vehiculo->getMarca()).'.'.$image->guessClientExtension();

                $image->move(
                    $path,
                    $filename
                );

                $vehiculo->setImage("/images/vehiculos/$filename");

                $user = $this->getUser();
                $vehiculo->setCodUser($user);
                $id = $user->getId();

                $em->persist($vehiculo);
                $em->flush();

                $this->addFlash("exito", "Vehículo insertado correctamente.");

                return $this->redirectToRoute('showVehiculos', ["id" => $id]);
            }

            return $this->render("forms/formNewVehiculo.html.twig",['formVehiculo' => $form->createView()]);

        }


        // EDITAR UN SOLO COCHE
       
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
                $id = $user->getId();
                $em->persist($vehiculo);
                $em->flush();

                $this->addFlash("exito", "Vehiculo editado correctamente");

                return $this->redirectToRoute('showVehiculos', ["id" => $id]);
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
            
            $user = $this->getUser();
            $idUser = $user->getId();

            $doctrine->remove($vehiculo);
            $doctrine->flush();
            return $this->redirectToRoute('showVehiculos', ["id" => $idUser]);
        }

        // MOSTRAR UN SOLO COCHE

        /**  
         * @Route("/vehiculo/{id}", name="showVehiculo") 
         */
        public function postVehicleDetails(Vehiculo $vehiculo, EntityManagerInterface $doctrine, $id){

            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Vehiculo::class);
            $vehiculo = $repo->find($id);

            return $this->render("vehiculos/oneVehiculo.html.twig",["vehiculo" => $vehiculo]);
        }

         // MOSTRAR LA LISTA DE LOS VEHICULOS


        /**
         * @Route("/vehiculos/{id}", name="showVehiculos")
         */
        public function showVehiculos(EntityManagerInterface $doctrine, $id) {
            
            $repo = $doctrine->getRepository(Vehiculo::class);
            $vehiculo = $repo->findBy(["Cod_User" => $id]);

            return $this->render("vehiculos/listVehiculos.html.twig", ["vehiculos" => $vehiculo]);
        }
    }