<?php
// verifierConnexion.php
// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $adresseemail = $_POST['username'];
    $motdepasse = $_POST['password'];

    // Connexion à la base de données MySQL
    $mysqli = new mysqli("localhost", "root", "", "franprix");

    // Vérifiez la connexion
    if ($mysqli->connect_error) {
        die("Échec de la connexion : " . $mysqli->connect_error);
    }

    // Préparation de la requête pour obtenir le mot de passe de l'utilisateur
    $stmt = $mysqli->prepare("SELECT motpasse FROM inscriptions WHERE adresseemail = ?");
    $stmt->bind_param("s", $adresseemail);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérification si l'utilisateur existe
    if ($result->num_rows === 1) {
        // Récupération du mot de passe
        $row = $result->fetch_assoc();
        $storedPassword = $row['motpasse'];

        // Vérifiez si le mot de passe correspond
        if ($motdepasse === $storedPassword) {
            // Mot de passe correct, redirection vers client.html
            header("Location: Client.html");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Mot de passe incorrect
            echo "Adresse email ou mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        echo "Adresse email ou mot de passe incorrect.";
    }

    // Fermeture des connexions
    $stmt->close();
    $mysqli->close();
} else {
    // Le formulaire n'est pas correctement rempli
    echo "Merci de remplir tous les champs.";
}
?>