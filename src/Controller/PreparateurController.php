<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Command;

class PreparateurController extends AbstractController
{
    #[Route('/preparateur', name: 'preparateur')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $typo='220';
        $repository=$doctrine->getRepository(Command::class);
        $total =$repository->findDistinctDate();
        dd($total);
        return $this->render('preparateur/index.html.twig', [
            'total'=>$total
        ]);
    }
}
