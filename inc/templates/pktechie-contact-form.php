<h1>pk techie Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="pktechie-general-form">
	<?php settings_fields( 'pktechie-contact-options' ); ?>
	<?php do_settings_sections( 'pk_techie_theme_contact' ); ?>
	<?php submit_button(); ?>
</form>