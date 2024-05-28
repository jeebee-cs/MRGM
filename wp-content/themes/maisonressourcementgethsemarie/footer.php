<footer id="colophon">
	<?= do_shortcode('[wpgmza id="1"]') ?>
	<div class="menu">
		<div class="contact">
			<h2>Contact</h2>
			<div class="info">
				<?php wp_nav_menu(["menu" => "Footer Contact"]) ?>
				<?php wp_nav_menu(["menu" => "Footer Contact Info"]) ?>
			</div>
			<?php wp_nav_menu(["menu" => "Footer Contact Us"]) ?>
		</div>
		<?php wp_nav_menu(["menu" => "Footer Logo"]) ?>
		<div class="business-hours">
			<h2>Horaire</h2>
			<div>
				<?php wp_nav_menu(["menu" => "Footer Jour"]) ?>
				<?php wp_nav_menu(["menu" => "Footer Horaire"]) ?>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>
</body>

</html>