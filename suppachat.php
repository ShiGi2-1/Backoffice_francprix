<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width"/>
        <style>
            body {
                height: 100vh;
                margin: 0;
            }

            .container {
                width: 80%; /* Vous pouvez ajuster la largeur selon vos besoins */
                overflow: auto; /* Ajout de la barre de défilement */
                margin-left: 20vh;
                margin-top: 10vh;                
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }
            div.scrollmenu {
                display: flex;
                justify-content: space-between;
                background-color: #333;
                overflow: auto;
                white-space: nowrap;
            }

            div.scrollmenu a {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px;
                text-decoration: none;
            }

            div.scrollmenu a:hover {
                background-color: #777;
            }
        </style>
</head>
<body>
<body>
    <div class="scrollmenu">
  <a href="Client.html">Client</a>
  <a href="gererclient.php">Gérer Client</a>
  <a href="produit.html">Produit</a>
  <a href="gererproduit.php">Gérer Produit</a>
  <a href="Fournisseur.html">Fournisseur</a>
  <a href="gererfournisseur.php"> Gérer Fournisseur</a>
  <a href="Achat.html">Achat</a>  
  <a href="gererachat.php"> Gérer Achat</a>
  <a href="fourniture.html">Approvisionnement</a>
  <a href="gererapprovissionnement.php">Gérer Approvisionnement</a>
  <a href="panier.html">panier</a>
  <a href="savepanier.php">Gérer panier</a>

</div>

<div class="container">
    <table>
        <tr>
            <th>Numéro</th>
            <th>Date</th>
            <th>Produit</th>
            <th>Prix</th>
            <th>Nombre</th>
            <th>Cout</th>
        </tr>
        <?php
        include_once "connexion.php";

        // Vérification de la connexion à la base de données
        if ($conn) {
            $numclt = $_POST['numclt'] ?? '';
            // Requête SQL en utilisant une requête préparée pour éviter les attaques par injection SQL
            $query = "SELECT achat.numclt, Date_achat, libelleprod, Prix, quantite_achat, (quantite_achat * Prix) as Cout 
                      FROM achat, client, produit 
                      WHERE achat.numclt = client.numclt 
                      AND achat.codeprod = produit.codeprod 
                      AND achat.numclt = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'i', $numclt);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Vérification si la requête s'est exécutée avec succès
            if ($result) {
                if(mysqli_num_rows($result) === 0){
                    // S'il n'y a pas de produits
                    echo "<tr><td colspan='6'>Il n'y a pas d'achats pour ce client</td></tr>";
                } else {
                    // Sinon, affichons les produits
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['numclt']."</td>";
                        echo "<td>".$row['Date_achat']."</td>";
                        echo "<td>".$row['libelleprod']."</td>";
                        echo "<td>".$row['Prix']."</td>";
                        echo "<td>".$row['quantite_achat']."</td>";
                        echo "<td>".$row['Cout']."</td>";
                        echo "</tr>";
                    }
                }
            } else {
                // Gérer l'erreur de la requête
                echo "<tr><td colspan='6'>Erreur de requête : " . mysqli_error($conn)."</td></tr>";
            }

            // Fermer la requête préparée
            mysqli_stmt_close($stmt);

            // Fermer la connexion à la base de données
            mysqli_close($conn);
        } else {
            // Gérer l'échec de la connexion à la base de données
            echo "<tr><td colspan='6'>Échec de la connexion à la base de données</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

