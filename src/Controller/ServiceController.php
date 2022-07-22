<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\SubmitButton;


class ServiceController extends AbstractController
{

    #[Route('/service',name:'show_service')]
    public function showLogin(ManagerRegistry $doctrine){
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Service::class);
        $services=$repository->findAll();
        
        return $this->render('/service/index.html.twig',[
            'services'=>$services
        ]);
    }
    /**
     * add service function
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response  service added
     */
    #[Route('/service/add', name: 'add_service')]
    public function addService(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Service::class);
        $service=new Service();
        $form=$this->createForm(ServiceType::class, $service);
        $form->remove('created_at');
        $form->remove('update_at');
        $form->handleRequest($request);
        $services=$repository->findAll();
        if ($form->isSubmitted() &&  $form->isValid()) {    
            foreach ($services as  $serv) {
                if ($serv->getService()===$service->getService()) {
                    $this->addFlash('error', 'ce service existe déjà!');
                    return $this->redirectToRoute(
                        'add_service',
                        [
                          'services'=>$services
                      ]
                    );
                }
            }
            $entityManager->persist($service);
            $entityManager->flush();
            $this->addFlash('success', 'Ajout du service réussi!');
            return $this->redirectToRoute('show_service', [
                    'services'=>$services
                ]);
        }
        return $this->render('/service/addService.html.twig', [
            'form'=>$form->createView(),
            'services'=>$services
        ]);
    }


    /**
     * delete service function
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return Response  service deleted
     */


    #[Route('/service/delete/{id<\d+>}','delete_service')]
    public function delete(ManagerRegistry $doctrine, $id)
    {
        $repository=$doctrine->getRepository(Service::class);
        $service=$repository->find($id);

        if ($service) {
            $entityManager=$doctrine->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
            $name=$service->getService();
            $this->addFlash('success', "le service $name a bien été supprimé!");
            return $this->redirectToRoute('show_service', [
                'service'=>$service
              ]);
        } else {
            $this->addFlash('error', "cette service n'existe pas");
        }
      
        return $this->redirectToRoute('add_service', [
          'service'=>$service
        ]);
    }


    
    #[Route('/service/update/{id<\d+>}/',name:'update_service')]
    public function updateService($id, ManagerRegistry $doctrine, Request $request)
    {
        
                $repository=$doctrine->getRepository(Service::class);
                $serviceToUpdate=$repository->find($id);
                $services=$repository->findAll();
                // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
                $form=$this->createForm(ServiceType::class, $serviceToUpdate);
               
                $form->remove('created_at');
                $form->remove('update_at');
                $form->handleRequest($request);
                //est ce que le formulaire a été soumis?
                //si oui, on va ajouter l'objet Personne a la base de donnée
                //rediriger vers la liste des personnes
                //afficher un message de succes
                //sinon, on affiche le formulaire
            //     $btnRetour=$form->get('retour');
            //    {dd($btnRetour);}
                if ($form->isSubmitted() && $form->isValid()) {
                   
                    $serviceExist=$repository->findBy([
                        'service'=>$serviceToUpdate->getService()
                    ]);
                    if ($serviceExist) {
                        $this->addFlash("error", "Ce service existe déja,recommencez!");
                        return $this->redirectToRoute('add_service');
                    }
                    $entityManager->persist($serviceToUpdate);
                    $entityManager->flush();
                    $this->addFlash('success', "le service ".$serviceToUpdate->getService() ." a bien été modifié! ");
                    return $this->redirectToRoute('show_service');
                }
    
                return $this->render('/service/addService.html.twig', [
                      'form'=>$form->createView(),
                      'services'=>$services
                  ]);
        }


        #[Route('/service/detail/{id<\d+>}/',name:'detail_service')]
        public function detailService($id, ManagerRegistry $doctrine,Request $request){
            {
                $repository=$doctrine->getRepository(Service::class);
                $serviceToShow=$repository->find($id);
              
              
    
                    return $this->render('/service/detailService.html.twig',[
                      'service'=>$serviceToShow
                  ]);

        }
        }
    }
