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
        $codeprod = $_POST["codeprod"];
        $libelleprod = $_POST["libelleprod"];
        $Prix= $_POST["Prix"];
        $stockdispo = $_POST["stockdispo"];
		$codecat = $_POST["codecat"];
        $req = $connexion->prepare("INSERT INTO produit (codeprod, libelleprod, Prix, stockdispo,codecat) VALUES (?, ?, ?, ?,?)");
        $req->bind_param("sssss", $codeprod, $libelleprod, $Prix, $stockdispo,$codecat);
        

        if($req -> execute()){
            echo "Enregistrement effectuer";
        } else {
            echo "Echec de l'enregistrement: " . $req -> error;
        }
        $connexion -> close();
    }


?>