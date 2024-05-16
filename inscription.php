<?php
// enregistrerUtilisateur.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_repeat'])) {
        // Récupération des valeurs
        $nom = $_POST['nom'];
        $pronom = $_POST['prenom'];
        $tel = $_POST['telephone'];
        $email = $_POST['email'];
        $motdepasse = $_POST['mdp'];
        $confirmationMotdepasse = $_POST['mdp_repeat'];
        
        // Vérifier si les deux mots de passe correspondent
        if ($motdepasse === $confirmationMotdepasse) {
            // Connexion à la base de données MySQL
            $mysqli = new mysqli("localhost", "root", "", "lopale");
            
            // Vérification de la connexion
            if ($mysqli->connect_error) {
                die("Connexion échouée : " . $mysqli->connect_error);
            }
            
            // Préparation de la requête d'insertion
            $stmt = $mysqli->prepare("INSERT INTO client(nom_clt, prenom_clt, tel_clt, passeword, mail_clt) VALUES (?,?,?,?,?)");
            $stmt->bind_param("ssssss", $nom, $prenom, $tel, $email, $motdepasse, $confirmationMotdepasse);
            
            // Exécution de la requête
            if ($stmt->execute()) {
                echo "Compte enregistré avec succès.";
            } else {
                echo "Erreur lors de l'enregistrement du Compte.";
            }
            
            // Fermeture des connexions
            $stmt->close();
            $mysqli->close();
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Tous les champs sont requis.";
    }
} else {
    // Rediriger vers le formulaire si la méthode n'est pas POST
    // header("Location: loginn.html");
}
?>