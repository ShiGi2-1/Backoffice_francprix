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
        $idfour = $_POST["idfour"];
        $libellefour = $_POST["libellefour"];
		$contactfour = $_POST["contactfour"];
        $req = $connexion->prepare("INSERT INTO fournisseur (idfour,libellefour,contactfour) VALUES (?, ?, ?)");
        $req->bind_param("sss",$idfour,$libellefour,$contactfour);
        

        if($req -> execute()){
            echo "Enregistrement effectuer";
        } else {
            echo "Echec de l'enregistrement: " . $req -> error;
        }
        $connexion -> close();
    }


?>