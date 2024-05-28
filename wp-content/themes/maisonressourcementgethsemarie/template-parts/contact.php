<?php

/**
 * Template Name: Contact
 */
require dirname(__FILE__) . '/../blocks/submit-contact.php';

$input = [
    "prenom" => "",
    "nom" => "",
    "email" => "",
    "telephone" => "",
    "message" => "",
];

foreach ($input as $key => $value) {
    if (isset($_POST[$key])) $input[$key] = $_POST[$key];
}

$error = [
    "error-prenom" => "",
    "error-nom" => "",
    "error-email" => "",
    "error-telephone" => "",
    "error-message" => "",
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
    if ($input["message"] == "") {
        $error["error-message"] = "Message non valide. Minimum 1 caractère.";
        $hasError = true;
    }


    $popUpActive = "";
    if (!$hasError) {
        $input["telephone"] = "(" . substr($input["telephone"], 0, 3) . ")" . substr($input["telephone"], 3, 3) . "-" . substr($input["telephone"], 6);
        $popUpActive = "active";
        SubmitContact();
    }
}

get_header();
?>
<main id="contact">
    <?php $hero = get_field("hero") ?>
    <div id="image-texte" style="background-image: url(<?= $hero["image"] ?>);">
        <div class="content">
            <div class="texte">
                <h1>
                    <?= $hero["titre"] ?>
                </h1>
                <p>
                    <?= $hero["description"] ?>
                </p>
            </div>
        </div>
    </div>
    <div id="contact-form">
        <form method="post" action="">
            <div class="group-form-menu">
                <div class="form-menu">
                    <label for="prenom">
                        <h4>Prénom*</h4>
                    </label>
                    <input type="text" name="prenom" value="<?= $input["prenom"] ?>" maxlength="30">
                    <p class="error"><?= $error["error-prenom"] ?></p>
                </div>
                <div class="form-menu">
                    <label for="nom">
                        <h4>Nom de famille*</h4>
                    </label>
                    <input type="text" name="nom" value="<?= $input["nom"]  ?>" maxlength="30">
                    <p class="error"><?= $error["error-nom"] ?></p>
                </div>
            </div>
            <div class="group-form-menu">
                <div class="form-menu">
                    <label for="email">
                        <h4>Adresse courriel*</h4>
                    </label>
                    <input type="email" name="email" value="<?= $input["email"]  ?>" maxlength="60">
                    <p class="error"><?= $error["error-email"] ?></p>
                </div>
                <div class="form-menu">
                    <label for="telephone">
                        <h4>Numero de téléphone*</h4>
                    </label>
                    <input type="tel" name="telephone" value="<?= $input["telephone"]  ?>" maxlength="13">
                    <p class="error"><?= $error["error-telephone"] ?></p>
                </div>
            </div>
            <div class="form-menu">
                <label for="message">
                    <h4>Comment pouvons-nous aider?*</h4>
                </label>
                <textarea name="message" maxlength="8192"><?= $input["message"]  ?></textarea>
                <p class="error"><?= $error["error-message"] ?></p>
            </div>
            <div class="submit">
                <input type="submit" value="Envoyer mon message" name="submit">
            </div>
        </form>
    </div>
    <div id="pop-up-message-envoyer" class="pop-up <?= $popUpActive ?>">
        <?php $popUp = get_field("pop_up"); ?>
        <div class="close">
            <span>x</span>
        </div>
        <div class="doubled-circle">
            <div class="texte">
                <h2>
                    <?= $popUp["titre"] ?>
                </h2>
                <p>
                    <?= $popUp["description"] ?>
                </p>
            </div>
            <div class="border-circle border-circle-2">
                <div class="quarter quarter-1">
                    <div class="border-circle-full"></div>
                </div>
                <div class="quarter quarter-2">
                    <div class="border-circle-full"></div>
                </div>
                <div class="quarter quarter-3">
                    <div class="border-circle-full"></div>
                </div>
                <div class="quarter quarter-4">
                    <div class="border-circle-full"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>