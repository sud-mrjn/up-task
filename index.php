<!DOCTYPE html>
<html>
    <head>
        <title>Points per periode</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 15px;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <?php
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

        //Intializing final points to zero
        $finalPoint[1] = 0;
        $finalPoint[2] = 0;
        $finalPoint[3] = 0;

        
        if (isset($result) && !empty($result)) {
            foreach ($result as $row) {
                // Get data if user is 123456789 ONLY
                if($row['UTILISATEUR'] == '123456789'){
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
                        $finalPoint[1] += $totalPoints;
                    } elseif ($date >= strtotime('01-05-2017') && $date <= strtotime('31-08-2017')) { // PERIOD 2 INTERVAL
                        $finalPoint[2] += $totalPoints;
                    } elseif ($date >= strtotime('01-10-2017') && $date <= strtotime('31-12-2017')) { // PERIOD 3 INTERVAL
                        $finalPoint[3] += $totalPoints;
                    }
                }
            }
        }
        //var_dump($finalPoint);

        //Display Points per Period
        if (isset($finalPoint) && !empty($finalPoint)) {
            echo "<table><tr><th>PERIODE</th><th>POINTS</th><th>EUROS</th></tr>";
            for ($i = 1; $i <= count($finalPoint); $i++) {
                echo "<tr><td>PERIODE " . $i . "</td><td>" . $finalPoint[$i] . "</td><td>€ " . $finalPoint[$i] * 0.001 . " </td></tr>";
            }
            echo "</table>";
        }
        ?>
    </body>
</html>