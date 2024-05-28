<?php

/**
 * Template Name: Acceuil
 */

get_header();
?>
<main id="accueil">
    <div id="video-texte">
        <?php $hero = get_field("hero") ?>
        <div class="content">
            <div class="texte">
                <h1>
                    <?= $hero["titre"] ?>
                </h1>
                <p>
                    <?= $hero["description"] ?>
                </p>
            </div>
            <i>
                <div class="arrow-tail"></div>
                <div class="arrow-head"></div>
            </i>
        </div>
        <iframe src="https://www.youtube.com/embed/<?= $hero["id_video_hero"] ?>?autoplay=1&mute=1&loop=1&playlist=<?= $hero["id_video_hero"] ?>&showinfo=0&controls=0&autohide=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
    <div id="fonctionnement">
        <?php
        $commander = get_field("commander");
        $cueillir = get_field("cueillir");
        $apprecier = get_field("apprecier");
        ?>
        <div class="content">
            <div class="commander">
                <div class="texte">
                    <h3><?= $commander["titre"] ?></h3>
                    <p><?= $commander["description"] ?></p>
                </div>
                <div class="doubled-circle image">
                    <img src="<?= $commander["image"] ?>">
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
            <div class="cueillir">
                <div class="texte">
                    <h3><?= $cueillir["titre"] ?></h3>
                    <p><?= $cueillir["description"] ?></p>
                </div>
                <div class="doubled-circle image">
                    <img src="<?= $cueillir["image"] ?>">
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
            <div class="apprecier">
                <div class="texte">
                    <h3><?= $apprecier["titre"] ?></h3>
                    <p><?= $apprecier["description"] ?></p>
                    <?php $button1 = get_field("bouton_1"); ?>
                    <span>
                        <a href="<?= $button1["link"] ?>"><?= $button1["titre"] ?></a>
                    </span>
                </div>
                <div class="doubled-circle image">
                    <img src="<?= $apprecier["image"] ?>">
                    <div class="border-circle border-circle-3">
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
        </div>
        <div class="side-bar">
            <div class="dots"></div>
            <div class="borders">
                <div class="border"></div>
                <div class="border"></div>
            </div>
            <div class="dots"></div>
        </div>
    </div>
    <div id="carousel-information">
        <div class="swiper-1">
            <div class="swiper-wrapper">
                <?php for ($i = 1; $i <= 6; $i++) :
                    $information = get_field("information_" . $i);
                    if ($information["image"] != "" && $information["titre"] != "") : ?>
                        <div class="information swiper-slide">
                            <div class="image">
                                <img src="<?= $information["image"] ?>">
                            </div>
                            <h4><?= $information["titre"] ?></h4>
                        </div>
                <?php endif;
                endfor; ?>
            </div>
        </div>
        <div class="border-container swiper-3">
            <div class="swiper-wrapper">
                <div class="border swiper-slide"></div>
                <div class="border swiper-slide"></div>
            </div>
        </div>
    </div>
    <div id="commentaires" style="background-image: url('<?= get_field("background") ?>'); background-repeat: no-repeat; background-size: cover;">
        <div class="doubled-circle">
            <div class="carousel-commentaire swiper-2">
                <div class="swiper-wrapper">
                    <?php for ($i = 1; $i <= 3; $i++) :
                        $commentaire = get_field("commentaire_" . $i);
                        if ($commentaire["image"] != "" && $commentaire["titre"] != "") : ?>
                            <div class="commentaire swiper-slide">
                                <img src="<?= $commentaire["image"] ?>">
                                <div class="texte">
                                    <h2><?= $commentaire["titre"] ?></h2>
                                    <p><?= $commentaire["description"] ?></p>
                                </div>
                                <div class="note">
                                    <?php for ($j = 1; $j <= 5; $j++) :
                                        if ($j <= $commentaire["note"]) : ?>
                                            <i class="fas fa-heart"></i>
                                        <?php else : ?>
                                            <i class="far fa-heart"></i>
                                    <?php endif;
                                    endfor; ?>
                                </div>
                            </div>
                    <?php endif;
                    endfor; ?>
                </div>
                <div class="swiper-pagination"></div>
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
        <div class="doubled-circle">
            <div class="carousel-commentaire swiper-2">
                <div class="swiper-wrapper">
                    <?php for ($i = 4; $i <= 6; $i++) :
                        $commentaire = get_field("commentaire_" . $i);
                        if ($commentaire["image"] != "" && $commentaire["titre"] != "") : ?>
                            <div class="commentaire swiper-slide">
                                <img src="<?= $commentaire["image"] ?>">
                                <div class="texte">
                                    <h2><?= $commentaire["titre"] ?></h2>
                                    <p><?= $commentaire["description"] ?></p>
                                </div>
                                <div class="note">
                                    <?php for ($j = 1; $j <= 5; $j++) :
                                        if ($j <= $commentaire["note"]) : ?>
                                            <i class="fas fa-heart"></i>
                                        <?php else : ?>
                                            <i class="far fa-heart"></i>
                                    <?php endif;
                                    endfor; ?>
                                </div>
                            </div>
                    <?php endif;
                    endfor; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="border-circle border-circle-3">
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
    <div id="equipe">
        <?php $equipe = get_field("equipe") ?>
        <div class="texte">
            <h2><?= $equipe["titre"] ?></h2>
            <p><?= $equipe["description"] ?></p>
        </div>
        <div class="doubled-circle image">
            <img src="<?= $equipe["image"] ?>">
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
    <div id="tarifs">
        <?php $tarifs = [];
        $allWeek = [1 => "Lundi", 2 => "Mardi", 3 => "Mercredi", 4 => "Jeudi", 5 => "Vendredi"];
        for ($i = 1; $i <= 5; $i++) :
            array_push($tarifs, get_field("tarifs_" . $i, 8));
        endfor; ?>
        <div class="tarifs">
            <?php for ($i = 1; $i <= 2; $i++) : ?>
                <div class="content">
                    <div class="title">
                        <h2><?= $i ?><?= ($i == 1) ? ' Portion' : ' Portions'; ?></h2>
                        <p>5 repas par semaine</p>
                    </div>
                    <div class="tarif">
                        <?php for ($j = 0; $j <= 4; $j++) : ?>
                            <div class="content">
                                <p><?= $allWeek[$j + 1] ?></p>
                                <span><?= $tarifs[$j]["portion_" . $i] ?> $</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="total">
                        <?php $total = 0;
                        for ($j = 0; $j <= 4; $j++) :
                            $total += $tarifs[$j]["portion_" . $i];
                        endfor; ?>
                        <p>Total</p>
                        <span><?= $total ?> $</span>
                    </div>
                </div>
                <?php if ($i == 1) : ?>
                    <div class="border"></div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="tarifs">
            <?php for ($i = 3; $i <= 4; $i++) : ?>
                <div class="content">
                    <div class="title">
                        <h2><?= $i ?><?= ($i == 1) ? ' Portion' : ' Portions'; ?></h2>
                        <p>5 repas par semaine</p>
                    </div>
                    <div class="tarif">
                        <?php for ($j = 0; $j <= 4; $j++) : ?>
                            <div class="content">
                                <p><?= $allWeek[$j + 1] ?></p>
                                <span><?= $tarifs[$j]["portion_" . $i] ?> $</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="total">
                        <?php $total = 0;
                        for ($j = 0; $j <= 4; $j++) :
                            $total += $tarifs[$j]["portion_" . $i];
                        endfor; ?>
                        <p>Total</p>
                        <span><?= $total ?> $</span>
                    </div>
                </div>
                <?php if ($i == 3) : ?>
                    <div class="border"></div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <?php $button2 = get_field("bouton_2"); ?>
        <span><a href="<?= $button2["link"] ?>"><?= $button2["titre"] ?></a></span>
    </div>
    </div>
</main>
<?php
get_footer();
?>