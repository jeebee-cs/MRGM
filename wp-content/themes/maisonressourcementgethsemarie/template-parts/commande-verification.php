<?php

/**
 * Template Name: Commande Verification
 */
require dirname(__FILE__) . '/../blocks/submit-menu.php';
session_start();

function dateToFrench($date)
{
    $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $frenchMonths = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($englishMonths, $frenchMonths, $date);
}

$input = [
    "semaine" => "",
    "prenom" => "",
    "nom" => "",
    "email" => "",
    "telephone" => "",
    "semaine" => "",
];

foreach ($input as $key => $value) {
    if (isset($_POST[$key])) $input[$key] = $_POST[$key];
}

$error = [
    "error-prenom" => "",
    "error-nom" => "",
    "error-email" => "",
    "error-telephone" => "",
    "error-menu" => "",
];

if (isset($_POST['submit'])) {
    $hasError = false;

    $input["telephone"] = preg_replace('/[^0-9]/', '', $input["telephone"]);

    if ($input["prenom"] == "") {
        $error["error-prenom"] = "Prénom non valide. Minimum 1 caractère.";
        $hasError = true;
    } else if (preg_match('~[0-9]+~', $input["prenom"])) {
        $error["error-prenom"] = "Prénom non valide. Seulement des lettres.";
        $hasError = true;
    }
    if ($input["nom"] == "") {
        $error["error-nom"] = "Nom non valide. Minimum 1 caractère.";
        $hasError = true;
    } else if (preg_match('~[0-9]+~', $input["nom"])) {
        $error["error-nom"] = "Nom non valide. Seulement des lettres.";
        $hasError = true;
    }
    if (!strpos($input["email"], '@') || !strpos($input["email"], '.')) {
        $error["error-email"] = "Adresse courriel non valide. Format valide : ****@****.***.";
        $hasError = true;
    }
    if (strlen(preg_replace('/[^0-9]/', '', $input["telephone"])) != 10) {
        $error["error-telephone"] = "Numéro de téléphone non valide. Format valide : (###)###-####.";
        $hasError = true;
    }

    $foodIsSelected = false;

    for ($i = 1; $i <= 2; $i++) {
        $typeMeal = "";
        if ($i == 1) $typeMeal = "regulier";
        if ($i == 2) $typeMeal = "gourmet";
        for ($j = 1; $j <= 5; $j++) {
            $portion = 0;
            $quantite = 0;

            if (isset($_POST["portion-" . $j . "-semaine-" . $input["semaine"] . "-" . $typeMeal])) {
                $portion = $_POST["portion-" . $j . "-semaine-" . $input["semaine"] . "-" . $typeMeal];
            }
            if (isset($_POST["quantite-" . $j . "-semaine-" . $input["semaine"] . "-" . $typeMeal])) {
                $quantite = $_POST["quantite-" . $j . "-semaine-" . $input["semaine"] . "-" . $typeMeal];
            }

            if ($portion != 0 && $quantite != 0) {
                $foodIsSelected = true;
            }
        }
    }

    if (!$foodIsSelected) {
        $error["error-menu"] = "Aucun plats n'est actuellement choisi.";;
        $hasError = true;
    }

    foreach ($error as $key => $value) {
        if (isset($error[$key])) $_SESSION[$key] = $error[$key];
    }

    foreach ($input as $key => $value) {
        if (isset($input[$key])) $_SESSION[$key] = $input[$key];
    }

    $_SESSION["success"] = false;

    if (!$hasError) {
        $_SESSION["success"] = true;
        $input["telephone"] = "(" . substr($input["telephone"], 0, 3) . ")" . substr($input["telephone"], 3, 3) . "-" . substr($input["telephone"], 6);
        SubmitMenu();
    }
    header("Location: /commande");
}
