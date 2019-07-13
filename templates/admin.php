<div class="wrap">
	<h1>GattoVerde Plugin</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Menage Settings</a></li>
		<li><a href="#tab-2">Update</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1-1" class="tab-pane active">
	
			<form action="options.php" method="post">
				<?php 
					settings_fields( 'gattoverde_plugin_settings' );
					do_settings_sections( 'gattoverde_plugin' );
					submit_button();
				?>
			</form>
		
		</div><!-- end tab1 -->
		

		<div id="tab-2" class="tab-pane">
			<h3>Update</h3>
		</div><!-- end tab2 -->
		
		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div><!-- end tab3 -->

	</div>

</div>