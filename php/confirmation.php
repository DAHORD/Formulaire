<?php
// Vérifie que le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fonction pour sécuriser les entrées utilisateur en supprimant les espaces et en échappant les caractères spéciaux
    function secureInput($data) {
        return htmlspecialchars(trim($data));  
    }

    // Récupération et sécurisation des données du formulaire
    $nom = secureInput($_POST['nom']) ? secureInput($_POST['nom']) : 'N/A';
    $prenom = secureInput($_POST['prenom']) ? secureInput($_POST['prenom']) : 'N/A';
    $like = secureInput($_POST['like']) ? secureInput($_POST['like']) : 'N/A';
    $presence = isset($_POST['presence']) ? 'Oui' : 'Non';
    $prefere = secureInput($_POST['prefere']) ? secureInput($_POST['prefere']) : 'N/A';
} else {
    // Si la page est accédée directement sans données, rediriger vers le formulaire
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Confirmation d'envoi</title>
    <link rel="stylesheet" href="../style/style2.css"/>
    <style>
    /* Applique un dégradé de fond à la page et centre le contenu */
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298); /* Dégradé bleu */
        font-family: 'Roboto', sans-serif; /* Police moderne et lisible */
        margin: 0;
        padding: 0;
        display: flex; /* Permet de centrer le contenu */
        justify-content: center; /* Centre horizontalement */
        align-items: center; /* Centre verticalement */
        min-height: 100vh; /* Hauteur minimale de la page */
        color: #fff; /* Texte blanc */
    }

    /* Style du conteneur principal */
    .container {
        background: #ffffff; /* Fond blanc */
        border-radius: 16px; /* Coins arrondis */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre pour un effet de profondeur */
        width: 90%; /* Largeur relative à l'écran */
        max-width: 600px; /* Largeur maximale */
        padding: 40px; /* Espacement interne */
        overflow: hidden; /* Cache le contenu débordant */
        color: #333; /* Couleur du texte */
    }

    /* Style de l'en-tête */
    .header h1 {
        font-size: 28px; /* Taille de la police */
        margin-bottom: 10px; /* Espacement en bas */
        color: #1e3c72; /* Couleur bleue */
        text-align: center; /* Centrage du texte */
    }

    /* Style du texte récapitulatif */
    .recap {
        font-size: 18px; /* Taille de la police */
        margin-bottom: 20px; /* Espacement en bas */
        text-align: center; /* Centrage du texte */
        color: #555; /* Couleur grise */
    }

    /* Style des sections d'information */
    .info-section {
        display: flex; /* Disposition en ligne */
        justify-content: space-between; /* Espacement entre les éléments */
        align-items: center; /* Alignement vertical */
        padding: 10px 0; /* Espacement interne vertical */
        border-bottom: 1px solid #eee; /* Ligne de séparation */
        transition: background 0.3s ease; /* Transition pour l'effet au survol */
    }

    /* Supprime la bordure pour la dernière section */
    .info-section:last-of-type {
        border-bottom: none;
    }

    /* Change le fond au survol */
    .info-section:hover {
        background: #f7f7f7; /* Fond gris clair */
    }

    /* Style des étiquettes */
    label {
        display: inline-block; /* Affichage en ligne */
        width: auto; /* Largeur automatique */
        white-space: nowrap; /* Empêche le retour à la ligne */
        font-size: 16px; /* Taille de la police */
        margin: 5px; /* Espacement autour */
    }

    /* Style des étiquettes dans les sections */
    .label {
        margin-left: 30px; /* Décalage à gauche */
        font-weight: 600; /* Texte en gras */
        color: #555; /* Couleur grise */
    }

    /* Style des valeurs affichées */
    .value {
        flex: 2; /* Prend plus d'espace dans le conteneur flex */
        text-align: right; /* Alignement à droite */
        margin-right: 30px; /* Décalage à droite */
        color: #000; /* Texte noir */
    }

    /* Conteneur pour le bouton de soumission */
    .submit-container {
        text-align: center; /* Centrage du contenu */
        margin-top: 30px; /* Espacement en haut */
    }

    /* Style du bouton de soumission */
    .submit-btn {
        background: linear-gradient(135deg, #1e3c72, #2a5298); /* Dégradé bleu */
        color: #fff; /* Texte blanc */
        border: none; /* Pas de bordure */
        border-radius: 8px; /* Coins arrondis */
        padding: 12px 24px; /* Espacement interne */
        font-size: 16px; /* Taille de la police */
        font-weight: 600; /* Texte en gras */
        cursor: pointer; /* Curseur en forme de main */
        transition: all 0.3s ease; /* Transition pour les effets */
    }

    /* Effet au survol du bouton */
    .submit-btn:hover {
        transform: translateY(-3px); /* Déplace légèrement vers le haut */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre pour un effet de profondeur */
    }

    /* Style du bouton pour afficher/masquer le mot de passe */
    #togglePassword {
        background: none; /* Pas de fond */
        border: none; /* Pas de bordure */
        color: #1e3c72; /* Couleur bleue */
        font-size: 14px; /* Taille de la police */
        cursor: pointer; /* Curseur en forme de main */
        margin-left: 10px; /* Décalage à gauche */
    }

    /* Effet au survol du bouton togglePassword */
    #togglePassword:hover {
        color: #2a5298; /* Couleur bleue plus claire */
        text-decoration: underline; /* Soulignement */
    }
</style>
</head>
<body>
  <div class="container">
        <div class="header">
            <!-- "htmlspecialchars()" garantit que les caractères spéciaux ne seront pas interprétés comme du code HTML -->
            <h1>Merci d'avoir répondu, <?php echo htmlspecialchars($prenom) . " " . htmlspecialchars($nom); ?> !</h1>
        </div>
        <p class="recap">Veuillez tout de même vérifier les informations et confirmer votre envoi :</p>

    <div id="confirmation">
      <div class="info-section" id="nom">
        <span class="label">Nom :</span>
        <span class="value"><?php echo htmlspecialchars($nom); ?></span>
      </div>

      <div class="info-section" id="prenom">
        <span class="label">Prénom :</span>
        <span class="value"><?php echo htmlspecialchars($prenom); ?></span>
      </div>

      <div class="info-section" id="like">
        <span class="label">Tu aimes la NSI :</span>
        <span class="value"><?php echo htmlspecialchars($like); ?></span>
      </div>

      <div class="info-section" id="presence">
        <span class="label">Présence à la réunion :</span>
        <span class="value"><?php echo htmlspecialchars($presence); ?></span>
      </div>

      <div class="info-section" id="prefere">
        <span class="label">Ta matière préférée :</span>
        <span class="value"><?php echo htmlspecialchars($prefere); ?></span>
      </div>
    </div>

  <div class="submit-container">
    <form action="./enregistrer.php" method="post">
      <input type="hidden" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
      <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>">
      <input type="hidden" name="like" value="<?php echo htmlspecialchars($like); ?>">
      <input type="hidden" name="presence" value="<?php echo htmlspecialchars($presence); ?>">
      <input type="hidden" name="prefere" value="<?php echo htmlspecialchars($prefere); ?>">
      <button type="submit" class="submit-btn">Confirmer l'envoi</button>
    </form>
  </div>
</div>

  </body>
</html>