<?php

$host = "localhost";
$utilisateur = "root";
$motpasse = "";
$dataname = "franprix";

// Connexion à la base de données
$connexion = new mysqli($host, $utilisateur, $motpasse, $dataname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des données du formulaire d'achat
$numclt = $_POST['numclt'] ?? '';
$codeprod = $_POST['codeprod'] ?? '';
$Date_achat = $_POST['Date_achat'] ?? '';
$quantite_achat = $_POST['quantite_achat'] ?? '';

// Vérification si les champs requis sont vides
if (empty($numclt) || empty($codeprod) || empty($Date_achat) || empty($quantite_achat)) {
    die("Tous les champs sont requis.");
}

// Préparation et exécution de la requête pour récupérer la quantité en stock
$query = "SELECT stockdispo FROM produit WHERE codeprod = ?";
$stmt = $connexion->prepare($query);
$stmt->bind_param("s", $codeprod);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quantite_en_stock = $row['stockdispo'];
    if ($quantite_en_stock >= $quantite_achat) {
        // Réduction de la quantité en stock
        $nouvelle_quantite = $quantite_en_stock - $quantite_achat;
        $update_query = "UPDATE produit SET stockdispo = ? WHERE codeprod = ?";
        $stmt = $connexion->prepare($update_query);
        $stmt->bind_param("is", $nouvelle_quantite, $codeprod);
        if ($stmt->execute()) {
            // Enregistrement de l'achat
            $insert_query = "INSERT INTO achat (numclt, codeprod, Date_achat, quantite_achat) VALUES (?, ?, ?, ?)";
            $stmt = $connexion->prepare($insert_query);
            $stmt->bind_param("sssi", $numclt, $codeprod, $Date_achat, $quantite_achat);
            if ($stmt->execute()) {
                echo "Achat enregistré avec succès.";
            } else {
                echo "Erreur lors de l'enregistrement de l'achat : " . $connexion->error;
            }
        } else {
            echo "Erreur lors de la mise à jour du stock : " . $connexion->error;
        }
    } else {
        echo "Quantité insuffisante en stock pour effectuer cet achat.";
    }
} else {
    echo "Produit non trouvé.";
}
        
// Fermeture de la connexion à la base de données
$connexion->close();
header("Location: gererachat.php");
exit();
?>