<div class="wrap">
	<h1>GattoVerde Plugin</h1>
	<?php settings_errors(); ?>

	<form action="options.php" method="post">
		<?php 
			settings_fields( 'gattoverde_options_group' );
			do_settings_sections( 'gattoverde_plugin' );
			submit_button();
		?>
	</form>
</div>