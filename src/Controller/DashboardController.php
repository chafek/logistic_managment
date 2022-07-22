<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\Service;
use App\Entity\Cart;
use App\Entity\Rf;
use App\Entity\TimeTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
   
    #[Route('/', name: 'dashboard')]
    public function index(ManagerRegistry $doctrine,Request $request): Response
    {
        
        $memberRepository=$doctrine->getRepository(Member::class);
        $serviceRepository=$doctrine->getRepository(Service::class);
        $cartRepository=$doctrine->getRepository(Cart::class);
        $rfRepository=$doctrine->getRepository(Rf::class);
        $members=$memberRepository->findAll();
        $services=$serviceRepository->findAll();
        $carts=$cartRepository->findAll();
        $rfs=$rfRepository->findAll();
        // 
        $session=$request->getSession();
        if (!$session->has('user')) {
           
            $session->set('user', $this->getUser());
        }
        $user=$this->getUser();
    //    dd($user);
        return $this->render('dashboard/index.html.twig', [
           'members'=>$members,
           'services'=>$services,
           'carts'=>$carts,
           'rfs'=>$rfs,
           'user'=>$user
           
        ]);
    }
}
