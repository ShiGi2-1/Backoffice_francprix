
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
        $codeprod = $_POST["codeprod"];
        $date_ajout= $_POST["date_ajout"];
        $quantite = $_POST["quantite"];
        $req = $connexion->prepare("INSERT INTO panier (numclt, codeprod, date_ajout, quantite) VALUES (?, ?, ?, ?)");
        $req->bind_param("issi", $numclt, $codeprod, $date_ajout, $quantite);
        

        if($req -> execute()){
            echo "Enregistrement effectuer";
        } else {
            echo "Echec de l'enregistrement: " . $req -> error;
        }
        $connexion -> close();
    }


?>
