<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MyLogin;
use App\Form\MemberType;
use Doctrine\Bundle\DoctrineBundle\Registry;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class MemberController extends AbstractController
{

    #[Route('/member', name: 'show_member')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
       
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Member::class);
       
        $members=$repository->findAll();
     
        return $this->render('/member/index.html.twig', [
        
            'members'=>$members
        ]);
    }
    
    #[Route('/member/add', name: 'add_member')]
    public function addMembers(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Member::class);
        $member=new Member();
        $form=$this->createForm(MemberType::class, $member);
        $form->remove('created_at');
        $form->remove('update_at');
        $form->handleRequest($request);

        $members=$repository->findAll();
        // dd(count($members));
        if ($form->isSubmitted() && $form->isValid()) {
            $memberExist=$repository->findBy([
                'firstName'=>$member->getFirstname(),
                'lastName'=>$member->getLastname()
            ]);
            foreach ($members as $savedMember) {
                if ($memberExist) {
                    $this->addFlash('error', 'cette personne existe déjà!');
                    return $this->redirectToRoute(
                        'add_member',
                        [
                          'members'=>$members
                      ]
                    );
                }
            }
            $entityManager->persist($member);
            $entityManager->flush();
            $this->addFlash('success', "bravo! " .$member->getFirstName()." a été enregistré.");
            return $this->redirectToRoute('show_member', [
                'members'=>$members
            ]);
        }
        return $this->render('/member/addMembers.html.twig', [
            'form' => $form->createView(),
            'members'=>$members
        ]);
    }

    #[Route('/member/delete/{id<\d+>}',name:'delete_member')]
    public function deleteMember($id, ManagerRegistry $doctrine)
    {
        $repository=$doctrine->getRepository(Member::class);
        $members=$repository->findAll();
        $memberToDelete=$repository->find($id);
        if (!$memberToDelete) {
            $this->addFlash('error', 'cette personne est inexistante!');
            return $this->redirectToRoute('add_member');
        } else {
            $entityManager=$doctrine->getManager();
            $entityManager->remove($memberToDelete);
            $entityManager->flush();
            $this->addFlash('success', $memberToDelete->getFirstName().' '.$memberToDelete->getLastName().' a été supprimé!');
            return $this->redirectToRoute(
                'show_member',
                [
                'member'=>$members
            ]
            );
        }
            
        return $this->render('/member/addMember.html.twig', [
            'members'=>$members
        ]);
    }

    #[Route('/update/{id<\d+>}/',name:'update_member')]
    public function updateMember($id, ManagerRegistry $doctrine, Request $request)
    {
        $repository=$doctrine->getRepository(Member::class);
        $memberToUpdate=$repository->find($id);
        $members=$repository->findAll();
        // $page=ceil($repository->count([])/12);
        $entityManager=$doctrine->getManager();
        // $personne=new Personne();
        $form=$this->createForm(MemberType::class, $memberToUpdate);
               
        $form->remove('created_at');
        $form->remove('update_at');
        $form->handleRequest($request);
        //est ce que le formulaire a été soumis?
        //si oui, on va ajouter l'objet Personne a la base de donnée
        //rediriger vers la liste des personnes
        //afficher un message de succes
        //sinon, on affiche le formulaire
              
        if ($form->isSubmitted() && $form->isValid()) {
            // $memberExist=$repository->findBy([
            //             'firstName'=>$memberToUpdate->getFirstname(),
            //             'lastName'=>$memberToUpdate->getLastname()
            //         ]);
            
        
            // if (!$memberExist) {
            //     $this->addFlash("error", "Cette personne n'existe pas,recommencez!");
            //     return $this->redirectToRoute('add_member');
            // }  
            $entityManager->persist($memberToUpdate);
            $entityManager->flush();
            $this->addFlash('success', "le collaborateur ".$memberToUpdate->getFirstName().' '.$memberToUpdate->getLastName()." a bien été modifié! ");
            return $this->redirectToRoute('show_member');
        }
    
        return $this->render('/member/addMembers.html.twig', [
                      'form'=>$form->createView(),
                      'members'=>$members
                  ]);
    }

    #[Route('member/detail/{id<\d+>}/',name:'detail_member')]
    public function detailMember($id, ManagerRegistry $doctrine,Request $request){
        {
            $repository=$doctrine->getRepository(Member::class);
            $MyLoginRepository=$doctrine->getRepository(MyLogin::class);

            $memberToShow=$repository->find($id);
            // $logins=$repository->findBy(array('member'=>"alain"));
            // dd($logins);
            // $members=$repository->findAll();
              // $page=ceil($repository->count([])/12);
            $entityManager=$doctrine->getManager();
            // $personne=new Personne();
            // $form=$this->createForm(MemberType::class,$memberToUpdate);

            // $form->remove('created_at');
            // $form->remove('update_at');
            // $form->handleRequest($request);
            //est ce que le formulaire a été soumis?
              //si oui, on va ajouter l'objet Personne a la base de donnée
                //rediriger vers la liste des personnes
                //afficher un message de succes
              //sinon, on affiche le formulaire
          
            //   if ($form->isSubmitted() && $form->isValid()) {
                
            //     $memberExist=$repository->findBy([
            //         'reference'=>$memberToUpdate->getReference()
            //     ]); 
            //     if($memberExist){
            //         $this->addFlash("error","Ce member existe déja,recommencez!");
            //         return $this->redirectToRoute('add_member');
                    
            //     }
            //     $entityManager->persist($memberToUpdate);
            //     $entityManager->flush();
            //     $this->addFlash('success',"le member ".$memberToUpdate->getReference() ." a bien été modifié! ");
            //    return $this->redirectToRoute('show_member');
            //   }            

                return $this->render('/member/detailMember.html.twig',[
                  'member'=>$memberToShow
              ]);

    }
    }
}
