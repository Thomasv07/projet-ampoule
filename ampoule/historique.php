<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="historique.php">Historique</a></li>
                <li><a href="index.php">Formulaire</a></li>
            </ul>
        </nav>
    </header>
    <div class="image">
        <img src="images/ampoules-filament.jpg" alt="">
    </div>

    <table> 
        <thead>
            <tr>
                <th>Date</th>
                <th>Etage</th>
                <th>Emplacement</th>
                <th>Prix</th>
                <th>Supprimer / Modifier</th>
            </tr>
        </thead>  
        <tbody>
            <?php
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=ampoules', 'root', '');
                } catch (PDOException $e) {
                    print "Erreur: " . $e->getMessage() . "<br/>";
                die();
                }

                $histoparpages = 5; 
                $histototalreq = $bdd->query('SELECT id FROM formulaire');
                $histototal = $histototalreq->rowCount();
                $pagetotal = ceil($histototal/$histoparpages);

                if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0){
                    $_GET['page'] = intval($_GET['page']);
                    $pagehisto = $_GET['page'];
                } else{
                    $pagehisto = 1;
                }

                $depart = ($pagehisto-1)*$histoparpages;

                $req=$bdd->query('SELECT * FROM `formulaire` ORDER BY id DESC LIMIT '.$depart.','.$histoparpages);

                

                foreach($req as $value) :
                    
            ?>
                <tr>
                    <td><?= $value['date']; ?></td>
                    <td><?= $value['etage']; ?></td>
                    <td><?= $value['emplacement']; ?></td>
                    <td><?= $value['prix']; ?></td>
                    <td>
                        <a href="delete.php?id=<?= $value['id']; ?>">Supprimer</a>
                        <a href="index.php?id=<?= $value['id']; ?>">Modifier</a>
                    </td>
                </tr>
            <?php
                endforeach;
                
            ?>
        </tbody>
    </table>
    <?php
    for($i=1;$i<=$pagetotal;$i++){
                    echo '<a href="historique.php?page='.$i.'">'.$i.'</a> ';
                }
    ?>
</body>
</html>