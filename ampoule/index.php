<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoules', 'root');
    } catch (PDOException $e) {
    print "Erreur: " . $e->getMessage() . "<br/>";
    die();
    }

if(isset($_GET["submit"])){
    $date = ($_GET["date"]);
    $floor = ($_GET["etage"]);
    $position = ($_GET["emplacement"]);
    $price = ($_GET["prix"]);

        if($_GET["id"]){
            
            $update = $bdd->prepare ("UPDATE `formulaire` SET `date`= :date,`etage`= :etage,`emplacement`= :emplacement,`prix`= :prix WHERE id = :id");
            $update->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $update->bindParam(':date',$date);
            $update->bindParam(':etage',$floor);
            $update->bindParam(':emplacement',$position);
            $update->bindParam(':prix',$price);
            $update->execute();
        }
         else{
            $insertion = $bdd->prepare ("INSERT INTO `formulaire`(`date`, `etage`, `emplacement`, `prix`) VALUES (:date,:etage, :emplacement, :prix)");
              $insertion->bindParam(':date',$date);
              $insertion->bindParam(':etage',$floor);
              $insertion->bindParam(':emplacement',$position);
              $insertion->bindParam(':prix',$price);
              $insertion->execute();
            }
}

$req=$bdd->prepare("SELECT * FROM `formulaire` WHERE id = :id");
$req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$req->execute();
$ampoule = $req->fetch(); 
?>

<body>
    <header>

        <nav>
            <ul>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="index.php">Formulaire</a></li>
            </ul>
        </nav>
    <div class="image">
        <img src="images/ampoules-filament.jpg" alt="">
    </div>
    </header>
    <form method="get">
        <div>
            <input type="hidden" name="id" value="<?= $ampoule['id'] ?? '';?>">
        </div>
        <div>
            <label for="date">Date de changement de l'ampoule :</label>
            <input type="date" id="date" name="date" value="<?= $ampoule['date'] ?? '';?>">
        </div>
        <div>
            <label for="etage">Etage :</label>
            <select name="etage" id="etage">
                <option value=""></option>
                <option value="rez-de-chaussee" <?= ($ampoule['etage'] == "rez-de-chaussee")? "selected" : "" ?>>
                    rez-de-chaussée</option>
                <option value="etage 1" <?= ($ampoule['etage'] == "etage 1")? "selected" : "" ?>>étage 1</option>
                <option value="etage 2" <?= ($ampoule['etage'] == "etage 2")? "selected" : "" ?>> étage 2 </option>
                <option value="etage 3" <?= ($ampoule['etage'] == "etage 3")? "selected" : "" ?>>étage 3</option>
                <option value="etage 4" <?= ($ampoule['etage'] == "etage 4")? "selected" : "" ?>>étage 4</option>
                <option value="etage 5" <?= ($ampoule['etage'] == "etage 5")? "selected" : "" ?>>étage 5</option>
                <option value="etage 6" <?= ($ampoule['etage'] == "etage 6")? "selected" : "" ?>>étage 6</option>
                <option value="etage 7" <?= ($ampoule['etage'] == "etage 7")? "selected" : "" ?>>étage 7</option>
                <option value="etage 8" <?= ($ampoule['etage'] == "etage 8")? "selected" : "" ?>>étage 8</option>
                <option value="etage 9" <?= ($ampoule['etage'] == "etage 9")? "selected" : "" ?>>étage 9</option>
                <option value="etage 10" <?= ($ampoule['etage'] == "etage 10")? "selected" : "" ?>>étage 10</option>
                <option value="etage 11" <?= ($ampoule['etage'] == "etage 11")? "selected" : "" ?>>étage 11</option>
            </select>
        </div>
        <div>
            <label for="emplacement">emplacement :</label>
            <select name="emplacement" id="emplacement" value="<?= $ampoule['emplacement'];?>">
                <option value=""></option>
                <option value="gauche" <?= ($ampoule['emplacement'] == "gauche")? "selected" : "" ?>>côté gauche</option>
                <option value="droit" <?= ($ampoule['emplacement'] == "droit")? "selected" : "" ?>>côté droit</option>
                <option value="fond" <?= ($ampoule['emplacement'] == "fond")? "selected" : "" ?>>fond</option>
            </select>
        </div>
        <div>
            <label for="prix">Prix de l'ampoule :</label>
            <input type="number" id="prix" name="prix" step="0.01" required value="<?= $ampoule['prix'] ?? '';?>">
        </div>
        <input type="submit" value="Valider" name="submit">
    </form>
</body>
</html>