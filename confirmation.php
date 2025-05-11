<?php
// On vérifie que le formulaire a été soumis par la méthode POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fonction de sécurisation des entrées utilisateur
    function secureInput($data) {
        return htmlspecialchars(trim($data));
    }

    // Récupération et sécurisation des données
    $nom = isset($_POST['nom']) ? secureInput($_POST['nom']) : 'N/A';
    $prenom = isset($_POST['prenom']) ? secureInput($_POST['prenom']) : 'N/A';
    $password = isset($_POST['password']) ? secureInput($_POST['password']) : 'N/A';
    $like = isset($_POST['like']) ? secureInput($_POST['like']) : 'N/A';
    $presence = isset($_POST['presence']) ? 'Oui' : 'Non';
    $prefere = isset($_POST['prefere']) ? secureInput($_POST['prefere']) : 'N/A';
} else {
    // Si la page est accédée directement sans données, rediriger vers le formulaire
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Confirmation d'envoi</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        /* Corps centré via flexbox */
        body {
            background: #f0f3f5;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        /* Conteneur principal centré */
        .container {
            width: 90%;
            max-width: 600px;
            margin-top: 40px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        /* En-tête et texte de récapitulatif centrés */
        .header, .recap {
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }
        .recap {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        /* Chaque ligne d'information est centrée grâce au text-align */
        .info-section {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-section:last-of-type {
            border-bottom: none;
        }
        .label {
            width: 150px;
            font-weight: bold;
            color: #444;
            text-align: right;
            margin-right: 10px;
        }
        .value {
            color: #666;
        }
        /* Bouton centré */
        .submit-container {
            text-align: center;
            margin-top: 30px;
        }
        .submit-btn {
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .submit-btn:hover {
            background: #0056b3;
        }
        /* Bouton afficher/cacher */
        #togglePassword {
            background: transparent;
            border: none;
            color: #007BFF;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
  <div class="container">
        <div class="header">
            <h1>Merci d'avoir répondu, <?php echo $prenom," ", $nom; ?> !</h1>
        </div>
        <p class="recap">Veuillez tout de même vérifier les informations et confirmer votre envoi :</p>

    <div id="confirmation">
      <div class="info-section" id="nom">
        <span class="label">Nom :</span>
        <span class="value"><?php echo $nom; ?></span>
      </div>

      <div class="info-section" id="prenom">
        <span class="label">Prénom :</span>
        <span class="value"><?php echo $prenom; ?></span>
      </div>

      <div class="info-section" id="password">
        <span class="label">Mot de passe :</span>
        <span class="value">
          <span id="passwordValue"><?php echo str_repeat('*', strlen($password)); ?></span>
          <button id="togglePassword">Afficher</button>
        </span>
      </div>

      <div class="info-section" id="like">
        <span class="label">Tu aimes la NSI :</span>
        <span class="value"><?php echo $like; ?></span>
      </div>

      <div class="info-section" id="presence">
        <span class="label">Présence à la réunion :</span>
        <span class="value"><?php echo $presence; ?></span>
      </div>

      <div class="info-section" id="prefere">
        <span class="label">Ta matière préférée :</span>
        <span class="value"><?php echo $prefere; ?></span>
      </div>
    </div>

  <div class="submit-container">
    <form action="enregistrer.php" method="post">
      <input type="hidden" name="nom" value="<?php echo $nom; ?>">
      <input type="hidden" name="prenom" value="<?php echo $prenom; ?>">
      <input type="hidden" name="password" value="<?php echo $password; ?>">
      <input type="hidden" name="like" value="<?php echo $like; ?>">
      <input type="hidden" name="presence" value="<?php echo $presence; ?>">
      <input type="hidden" name="prefere" value="<?php echo $prefere; ?>">
      <button type="submit" class="submit-btn">Confirmer l'envoi</button>
    </form>
  </div>
</div>

<script>
    const passwordValue = document.getElementById('passwordValue');
    const togglePasswordButton = document.getElementById('togglePassword');

    // Stocker le mot de passe en clair dans une variable JS
    const password = '<?php echo addslashes($password); ?>';

    togglePasswordButton.addEventListener('click', () => {
      if (togglePasswordButton.textContent === 'Afficher') {
        passwordValue.textContent = password; // Affiche en clair
        togglePasswordButton.textContent = 'Cacher';
      } else {
        passwordValue.textContent = '*'.repeat(password.length); // Génère dynamiquement les étoiles
        togglePasswordButton.textContent = 'Afficher';
      }
    });
  </script>

  </body>
</html>