<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    // #[Route('/', name: 'dashboard')]
    // public function index(): Response
    // {
    //     $user= $this->getUser();
    //     // dd($user);
    //     return $this->render('Dashboard\index.html.twig', [
    //         'user' =>$user
    //     ]);
    // }
}
