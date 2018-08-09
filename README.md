# up-task
# up-task
Il faudrait imaginer que nous développons un programme de fidélisation où nous récompensons la fidélité en fonction des achats que les clients font en points cadeaux.
Exemple : notre client XXXX souhaite récompenser ses clients pour leurs achats en magasins sur certains produits. Ces clients gagnent donc des points cadeaux.
 
Ecrire en PHP (structure à ta convenance) la mécanique de calcul selon le CDC suivant : 
 
Il existe 4 produits : 

                - Le « produit 1 » rapporte 5 points / unité
                - Le « produit 2 » rapporte 5 points / unité si au moins 1 « produit 1 » est vendu
                - Le « produit 3 » rapporte 15 points par lot de 2 (2 minimum)
                - Le « produit 4 » rapporte 35 points / unité
 
Il existe 3 périodes :

                - Période 1 :  du 01/01/2017 au 30/04/2017
                - Période 2 :  du 01/05/2017 au 31/08/2017
                - Période 3 :  du 01/10/2017 au 31/12/2017
 
Le fichier en pièce jointe (.CSV) contient les données BRUT du résultat à afficher sachant qu’il faut afficher le résultat de l’utilisateur (123456789) par période en POINTS ainsi que son équivalence en EUROS sachant qu’un point vaut 0.001€ sous la forme d’un tableau : 
 
<table>
  <tr><th>PERIODE</th><th>POINTS</th><th>EUROS</th></tr>
  <tr><td>PERIODE 1</td><td>X</td><td>X</td></tr>
  <tr><td>PERIODE 2</td><td>X</td><td>X</td></tr>
  <tr><td>PERIODE 3</td><td>X</td><td>X</td></tr>
</table>
 

<table><tr><th>PERIODE</th><th>POINTS</th><th>EUROS</th></tr><tr><td>PERIODE 1</td><td>875</td><td>€ 0.875 </td></tr><tr><td>PERIODE 2</td><td>45</td><td>€ 0.045 </td></tr><tr><td>PERIODE 3</td><td>320</td><td>€ 0.32 </td></tr></table>
