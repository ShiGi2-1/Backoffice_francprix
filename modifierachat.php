<?php
    $host = "localhost";
    $utilisateur = "root";
    $motpasse = "";
    $dataname = "franprix";
    //connexion a la base de donnees
    $connexion = new mysqli($host, $utilisateur, $motpasse, $dataname);

    if($connexion->connect_error){
        die("echec de la connexion a la base de donnees: " . $connexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numclt= $_POST["numclt"];
		$codeprod = $_POST["codeprod"];
        $Date_achat = $_POST["Date_achat"];
		$Quantite = $_POST["quantite_achat"];
        $req = $connexion->prepare("UPDATE achat SET quantite_achat = ? WHERE numclt = ? AND codeprod = ? AND Date_achat = ?");
        $req->bind_param("iiss", $Quantite, $numclt, $codeprod, $Date_achat);

        if($req->execute()){
            echo "Modification effectuée";
        } else {
            echo "Echec de la modification: " . $req->error;
        }
        $req->close(); // Close the prepared statement
        $connexion->close();
        
        // Redirect to gererachat.php
        header("Location: gererachat.php");
        exit(); // Ensure no further code is executed after redirection
    }
?>

