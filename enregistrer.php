<?php
// enregistrer.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Constitution d'un tableau associatif avec les données
    $dataEntry = [
        "nom"       => isset($_POST["nom"]) ? $_POST["nom"] : 'N/A',
        "prenom"    => isset($_POST["prenom"]) ? $_POST["prenom"] : 'N/A',
        "like"      => isset($_POST["like"]) ? $_POST["like"] : 'N/A',
        "presence"  => isset($_POST['presence']) ? 'Oui' : 'Non',
        "prefere"   => isset($_POST["prefere"]) ? $_POST["prefere"] : 'N/A',
        "date"      => date("Y-m-d H:i:s"),
    ];

    $jsonFile = "data.json";

    // Charger les données existantes si le fichier existe, sinon initialiser un tableau vide
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile);
        $dataArray = json_decode($jsonContent, true);
        if (!is_array($dataArray)) {
            $dataArray = [];
        }
    } else {
        $dataArray = [];
    }

    // Ajout de la nouvelle entrée
    $dataArray[] = $dataEntry;

    // Encodage du tableau en JSON avec une mise en forme lisible
    $jsonData = json_encode($dataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Enregistrement dans le fichier avec verrouillage pour éviter les problèmes de concurrence
    $saved = file_put_contents($jsonFile, $jsonData);
    if ($saved === false) {
        echo "Erreur lors de l'enregistrement des données.";
        exit();
    }

    // Redirection vers la page merci.html une fois l'enregistrement effectué
    header("Location: merci.html");
    exit();

} else {
    // Rediriger l'accès direct au script vers le formulaire de départ
    header("Location: index.html");
    exit();
}
?>
