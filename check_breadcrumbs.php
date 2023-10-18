<?php
if (isset($_POST['url'])) {
    $url = $_POST['url'];

    // Récupérez le contenu HTML de la page
    $html = file_get_contents($url);

    // Utilisez un analyseur HTML, par exemple DOMDocument, pour charger le HTML
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    // Créez un objet DOMXPath pour utiliser XPath
    $xpath = new DOMXPath($doc);

    // Exemple : Recherchez des éléments avec la classe "breadcrumbs"
    $breadcrumbs = $xpath->query("//*[contains(@class, 'breadcrumbs')]");

    if ($breadcrumbs->length > 0) {
        echo 'Des Breadcrumbs ont été trouvés sur la page.';
    } else {
        echo 'Aucun Breadcrumbs n\'a été trouvé sur la page.';
    }
} else {
    echo 'URL non spécifiée.';
}
?>