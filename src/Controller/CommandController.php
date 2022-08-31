<?php

namespace App\Controller;

use DateTime;

use App\Entity\Command;
use Doctrine\DBAL\DriverManager;
use App\Repository\OperatorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Time;
use \Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandController extends AbstractController
{

    #[Route('/command', name: 'command')]
    public function index(ManagerRegistry $doctrine, ?String $dateStart, ?String $dateEnd): Response
    {

        $db = mysqli_init();
        mysqli_options($db, MYSQLI_OPT_LOCAL_INFILE, true);
        mysqli_real_connect($db, "localhost", "root", "", "logistic");
        //modify path to be available in project_->public\build\movimento\command.csv

        $sql = "LOAD DATA INFILE '/xampp/mysql/data/logistic/command.csv' 
        IGNORE INTO TABLE command
        FIELDS TERMINATED BY ';' 
        LINES TERMINATED BY '\r\n' 
        IGNORE 1 LINES (id,data_movimento,ora_movimento,tipo_movimento,des_causale,profilo,ditta,articolo,des_articolo,segno,quantita,un_mis,peso,area_or,zona_or,fronte_or,colonna_or,piano_or,area_de,zona_de,fronte_de,colonna_de,piano_de,riga_ord,stato_prod_in,stato_prod_fin)";
        $db->query($sql);

        $repository = $doctrine->getRepository(Command::class);

        $commands = $repository->findDistinctDate();
        $minDate = $repository->findMinDate();
        $maxDate = $repository->findMaxDate();
        $prepQty = $commandByTipo = $repository->findQtyByTypo("220");
        $dateStart = "";
        $dateEnd = "";

        // dd($maxDate);
        if (isset($_GET['dateStart'])) {
            $dateStart = $_GET['dateStart'];
            $dateEnd = $_GET['dateEnd'];
        }
        $carQty = $commandByTipo = $repository->findQtyByTypo("401");
        if ($dateStart == "") {
            $dateStart = $minDate['data_min'];
        }
        if ($dateEnd == "") {
            $dateEnd = $maxDate['data_max'];
        }

        $commandsByDatePrep = $repository->findQtyByTypoBetweenDate("220", $dateStart, $dateEnd);
        $commandsByDateCariste = $repository->findQtyByTypoBetweenDate("401", $dateStart, $dateEnd);
        //    dd($dateEnd);
        $commands = $commands;
        return  $this->render('dashboard/activity.html.twig', [
            'commands' => $commands,
            'qty_prep' => $prepQty,
            'qty_car' => $carQty,
            'min_date' => $minDate,
            'max_date' => $maxDate,
            'qty_by_date_prep' => $commandsByDatePrep,
            'qty_by_date_cariste' => $commandsByDateCariste
        ]);
    }


    #[Route('/load_command', name: 'load_command')]
    public function load_command(): Response
    {
        $db = mysqli_init();
        mysqli_options($db, MYSQLI_OPT_LOCAL_INFILE, true);
        mysqli_real_connect($db, "localhost", "root", "", "logistic");
        //modify path to be available in project_->public\build\movimento\command.csv

        $sql = "LOAD DATA INFILE '/xampp/mysql/data/logistic/command.csv' 
        IGNORE INTO TABLE command
        FIELDS TERMINATED BY ';' 
        LINES TERMINATED BY '\r\n' 
        IGNORE 1 LINES (id,data_movimento,ora_movimento,tipo_movimento,des_causale,profilo,ditta,articolo,des_articolo,segno,quantita,un_mis,peso,area_or,zona_or,fronte_or,colonna_or,piano_or,area_de,zona_de,fronte_de,colonna_de,piano_de,riga_ord,stato_prod_in,stato_prod_fin)";
        $db->query($sql);
        return $this->render('dashboard/activity.html.twig');
    }


    #[Route('/operator_command/{typo}', name: 'operator_command')]
    public function getOperatorCommand(ManagerRegistry $doctrine, string $typo): Response
    {

        // load csv file 

        $db = mysqli_init();
        mysqli_options($db, MYSQLI_OPT_LOCAL_INFILE, true);
        mysqli_real_connect($db, "localhost", "root", "", "logistic");
        //modify path to be available in project

        $sql = "LOAD DATA INFILE 'public\build\movimento\command.csv' 
        IGNORE INTO TABLE command
        FIELDS TERMINATED BY ';' 
        LINES TERMINATED BY '\r\n' 
        IGNORE 1 LINES (id,data_movimento,ora_movimento,tipo_movimento,des_causale,profilo,ditta,articolo,des_articolo,segno,quantita,un_mis,peso,area_or,zona_or,fronte_or,colonna_or,piano_or,area_de,zona_de,fronte_de,colonna_de,piano_de,riga_ord,stato_prod_in,stato_prod_fin)";
        $db->query($sql);


        $repository = $doctrine->getRepository(Command::class);
        //recuperer les dates de début et fin si elles existent
        if (isset($_GET['dateStart'])) {
            $dateStart = $_GET['dateStart'];
            $dateEnd = $_GET['dateEnd'];
        } else {
            $dateStart = $repository->findMinDate();
            $dateStart = $dateStart["data_min"];
            $dateEnd = $repository->findMaxDate();
            $dateEnd = $dateEnd["data_max"];
        }
        //connexion a bdd et execution requete sql et recuperation resultat
        $connectionParams = [
            'dbname' => 'logistic',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];

        $conn = DriverManager::getConnection($connectionParams);
        $sql = "SELECT member.first_name as firstname,member.last_name as lastname, my_login.reference as myLogin,SUM(command.quantita) as quantita
        FROM member
        INNER JOIN my_login ON member.my_login_id = my_login.id
        INNER JOIN command ON command.profilo=my_login.reference
        GROUP BY member.first_name;";
        $stmt = $conn->executeQuery($sql);
        $result = $stmt->fetchAllAssociative();

        //execution methodes repository sur class command
        $id = 1;
        $qtyByProfilo = $repository->findQtyByTypoBetweenDateByProfilo($typo, $dateStart, $dateEnd);
        $timeByProfilo = $repository->findHourByDate($dateStart, $dateEnd, $typo);
        $profils = $repository->findProfilsByTypoAndDate($typo, $dateStart, $dateEnd);
        //creation tableau des heures totales de chaque opétateur
        $operators = [];

        foreach ($profils as $profil) {
            $hours = 0;
            $min = 0;
            $h = 0;
            $sec = 0;
            $temp = 0;
            foreach ($timeByProfilo as $row) {
                if ($row['profil'] === $profil['profilo']) {
                    $hours = date_diff(new DateTime($row['max_ora_movimento']), new DateTime($row['min_ora_movimento']));
                    $h += $hours->h;
                    $min += $hours->i;
                    if ($min > 60) {
                        $h++;
                        $min -= 60;
                    }
                    $sec += $hours->s;
                    if ($sec >= 60) {
                        $min++;
                        $sec -= 60;
                    }
                    $temp += floatval($h . "." . $min);
                    $operators[$row['profil']]['heure'] = $h;
                    $operators[$row['profil']]['min'] = $min;
                    $operators[$row['profil']]['sec'] = $sec;
                    $operators[$row['profil']]['temp'] = floatval($h . "." . $min);
                }
            }
        }
        return $this->render("Command/index.html.twig", [
            'qtyByProfilo' => $qtyByProfilo,
            'timeByProfilo' => $timeByProfilo,
            'id' => $id,
            'operators' => $operators,
            'typo' => $typo,
            'dateMin' => $dateStart,
            'dateEnd' => $dateEnd,
            'result' => $result
        ]);
    }
    #[Route('/operator_time', name: 'operator_time')]
    public function getOperatorTime(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Command::class);
        if (isset($_GET['dateStart'])) {
            $dateStart = $_GET['dateStart'];
            $dateEnd = $_GET['dateEnd'];
        } else {
            $dateStart = $repository->findMinDate();
            $dateStart = $dateStart["data_min"];
            $dateEnd = $repository->findMaxDate();
            $dateEnd = $dateEnd["data_max"];
        }

        $id = 1;
        $typo = '220';
        $timeByProfilo = $repository->findHourByDate($dateStart, $dateEnd, $typo);
        return $this->render("Command/time.html.twig", [
            'timeByProfilo' => $timeByProfilo,
            'id' => $id
        ]);
    }
}
