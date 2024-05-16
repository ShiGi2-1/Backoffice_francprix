<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $confirm_password = $_POST['pswrepeat'];

    // Vérifier si les deux mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Connexion à la base de données MySQL
        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $db_name = "franprix";

        // Créer une connexion
        $conn = new mysqli($servername, $username, $password_db, $db_name);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Recréer l'utilisateur avec le nouveau mot de passe
        // Utilisez des guillemets simples pour entourer les valeurs dans la requête SQL
        $insert_query = "UPDATE inscriptions SET motpasse = '$password' WHERE adresseemail = '$email'";
        
        if ($conn->query($insert_query) === TRUE){
            echo "Mot de passe réinitialisé avec succès pour l'adresse e-mail : " . $email;
        } else {
            echo "Erreur lors du changement du mot de passe : " . $conn->error;
        }

        // Fermer la connexion
        $conn->close();
    }
}
header("Location: login.html");
?>