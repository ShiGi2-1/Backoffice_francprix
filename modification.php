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
        $codeprod = $_POST["idprod"];
        $Prix = $_POST["Prix"];
        $req = $connexion->prepare("UPDATE produit SET Prix = ? WHERE codeprod = ?");
        $req->bind_param("ss", $Prix, $codeprod);

        if($req->execute()){
            echo "Modification effectuée";
        } else {
            echo "Echec de la modification: " . $req->error;
        }
        $req->close(); // Close the prepared statement
        $connexion->close();
        
        // Redirect to menuprincipal.html
        header("Location: gestion.php");
        //exit(); // Ensure no further code is executed after redirection
    }
?>

	