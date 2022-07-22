<?php

namespace App\Controller;

use App\Entity\Rf;
use App\Form\RfType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Event\ControllerEvent;



class RfController extends AbstractController
{
    
    #[Route("/rf",name:"show_rf")]
    public function listRf(ManagerRegistry $doctrine){
      
        $repository=$doctrine->getRepository(Rf::class);
        $rfs=$repository->findAll();
        return $this->render('/rf/index.html.twig',[
            'rfs'=>$rfs
        ]);
    }

    #[Route('/rf/add',name:'add_rf')]
    public function addRf(ManagerRegistry $doctrine,Request $request){
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Rf::class);
        $rf=new Rf();
       $classname=$rf->getClassname();
      
        $form=$this->createForm(RfType::class,$rf);
        
        $form->remove('created_at');
        $form->remove('update_at');
        // $form->remove('member');
        $form->handleRequest($request);
        
        $rfs=$repository->findAll();
        
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($rfs as $myRf) {
                if($myRf->getName()===$rf->getName()){
                      $this->addFlash('error','cette rf existe déjà!');
                      return $this->redirectToRoute('add_rf',
                      [
                          'rfs'=>$rfs
                      ]);
                }
            }
            $entityManager->persist($rf);
            $entityManager->flush();
            $this->addFlash('success','Ajout de cette RF réussi');
            return $this->redirectToRoute('show_rf',
            [  
                'rfs'=>$rfs
            ]);
        }
        return $this->render('/rf/addRf.html.twig',[
             'form'=>$form->createView(),
             'rfs'=>$rfs
        ]);
    }


     #[Route('/rf/delete/{id<\d+>}','delete_rf')]
    public function delete(ManagerRegistry $doctrine, $id)
    {
        $repository=$doctrine->getRepository(Rf::class);
        $rf=$repository->find($id);

        if ($rf) {
            $entityManager=$doctrine->getManager();
            $entityManager->remove($rf);
            $entityManager->flush();
            $name=$rf->getName();
            $this->addFlash('success', "la $name a bien été supprimé!");
            return $this->redirectToRoute('show_rf', [
                'rf'=>$rf
              ]);
        } else {
            $this->addFlash('error', "cette rf n'existe pas");
        }
      
        return $this->redirectToRoute('add_rf', [
          'rf'=>$rf
        ]);
    }


     #[Route('rf/update/{id<\d+>}/',name:'update_rf')]
    public function updateRf($id, ManagerRegistry $doctrine, Request $request)
    {
        
                $repository=$doctrine->getRepository(Rf::class);
                $rfToUpdate=$repository->find($id);
          
                $rfs=$repository->findAll();
                // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
                $form=$this->createForm(RfType::class, $rfToUpdate);
                // dd($rfToUpdate->getOwningDate());
                $form->remove('created_at');
                $form->remove('update_at');
                $form->handleRequest($request);
                //est ce que le formulaire a été soumis?
                //si oui, on va ajouter l'objet Personne a la base de donnée
                //rediriger vers la liste des personnes
                //afficher un message de succes
                //sinon, on affiche le formulaire
                // dd($rfToUpdate->getName());
                $rfExist=$repository->findBy([
                    'name'=>$rfToUpdate->getName()
                ]);
                    
                if ($form->isSubmitted() && $form->isValid()) {
                    
                   
                    // if ($rfExist) {
                    //     $this->addFlash("error", "Cette rf existe déja,recommencez!");
                    //     return $this->redirectToRoute('add_rf');
                    // }
                    $entityManager->persist($rfToUpdate);
                    $entityManager->flush();
                    $this->addFlash('success', "la rf  ".$rfToUpdate->getName() ." a bien été modifiée! ");
                    return $this->redirectToRoute('show_rf');
                }
    
                return $this->render('/rf/addRf.html.twig', [
                      'form'=>$form->createView(),
                      'rfs'=>$rfs
                  ]);
        }

        #[Route('rf/detail/{id<\d+>}/',name:'detail_rf')]
        public function detailRf($id, ManagerRegistry $doctrine,Request $request){
            {
                $repository=$doctrine->getRepository(Rf::class);
                $rfToShow=$repository->find($id);
                // $logins=$repository->findAll();
                  // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
              
                    return $this->render('/rf/detailRf.html.twig',[
                      'rf'=>$rfToShow
                  ]);

        }
        }
    }

