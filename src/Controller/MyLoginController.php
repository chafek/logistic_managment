<?php

namespace App\Controller;

use App\Entity\MyLogin;
use App\Form\MyLoginType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;



class MyLoginController extends AbstractController
 {

    #[Route('/mylogin',name:'show_myLogin')]
    public function showMyLogin(ManagerRegistry $doctrine){
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(MyLogin::class);
        $mylogins=$repository->findAll();
        // $log=$repository->findBy(array("member"=>"alain"));
               
        
        return $this->render('/myLogin/index.html.twig',[
            'myLogins'=>$mylogins
        ]);
    }

    
    #[Route('/mylogin/add',name:'add_myLogin')]
    public function addMyLogin(ManagerRegistry $doctrine, Request $request){
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(MyLogin::class);
        $mylogin=new MyLogin();
        $form=$this->createForm(MyLoginType::class,$mylogin);
        $form->remove('created_at');
        $form->remove('update_at');
        // $form->remove('member');
        $form->handleRequest($request);
        $mylogins=$repository->findAll();
        
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($mylogins as $log) {
                // dd($log->getCreatedAt());
                if($log->getReference()===$mylogin->getReference()){
                  
                    // return $this->render('Mylogin/addMyLogin.html.twig',[
                    //     'form'=>$form->createView(),
                    //     'controller_name' => 'MyLoginController',  
                        
                    // ]);
                      $this->addFlash('error','ce login existe déjà!');
                      return $this->redirectToRoute('add_myLogin',
                      [
                          'mylogins'=>$mylogins
                      ]);
                }
            }
            $entityManager->persist($mylogin);
            $entityManager->flush();
            $this->addFlash('success','Ajout du login réussi');
            return $this->redirectToRoute('show_myLogin',
            [
                'mylogins'=>$mylogins
            ]);
        }
        return $this->render('/myLogin/addLogin.html.twig',[
            'form'=>$form->createView(),
            'mylogins'=>$mylogins
        ]);


    }

    #[Route('myLogin/delete/{id<\d+>}',name:'delete_myLogin')]
        public function deleteMyLogin($id, ManagerRegistry $doctrine){
            
            $repository=$doctrine->getRepository(MyLogin::class);
            $myLogins=$repository->findAll();
            $myLoginToDelete=$repository->find($id);
            if (!$myLoginToDelete) {
                $this->addFlash('error', 'ce login est inexistant!');
                return $this->redirectToRoute('add_myLogin');
            }else{
                $entityManager=$doctrine->getManager();
                $entityManager->remove($myLoginToDelete);
                $entityManager->flush();
                $this->addFlash('success','suppression réussie!');
                return $this->redirectToRoute('show_myLogin',
                [
                    'myLogins'=>$myLogins
                ]);
               
            }
                
           return $this->render('/myLogin/addLogin.html.twig',[
                'myLogins'=>$myLogins
            ]);
        }

        #[Route('myLogin/update/{id<\d+>}/',name:'update_myLogin')]
        public function updateMyLogin($id, ManagerRegistry $doctrine,Request $request){
            {
                $repository=$doctrine->getRepository(MyLogin::class);
                $myLoginToUpdate=$repository->find($id);
                $myLogins=$repository->findAll();
                
                  // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
                $form=$this->createForm(MyLoginType::class,$myLoginToUpdate);

                $form->remove('created_at');
                $form->remove('update_at');
                $form->handleRequest($request);
                //est ce que le formulaire a été soumis?
                  //si oui, on va ajouter l'objet Personne a la base de donnée
                    //rediriger vers la liste des personnes
                    //afficher un message de succes
                  //sinon, on affiche le formulaire
              
                  if ($form->isSubmitted() && $form->isValid()) {
                    
                    $myLoginExist=$repository->findBy([
                        'reference'=>$myLoginToUpdate->getReference()
                    ]); 
                    if($myLoginExist){
                        $this->addFlash("error","Ce MyLogin existe déja,recommencez!");
                        return $this->redirectToRoute('add_MyLogin');
                        
                    }
                    $entityManager->persist($myLoginToUpdate);
                    $entityManager->flush();
                    $this->addFlash('success',"le MyLogin ".$myLoginToUpdate->getReference() ." a bien été modifié! ");
                   return $this->redirectToRoute('show_myLogin');
                  }            
    
                    return $this->render('/myLogin/addLogin.html.twig',[
                      'form'=>$form->createView(),
                      'myLogins'=>$myLogins
                  ]);

        }
        }


        #[Route('mylogin/detail/{id<\d+>}/',name:'detail_myLogin')]
        public function detailMyLogin($id, ManagerRegistry $doctrine,Request $request){
            {
                $repository=$doctrine->getRepository(MyLogin::class);
                $MyloginToShow=$repository->find($id);
                // $Mylogins=$repository->findAll();
                  // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
                // $form=$this->createForm(MyLoginType::class,$MyloginToUpdate);

                // $form->remove('created_at');
                // $form->remove('update_at');
                // $form->handleRequest($request);
                //est ce que le formulaire a été soumis?
                  //si oui, on va ajouter l'objet Personne a la base de donnée
                    //rediriger vers la liste des personnes
                    //afficher un message de succes
                  //sinon, on affiche le formulaire
              
                //   if ($form->isSubmitted() && $form->isValid()) {
                    
                //     $MyloginExist=$repository->findBy([
                //         'reference'=>$MyloginToUpdate->getReference()
                //     ]); 
                //     if($MyloginExist){
                //         $this->addFlash("error","Ce Mylogin existe déja,recommencez!");
                //         return $this->redirectToRoute('add_Mylogin');
                        
                //     }
                //     $entityManager->persist($MyloginToUpdate);
                //     $entityManager->flush();
                //     $this->addFlash('success',"le Mylogin ".$MyloginToUpdate->getReference() ." a bien été modifié! ");
                //    return $this->redirectToRoute('show_Mylogin');
                //   }            
    
                    return $this->render('/mylogin/detailLogin.html.twig',[
                      'myLogin'=>$MyloginToShow
                  ]);

        }
        }



}
