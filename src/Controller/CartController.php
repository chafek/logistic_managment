<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CartController extends AbstractController
{

    #[Route('/cart',name:'show_cart')]
public function showLogin(ManagerRegistry $doctrine){
    $entityManager=$doctrine->getManager();
    $repository=$doctrine->getRepository(Cart::class);
    $carts=$repository->findAll();
    
    return $this->render('/cart/index.html.twig',[
        'carts'=>$carts,
        'user'=>$this->getUser()
    ]);
}

    #[Route('/cart/add', name: 'add_cart')]
    public function addCart(ManagerRegistry $doctrine, Request $request)
    {
        $entityManager=$doctrine->getManager();
        $repository=$doctrine->getRepository(Cart::class);
        $carts=$repository->findAll();
        
        $cart=new Cart();
        $form=$this->createForm(CartType::class,$cart);
        $form->remove('created_at');
        $form->remove('update_at');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $entityManager->persist($cart);
            $entityManager->flush();
            $this->addFlash('success','chariot enregistré!');
            return $this->redirectToRoute('show_cart',
            [  
                'carts'=>$carts
            ]);
        }
 
        return $this->render('/cart/addCart.html.twig', [
            'form'=>$form->createView(),
            'carts' => $carts,
        ]);
    }

    
    #[Route('/cart/delete/{id<\d+>}','delete_cart')]
    public function delete(ManagerRegistry $doctrine, $id)
    {
        $repository=$doctrine->getRepository(Cart::class);
        $cart=$repository->find($id);

        if ($cart) {
            $entityManager=$doctrine->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
            $name=$cart->getInternalNumber();
            $this->addFlash('success', "le chariot $name a bien été supprimé!");
        } else {
            $this->addFlash('error', "ce chariot n'existe pas");
        }
      
        return $this->redirectToRoute('show_cart', [
          'cart'=>$cart
        ]);
    }

    #[Route('/cart/update/{id<\d+>}/',name:'update_cart')]
    public function updateCart($id, ManagerRegistry $doctrine, Request $request)
    {
        
                $repository=$doctrine->getRepository(Cart::class);
                $cartToUpdate=$repository->find($id);
           
                $carts=$repository->findAll();
                // $page=ceil($repository->count([])/12);
                $entityManager=$doctrine->getManager();
                // $personne=new Personne();
                $form=$this->createForm(CartType::class, $cartToUpdate);
                // dd($cartToUpdate->getOwningDate());
                $form->remove('created_at');
                $form->remove('update_at');
                $form->handleRequest($request);
                //est ce que le formulaire a été soumis?
                //si oui, on va ajouter l'objet Personne a la base de donnée
                //rediriger vers la liste des personnes
                //afficher un message de succes
                //sinon, on affiche le formulaire
                // dd($cartToUpdate->getName());
                $cartExist=$repository->findBy([
                    'internal_number'=>$cartToUpdate->getInternalNumber()
                ]);
               
                if ($form->isSubmitted() && $form->isValid()) {
                    
                   
                    // if ($cartExist) {
                    //     $this->addFlash("error", "Cette cart existe déja,recommencez!");
                    //     return $this->redirectToRoute('add_cart');
                    // }
                    $entityManager->persist($cartToUpdate);
                    $entityManager->flush();
                    $this->addFlash('success', "le chariot  ".$cartToUpdate->getInternalNumber() ." a bien été modifiée! ");
                    return $this->redirectToRoute('show_cart');
                }
    
                return $this->render('/cart/addCart.html.twig', [
                      'form'=>$form->createView(),
                      'carts'=>$carts
                  ]);
        }


        #[Route('cart/detail/{id<\d+>}/',name:'detail_cart')]
        public function detailCart($id, ManagerRegistry $doctrine,Request $request){
            {
                $repository=$doctrine->getRepository(Cart::class);
                $cartToShow=$repository->find($id);
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
    
                    return $this->render('/cart/detailCart.html.twig',[
                      'cart'=>$cartToShow
                  ]);

        }
        }
    }

    

