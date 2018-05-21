<h1>pk techie Theme Support</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="pktechie-general-form">
	<?php settings_fields( 'pktechie-theme-support' ); ?>
	<?php do_settings_sections( 'pk_techie_theme' ); ?>
	<?php submit_button(); ?>
</form>