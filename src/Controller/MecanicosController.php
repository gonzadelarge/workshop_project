<?php

    namespace App\Controller;

    use App\Entity\Mecanico;
    use App\Form\MecanicosFormType;
    use App\Manager\WorkshopManager;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;


    class MecanicosController extends AbstractController
    {


        // MOSTRAR LA LISTA DE LOS MECANICOS

        /**
         * @Route("/mecanicos", name="showMecanicos")
         */
        public function showMecanicos(EntityManagerInterface $doctrine) {
            
            $repo = $doctrine->getRepository(Mecanico::class);
            $mecanico = $repo->findAll();

            return $this->render("mecanicos/listMecanicos.html.twig", ["mecanicos" => $mecanico]);
        }


        // CREAR UN NUEVO MECANICO

        /**
         * @Route("/mecanicos/new", name="newMecanico")
         */
        public function createMecanico(Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $form = $this->createForm(MecanicosFormType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $mecanico = $form->getData();

                $em->persist($mecanico);
                $em->flush();

                return $this->redirectToRoute('showMecanicos');
            }

            return $this->render("forms/formNewMecanico.html.twig",['formMecanico' => $form->createView()]);

        }

        // EDITAR UN SOLO MECANICO
       
        /**
         * @Route ("/mecanicos/edit/{id}", name = "editMecanico")
         */
        public function editMecanico(Mecanico $mecanico, Request $request, EntityManagerInterface $em) {

            $this->denyAccessUnlessGranted('ROLE_USER');
            $flag =false;
            $form = $this->createForm(MecanicosFormType::class, $mecanico);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $mecanico = $form->getData();
                
                $em->persist($mecanico);
                $em->flush();

                return $this->redirectToRoute('showMecanicos');
            }

            return $this->render("forms/formNewMecanico.html.twig",['formMecanico' => $form->createView(), 'flag'=>$flag, 'mecanico'=>$mecanico]);
        }


        // BORRAR UN SOLO MECANICO

         /**
         * @Route ("/mecanicos/delete/{id}", name = "deleteMecanico")
         */
        public function deleteMecanico(EntityManagerInterface $doctrine, $id)
        {
            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Mecanico::class);
            $mecanico = $repo->find($id);
            $doctrine->remove($mecanico);
            $doctrine->flush();
            return $this->redirectToRoute("showMecanicos");
        }

        // MOSTRAR UN SOLO MECANICO

        /**  
         * @Route("/mecanicos/{id}", name="showMecanico") 
         */
        public function postMecanico(Mecanico $mecanico, EntityManagerInterface $doctrine, $id){

            $this->denyAccessUnlessGranted('ROLE_USER');
            $repo = $doctrine->getRepository(Mecanico::class);
            $mecanico = $repo->find($id);

            return $this->render("mecanicos/oneMecanico.html.twig",["mecanico" => $mecanico]);
        }

    }