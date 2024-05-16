<!DOCTYPE html>
  <html>
       <head>
	       <title>Mise à jour prix</title>
		   <meta charset="utf-8"/>
		   <meta http-equiv="X-UA-Compatible" content = "IE=edge"/>
		   <meta name="viewport" content ="width=device-width"/>
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
          <div class="form"> 
		    <a href="gestion.php" class ="back_btn">Retour</a> 
			<h2>Modifier</h2> 
			<p class="erreur_message">
			    Veuillez remplir tous les champs 
			</p> 
		  </div> 
		   <form action ="modification.php"method="POST">
		    <label> Identifiant </label>
            <input type="text" name="idprod">
		    <label> Prix </label>
            <input type="text" name="Prix">

            <input type="submit" value="Modifier" name="button">			
		   </form> 
	  </body>
  
  </html>