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
        echo '<h2>Résultats de la vérification :</h2>';
        echo '<table border="1">';
        echo '<tr><th>Breadcrumbs</th><th>Est Cliquable</th><th>Lien (href)</th></tr>';

        // Parcourez les éléments de Breadcrumbs
        foreach ($breadcrumbs as $breadcrumb) {
            $isClickable = false;
            $linkHref = '';

            // Recherchez des liens à l'intérieur de l'élément de Breadcrumbs
            $breadcrumbLinks = $xpath->query(".//a", $breadcrumb);

            // Parcourez les liens
            foreach ($breadcrumbLinks as $link) {
                if ($link->hasAttribute('href')) {
                    $isClickable = true;
                    $linkHref = $link->getAttribute('href');
                }
            }

            echo '<tr>';
            echo '<td>' . $breadcrumb->nodeValue . '</td>';
            echo '<td>' . ($isClickable ? 'Oui' : 'Non') . '</td>';
            echo '<td>' . $linkHref . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Aucun Breadcrumbs n\'a été trouvé sur la page.';
    }
} else {
    echo 'URL non spécifiée.';
}
?>