<?php
    $host = "localhost";
    $utilisateur = "root";
    $motpasse = "";
    $dataname = "franprix";
    //connexion a la base de donnees
    $connexion = new mysqli ($host, $utilisateur, $motpasse, $dataname);

    if($connexion -> connect_error){
        die("echec de la connexion a la base de donnees: " . $connexion->connect_error);

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numclt = $_POST["numclt"];
        $prenomclt = $_POST["prenomclt"];
        $nomclt = $_POST["nomclt"];
        $contactclt = $_POST["contactclt"];
        $req = $connexion->prepare("INSERT INTO client (numclt, prenomclt, nomclt, contactclt) VALUES (?, ?, ?, ?)");
        $req->bind_param("ssss", $numclt, $prenomclt, $nomclt, $contactclt);
        

        if($req -> execute()){
            echo "Enregistrement effectuer";
        } else {
            echo "Echec de l'enregistrement: " . $req -> error;
        }
        $connexion -> close();
    }


?>