<?php
// Vérifie si le script a été appelé via une méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fonction pour sécuriser les entrées utilisateur en supprimant les espaces et en échappant les caractères spéciaux
    function secureInput($data) {
        return htmlspecialchars(trim($data));
    }
    // Création d'un tableau associatif contenant les données soumises
    $dataEntry = [
        "nom"       => secureInput($_POST['nom']) ? secureInput($_POST['nom']) : 'N/A',
        "prenom"    => secureInput($_POST['prenom']) ? secureInput($_POST['prenom']) : 'N/A',
        "like"      => secureInput($_POST['like']) ? secureInput($_POST['like']) : 'N/A',
        "presence"  => secureInput($_POST['presence']) ? 'Oui' : 'Non',
        "prefere"   => secureInput($_POST['prefere']) ? secureInput($_POST['prefere']) : 'N/A',
        "date"      => date("Y-m-d H:i:s"),
    ];

    $jsonFile = "../data/data.json"; // Nom du fichier JSON pour stocker les données

    // Vérifie si le fichier JSON existe
    if (file_exists($jsonFile)) {
        $jsonContent = file_get_contents($jsonFile); // Charge le contenu du fichier
        $dataArray = json_decode($jsonContent, true); // Décode le fichier JSON en tableau PHP
        if (!is_array($dataArray)) { // Si le contenu n'est pas un tableau, initialise un tableau vide
            $dataArray = []; 
        }
    } else {
        $dataArray = []; // Initialise un tableau vide si le fichier n'existe pas
    } 

    // Ajoute les nouvelles données au tableau existant
    $dataArray[] = $dataEntry;

    // Encode le tableau complet en JSON avec une mise en forme lisible
    $jsonData = json_encode($dataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Écrit les données dans le fichier JSON avec un verrouillage
    $saved = file_put_contents($jsonFile, $jsonData); 
    if ($saved === false) { // Vérifie si l'écriture a échoué
        echo "Erreur lors de l'enregistrement des données.";
        exit();
    }

    // Redirige l'utilisateur vers la page de remerciement après un enregistrement réussi
    header("Location: ../html/merci.html");
    exit();

} else {
    // Rediriger l'accès direct au script vers le formulaire de départ
    header("Location: ../index.html");
    exit();
}
?>
