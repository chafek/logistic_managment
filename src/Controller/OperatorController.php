<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\Operator;
use Doctrine\DBAL\DriverManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OperatorController extends AbstractController
{
    #[Route('/operator_commands', name: 'op_commands')]
    public function operator_commands()
    {

        $connectionParams = [
            'dbname' => 'logistic',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
       
        $conn = DriverManager::getConnection($connectionParams);
     
        
       
        $sql="SELECT member.first_name as firstname, my_login.reference as myLogin,SUM(command.quantita) as quantita
        FROM member
        INNER JOIN my_login ON member.my_login_id = my_login.id
        INNER JOIN command ON command.profilo=my_login.reference
        GROUP BY member.first_name;";
        $stmt=$conn->executeQuery($sql);
        $result=$stmt->fetchAllAssociative();
        return $result;
        // return $this->render('preparateur/index.html.twig',[
        //     'result'=>$result
        // ]);
    }


}
