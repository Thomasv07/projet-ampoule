<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=ampoules', 'root', '');
    } catch (PDOException $e) {
        print "Erreur: " . $e->getMessage() . "<br/>";
    die();
    }

    if(isset($_GET['id'])){
        try {
            $req = $bdd->prepare('DELETE FROM formulaire WHERE id = :id');
            $req ->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $req ->execute(); 
        } catch(exeption $e){
            echo 'erreur query : ' . $e->getMessage();
        }
        header("Location: index.php");

    } else {
        $erreur = 'Désolé l\'ID n\'existe pas';
    }
?>