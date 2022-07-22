<?php

namespace App\Controller;

use App\Entity\HourWorktime;
use App\Form\HourWorktimeType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HourWorktimeController extends AbstractController
{

    #[Route('/hour',name:'show_hour')]
public function showHour(ManagerRegistry $doctrine){
    $entityManager=$doctrine->getManager();
    $repository=$doctrine->getRepository(HourWorktime::class);
    $hours=$repository->findAll();
    
    return $this->render('/hour/index.html.twig',[
        'hours'=>$hours
    ]);
}


    #[Route('/hour/add', name: 'add_hour')]
    public function addHourWorktime(ManagerRegistry $doctrine,Request $request): Response
    {
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(HourWorktime::class);
        $hourWorktime=new HourWorktime();
        $form=$this->createForm(HourWorktimeType::class,$hourWorktime);
        $form->remove('created_at');
        $form->remove('update_at');
        $form->handleRequest($request);
        $hourWorktimes=$repository->findAll();
        $date = $hourWorktimes[0]->getStart_hour();
        

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($hourWorktime->getStartHour());
            foreach ($hourWorktimes as $worktime) {
            //    dd(date_format($hourWorktime->getStartHour(),"h:i"));
                if (date_format($worktime->getStartHour(),"h:i")===date_format($hourWorktime->getStartHour(),'h:i') &&
                date_format($worktime->getEndHour(),"h:i")===date_format($hourWorktime->getEndHour(),'h:i')) {
                    // dd($hourWorktime->getEndHour());
                    $this->addFlash("error","cette plage horaire existe déjà!") ;
                  return $this->redirectToRoute('add_hour',[
                      'hours'=>$hourWorktimes
                  ]); 
                }
            }
            $entityManager->persist($hourWorktime);
            $entityManager->flush();
            $this->addFlash('success','horaires ajoutés');
            return $this->redirectToRoute('show_hour',[
                'hours'=>$hourWorktimes
            ]);
        }
        
        return $this->render('/hour/addHour.html.twig', [
            'form' => $form->createView(),
            'hours'=>$hourWorktimes
        ]);
    }

    #[Route('/hour/update/{id<\d+>}/',name:'update_hour')]
    public function updateHour($id, ManagerRegistry $doctrine, Request $request)
    {
        
                $repository=$doctrine->getRepository(HourWorktime::class);
                $hourToUpdate=$repository->find($id);
                
                $hours=$repository->findAll();
                // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
               
                $form=$this->createForm(HourWorktimeType::class, $hourToUpdate);
                // dd($hourToUpdate->getOwningDate());
                $form->remove('created_at');
                $form->remove('update_at');
                
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    
                   
                    // if ($hourExist) {
                    //     $this->addFlash("error", "Cette hour existe déja,recommencez!");
                    //     return $this->redirectToRoute('add_hour');
                    // }
                    $entityManager->persist($hourToUpdate);
                    $entityManager->flush();
                    $this->addFlash('success', "la plage horaire a bien été modifiée! ");
                    return $this->redirectToRoute('show_hour');
                }
    
                return $this->render('/hour/addHour.html.twig', [
                      'form'=>$form->createView(),
                      'hours'=>$hours
                  ]);
    }


    #[Route('/hour/delete/{id<\d+>}','delete_hour')]
    public function delete(ManagerRegistry $doctrine, $id)
    {
        $repository=$doctrine->getRepository(HourWorktime::class);
        $hour=$repository->find($id);

        if ($hour) {
            $entityManager=$doctrine->getManager();
            $entityManager->remove($hour);
            $entityManager->flush();
            
            $this->addFlash('success', "la plage horaire a bien été supprimé!");
        } else {
            $this->addFlash('error', "cette plage horaire n'existe pas");
        }
      
        return $this->redirectToRoute('show_hour', [
          'hour'=>$hour
        ]);
    }


    #[Route('/hour/detail/{id<\d+>}/',name:'detail_hour')]
    public function detailHour($id, ManagerRegistry $doctrine,Request $request){
        {
            $repository=$doctrine->getRepository(HourWorktime::class);
            $hourToShow=$repository->find($id);
            // $logins=$repository->findAll();
              // $page=ceil($repository->count([])/12);
            $entityManager=$doctrine->getManager();
            // $personne=new Personne();
            // $form=$this->createForm(LoginType::class,$loginToUpdate);

            // $form->remove('created_at');
            // $form->remove('update_at');
            // $form->handleRequest($request);
            //est ce que le formulaire a été soumis?
              //si oui, on va ajouter l'objet Personne a la base de donnée
                //rediriger vers la liste des personnes
                //afficher un message de succes
              //sinon, on affiche le formulaire
          
            //   if ($form->isSubmitted() && $form->isValid()) {
                
            //     $loginExist=$repository->findBy([
            //         'reference'=>$loginToUpdate->getReference()
            //     ]); 
            //     if($loginExist){
            //         $this->addFlash("error","Ce login existe déja,recommencez!");
            //         return $this->redirectToRoute('add_login');
                    
            //     }
            //     $entityManager->persist($loginToUpdate);
            //     $entityManager->flush();
            //     $this->addFlash('success',"le login ".$loginToUpdate->getReference() ." a bien été modifié! ");
            //    return $this->redirectToRoute('show_login');
            //   }            

                return $this->render('/hour/detailHour.html.twig',[
                  'hour'=>$hourToShow
              ]);

    }
    }
    
}

