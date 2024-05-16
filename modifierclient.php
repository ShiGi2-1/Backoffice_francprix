<?php
    $host = "localhost";
    $utilisateur = "root";
    $motpasse = "";
    $dataname = "franprix";

    // Connexion à la base de données
    $connexion = new mysqli($host, $utilisateur, $motpasse, $dataname);

    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données: " . $connexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numclt = $_POST["numclt"];
        $prenomclt = $_POST["prenomclt"];
        $nomclt = $_POST["nomclt"];
        $contactclt = $_POST["contactclt"];
        
        // Préparation de la requête de mise à jour
        $req = $connexion->prepare("UPDATE client SET contactclt = ? WHERE numclt = ? AND prenomclt = ? AND nomclt = ?");
        $req->bind_param("siss", $contactclt, $numclt, $prenomclt, $nomclt);

        if ($req->execute()) {
            echo "Modification effectuée";
        } else {
            echo "Échec de la modification: " . $req->error;
        }
        $req->close(); // Fermer la requête préparée
        $connexion->close();
        
        // Redirection vers gererclient.php après la modification
        header("Location: gererclient.php");
        exit(); // Assurer qu'aucun autre code ne s'exécute après la redirection
    }
?>

