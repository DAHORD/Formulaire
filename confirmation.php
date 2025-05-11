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
        /* Modern CSS Styling */
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        .container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            padding: 40px;
            overflow: hidden;
            color: #333;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #1e3c72;
            text-align: center;
        }

        .recap {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
            color: #555;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
            label {
              width: 200px;
            }
        }

        .info-section:last-of-type {
            border-bottom: none;
        }

        .info-section:hover {
            background: #f7f7f7;
        }

        .label {
            font-weight: 600;
            color: #555;
            flex: 1;
        }

        .value {
            flex: 2;
            text-align: right;
            color: #333;
        }

        .submit-container {
            text-align: center;
            margin-top: 30px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #togglePassword {
            background: none;
            border: none;
            color: #1e3c72;
            font-size: 14px;
            cursor: pointer;
            margin-left: 10px;
        }

        #togglePassword:hover {
            color: #2a5298;
            text-decoration: underline;
        }
    </style>
</head>
<body>
  <div class="container">
        <div class="header">
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
    <form action="enregistrer.php" method="post">
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