<?php
date_default_timezone_set('EST');

/**
 * Template Name: Commande
 */
session_start();

$input = [
    "semaine" => "",
    "prenom" => "",
    "nom" => "",
    "email" => "",
    "telephone" => "",
    "semaine" => "",
];

$error = [
    "error-prenom" => "",
    "error-nom" => "",
    "error-email" => "",
    "error-telephone" => "",
    "error-menu" => "",
];

$popUpActive = "";
if (isset($_SESSION["success"])) {
    if ($_SESSION["success"]) {
        $popUpActive = "active";
    }
}

foreach ($input as $key => $value) {
    if (isset($_SESSION[$key])) $input[$key] = $_SESSION[$key];
}

foreach ($error as $key => $value) {
    if (isset($_SESSION[$key])) $error[$key] = $_SESSION[$key];
}


function dateToFrench($date)
{
    $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $frenchMonths = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($englishMonths, $frenchMonths, $date);
}
function dateToFrenchAbv($date)
{
    $englishMonthsAbv = array('Jan', 'Feb', 'Mar', 'Avr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $frenchMonthsAbv = array('Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc');
    return str_replace($englishMonthsAbv, $frenchMonthsAbv, $date);
}

$thisWeek = 1;
for ($i = 1; $i <= 5; $i++) {
    $dateFriday = date('Y-m-d', strtotime('-2 day', strtotime(str_replace('/', '-', get_field("date_semaine_" . $i)))));
    $todayDate = date('Y-m-d');
    if ($todayDate <= $dateFriday) {
        $thisWeek = $i;
        break;
    }
}

get_header();
?>
<main id="commande">
    <div id="show-menu" style="background-image: url(<?= get_field("image_hero") ?>);">
        <div class="content">
            <h2>Menu</h2>
            <?php include dirname(__FILE__) . '/../blocks/menu-month.php'; ?>
            <div class="download-menu-button">
                <?php $allField = [
                    1 => "menu_de_la_semaine_bouton",
                    2 => "menu_fete_bouton",
                    3 => "menu_autres_bouton"
                ];
                for ($i = 1; $i <= 3; $i++) :
                    $field = get_field($allField[$i]);
                    $url = $field["link"];
                    $texte = $field["texte"];
                    if ($url) : ?>
                        <a href="<?= $url ?>" target="_blank"><?= $texte ?></a>
                <?php endif;
                endfor; ?>
            </div>
        </div>
    </div>
    <?php $banner = get_field("banner"); ?>
    <?php if ($banner["description"] && $banner["title"]) : ?>
        <div id="banner" style="background-color:<?= $banner["color_background"] ?>;">
            <?php if ($banner["image_gauche"]) : ?>
                <img src="<?= $banner["image_gauche"] ?>">
            <?php endif; ?>
            <div class="texte">
                <h3 style="color:<?= $banner["color_texte"] ?>;"><?= $banner["title"] ?></h3>
                <p style="color:<?= $banner["color_texte"] ?>;"><?= $banner["description"] ?></p>
            </div>
            <?php if ($banner["image_droite"]) : ?>
                <img src="<?= $banner["image_droite"] ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div id="input-menu">
        <h2>Commandez</h2>
        <form method="post" action="/commande-verification/">
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
            <div class="select-week">
                <label for="semaine">
                    <h4>Semaine à commander</h4>
                </label>
                <span class="select">
                    <select name="semaine">
                        <?php for ($week = 1; $week <= 5; $week++) :
                            $wordDate = dateToFrench(date('j F', strtotime(str_replace('/', '-', get_field("date_semaine_" . $week)))));

                            if ($thisWeek <= $week && (!get_field("ferme_regulier_semaine_" . $week) || !get_field("ferme_gourmet_semaine_" . $week))) :
                                if ($input["semaine"] == $week) : ?>
                                    <option value="<?= $week ?>" selected><?= $wordDate ?></option>
                                <?php else : ?>
                                    <option value="<?= $week ?>"><?= $wordDate ?></option>
                        <?php endif;
                            endif;
                        endfor; ?>
                    </select>
                </span>
            </div>
            <?php $allWeek = [1 => "Lundi", 2 => "Mardi", 3 => "Mercredi", 4 => "Jeudi", 5 => "Vendredi"]; ?>
            <div class="content">
                <div class="regulier">
                    <h3><span>Régulier</span></h3>
                    <div class="content">
                        <?php $mealKind = "regulier";
                        for ($week = 1; $week <= 5; $week++) :
                            include dirname(__FILE__) . '/../blocks/form-meal-week.php';
                        endfor; ?>
                    </div>
                </div>
                <div class="border"></div>
                <div class="gourmet">
                    <h3><span>Gourmet</span></h3>
                    <div class="content">
                        <?php $mealKind = "gourmet";
                        for ($week = 1; $week <= 5; $week++) :
                            include dirname(__FILE__) . '/../blocks/form-meal-week.php';
                        endfor; ?>
                    </div>
                </div>
            </div>
            <p class="error"><?= $error["error-menu"] ?></p>
            <div class="group-form-menu">
                <div class="form-menu">
                    <label class="tarifs-totaux-label" for="tarifs-totaux">
                        <h4>Total</h4>
                    </label>
                    <div class="tarifs-totaux">0.00 $</div>
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Envoyer ma commande" name="submit">
            </div>
        </form>
    </div>
    <div id="pop-up-commande-envoyer" class="pop-up <?= $popUpActive ?>">
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
            <div class="border-circle border-circle-1">
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
<script>
    var prices = [
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <?php $tarif = get_field("tarifs_" . $i); ?>[
                <?php for ($j = 1; $j <= 4; $j++) : ?> <?= $tarif["portion_" . $j] ?>,
                <?php endfor; ?>
            ],
        <?php endfor; ?>
    ];
</script>
<?php get_footer(); ?>