<?php

namespace App\Controller;

use App\Entity\Command;
use App\Form\FilterDataType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FilterDataController extends AbstractController
{
    #[Route('/filter/data', name: 'filter_data')]
   
    public function getData(ManagerRegistry $doctrine, Request $request): Response
    {
        $repository=$doctrine->getRepository(Command::class);

        $minDate=$repository->findMinDate();
        $maxDate=$repository->findMaxDate();
        $allDate=$repository->findDistinctDate();
      
 
        
        

        return $this->render('filter_data/index.html.twig', [
            'minDate'=>$minDate,
            'maxDate'=>$maxDate,
            'allDate'=>$allDate
        ]);
    }

}
