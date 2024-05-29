<?php get_header(); ?>
<main id="accueil">

    <section class="heroContainer">
        <div class="hero">
            <h1 class="heroTitle">Peinturer un renouveau avec la lumière de la vie</h1>
            <button class="orangeBtn" id="rejoignezNousBtn"></button>
        </div>
        <div class="carouselEvents">
            <h2 class="carouselEventsTitle">Ce qui arrive bientôt</h2>
            <div class="carouselEventsPlugin"></div>
            <button class="orangeBtn" id="evenementsBtn">Tous les événements</button>
        </div>
    </section>

    <section class="histoireContainer">
        <h2 class="histoireTitle">Nôtre histoire</h2>
        <div class="rubrique">
            <img src="" alt="" class="rubriqueImage">
            <h3 class="rubriqueTitre">Depuis déjà <?php echo $nbAnnees ?> années</h3>
            <p class="rubriqueDescription">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet cumque totam
                itaque alias dolores ipsam laboriosam reiciendis provident ut? Pariatur reprehenderit quas alias ad?
                Fugiat asperiores harum doloremque unde impedit?
            </p>
        </div>
        <div class="rubrique">
            <img src="" alt="" class="rubriqueImage">
            <h3 class="rubriqueTitle">Réjean est toujours autant animé</h3>
            <p class="rubriqueDescription">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet cumque totam
                itaque alias dolores ipsam laboriosam reiciendis provident ut? Pariatur reprehenderit quas alias ad?
                Fugiat asperiores harum doloremque unde impedit?
            </p>
        </div>
    </section>

    <section class="participants">
        <h2 class="participantsTitle">Des participants satisfaits</h2>
        <div class="carouselParticipants">
            <h4 id="nomDuParticipant"> <?php echo $nomParticipant ?> </h4>
            <p class="descriptionParticipant">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum eveniet
                similique tenetur soluta ullam perferendis quod mollitia illo vitae? Ipsum exercitationem veniam,
                aspernatur unde provident inventore tenetur eligendi deleniti architecto.</p>
            <div class="carouselParticipantsPlugin"></div>
        </div>
        <button class="orangeBtn" id="joindre">Joindre la communautée</button>
    </section>

    <section class="contactezNousForm">
        <h2>Contacter-nous</h2>
        <form action="submit">
            <input type="text" name="prenom" placeholder="Prénom">
            <input type="text" name="nom" placeholder="Nom de famille">
            <input type="email" name="email" placeholder="Email">
            <input type="tel" name="telephone" placeholder="Téléphone">
            <textarea name="message" rows="5" placeholder="Message"></textarea>
            <button type="submit">Contactez Nous</button>
        </form>
    </section>

    <section class="mapPlugin"></section>

</main>
<?php get_footer(); ?>