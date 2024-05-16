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

// Récupération des données du formulaire d'approvisionnement
$codeprod = $_POST['codeprod'] ?? '';
$idfour = $_POST['idfour'] ?? '';
$Date_four = $_POST['Date_four'] ?? '';
$quantite_four = $_POST['quantite_four'] ?? '';

// Vérification si les champs requis sont vides
if (empty($codeprod) || empty($idfour) || empty($Date_four) || empty($quantite_four)) {
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
 
    // Nouvelle quantité en stock après l'approvisionnement
    $nouvelle_quantite = $quantite_en_stock + $quantite_four;
    
    // Mise à jour de la quantité en stock
    $update_query = "UPDATE produit SET stockdispo = ? WHERE codeprod = ?";
    $stmt = $connexion->prepare($update_query);
    $stmt->bind_param("is", $nouvelle_quantite, $codeprod);
    if ($stmt->execute()) {
        // Enregistrement de l'approvisionnement
        $insert_query = "INSERT INTO fourniture (codeprod, idfour, Date_four, quantite_four) VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($insert_query);
        $stmt->bind_param("sssi", $codeprod, $idfour, $Date_four, $quantite_four);
        if ($stmt->execute()) {
            echo "Approvisionnement enregistré avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement de l'approvisionnement : " . $connexion->error;
        }
    } else {
        echo "Erreur lors de la mise à jour du stock : " . $connexion->error;
    }
} else {
    echo "Produit non trouvé.";
}

// Fermeture de la connexion à la base de données
$connexion->close();
?>