<?php

    namespace App\Controller;

    use App\Entity\Cita;
use App\Form\CitaFormType;
use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


    class CitaController extends AbstractController
    {

        // CREAR UNA NUEVA CITA

        /**
         * @Route("/citas/new", name="newCita")
         */
        public function createCita(Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $form = $this->createForm(CitaFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $cita = $form->getData();
                $user = $this->getUser();
                $cita->setCodUser($user);

                $id = $user->getId();

                $em->persist($cita);
                $em->flush();

                $this->addFlash("exito", "Cita creada correctamente");

                return $this->redirectToRoute('showCitas', ["id" => $id]);
            }

            return $this->render("forms/formNewCita.html.twig",['formCita' => $form->createView()]);

        }

        // EDITAR UNA SOLA CITA
       
        /**
         * @Route ("/citas/edit/{id}", name = "editCita")
         */
        public function editCita(Cita $cita, Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $flag =false;
            $form = $this->createForm(CitaFormType::class, $cita);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $cita = $form->getData();

                $user = $this->getUser();
                $cita->setCodUser($user);
                $id = $user->getId();

                $em->persist($cita);
                $em->flush();

                return $this->redirectToRoute('showCitas', ["id" => $id]);
            }

            return $this->render("forms/formNewcita.html.twig",['formCita' => $form->createView(), 'flag'=>$flag, 'cita'=>$cita]);
        }

        // BORRAR UNA SOLA CITA

         /**
         * @Route ("/citas/delete/{id}", name = "deleteCita")
         */
        public function deleteCita(EntityManagerInterface $doctrine, $id)
        {
            $this->denyAccessUnlessGranted('ROLE_USER');

            $repo = $doctrine->getRepository(Cita::class);
            $cita = $repo->find($id);

            $user = $this->getUser();
            $idUser = $user->getId();

            $doctrine->remove($cita);
            $doctrine->flush();
            
            return $this->redirectToRoute("showCitas", ["id" => $idUser]);
        }


        // MOSTRAR UNA SOLA CITA

        /**  
         * @Route("/cita/{id}", name="showCita") 
         */
        public function showCita(Cita $cita, EntityManagerInterface $doctrine, $id){

            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Cita::class);
            $cita = $repo->find($id);

            return $this->render("citas/oneCita.html.twig",["cita" => $cita]);
        }


        // MOSTRAR LA LISTA DE LAS CITAS

        /**
         * @Route("/citas/{id}", name="showCitas")
         */
        public function showCitas(EntityManagerInterface $doctrine, $id) {
            
            $repo = $doctrine->getRepository(Cita::class);
            $cita = $repo->findBy(["CodUser" => $id]);

            return $this->render("citas/listCitas.html.twig", ["citas" => $cita]);
        }

    }