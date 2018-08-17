<?php

class Loyalty { 
    public $finalPoint = array();   

    public function __construct() {
        //Intializing 3 final points to zero
        $this->finalPoint = array_fill(1, 3, 0);   //syntax array_fill(index,number,value);   
    }

    function getData() { 
        //Get data from CSV
        $file = file('resultats_users.csv') or die("Unable to open file!");
        $rows = array_map(function($row) {
            return str_getcsv($row, ';');
        }, $file);
        $header = array_shift($rows);
        $result = array();
        foreach ($rows as $row) {
            $result[] = array_combine($header, $row);
        }
        //var_dump($result);           
        return $result;
    } 

    function calculate($result, $utilisateur){  
        if (isset($result) && !empty($result)) {            
            foreach ($result as $row) {                
                if($row['UTILISATEUR'] == $utilisateur){
                    //$totalPoints = 0;
                    $date = strtotime(str_replace('/', '-', $row['DATE']));
                    //Count PRODUCT 1 points - 5 points / unit
                    $totalPoints = $row['PRODUIT 1'] * 5;
                    //Count PRODUCT 2 points - 5 points / unit si au moins 1 « produit 1 » est vendu
                    $totalPoints += ($row['PRODUIT 1'] >= 1) ? $row['PRODUIT 2'] * 5 : 0;
                    //Count PRODUCT 3 points - 15 points per lot of 2 (2 minimum)
                    $totalPoints += floor($row['PRODUIT 3'] / 2) * 15;
                    //Count PRODUCT 4 points - 35 points / unit
                    $totalPoints += $row['PRODUIT 4'] * 35;

                    if ($date >= strtotime('01-01-2017') && $date <= strtotime('30-04-2017')) { //PERIOD 1 INTERVAL
                        $this->finalPoint[1] += $totalPoints;
                    } elseif ($date >= strtotime('01-05-2017') && $date <= strtotime('31-08-2017')) { // PERIOD 2 INTERVAL
                        $this->finalPoint[2] += $totalPoints;
                    } elseif ($date >= strtotime('01-10-2017') && $date <= strtotime('31-12-2017')) { // PERIOD 3 INTERVAL
                        $this->finalPoint[3] += $totalPoints;
                    }
                }
            }            
        }        
        //var_dump($this->finalPoint);    
        return $this->finalPoint;    
    }

    function display($finalPoint){
        if (isset($finalPoint) && !empty($finalPoint)) {
            $output = "<table border='1' align='left' cellpadding='10'><tr><th>PERIODE</th><th>POINTS</th><th>EUROS</th></tr>";
            for ($i = 1; $i <=count($finalPoint); $i++) {
                $output .= "<tr><td>PERIODE " . $i . "</td><td>" . $finalPoint[$i] . "</td><td>€ " . $finalPoint[$i] * 0.001 . " </td></tr>";
            }
            $output .= "</table>";
            return $output;
        }else{
            return "Pas de données disponibles";
        }
    }
}

$obj = new Loyalty();
$data = $obj->getData();
$utilisateur = '123456789';  //utilisateur est 123456789 
$points = $obj->calculate($data, $utilisateur );  // Extraire des points d'un utilisateur
echo $obj->display($points); //Afficher les points par période pour l'utilisateur          
?>
    