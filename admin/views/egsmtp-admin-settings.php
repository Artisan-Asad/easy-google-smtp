<?php
add_action( 'admin_menu', 'egsmtp_add_admin_menu' );
add_action( 'admin_init', 'egsmtp_settings_init' );


function egsmtp_add_admin_menu(  ) {

	add_menu_page( 'EGSMTP', 'Easy Google SMTP', 'manage_options', 'egsmtp', 'egsmtp_options_page', 'dashicons-format-status' );

}


function egsmtp_settings_init(  ) {

	register_setting( 'pluginPage', 'egsmtp_settings' );

	add_settings_section(
		'egsmtp_pluginPage_section',
		'',
		'egsmtp_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'egsmtp_field_username',
		__( 'Email Address', 'egsmtp' ),
		'egsmtp_field_username_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

	add_settings_field(
		'egsmtp_field_password',
		__( 'Password', 'egsmtp' ),
		'egsmtp_field_password_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

	add_settings_field(
		'egsmtp_field_protocol',
		__( 'Protocol', 'egsmtp' ),
		'egsmtp_field_protocol_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

	add_settings_field(
		'egsmtp_field_from',
		__( 'Sender Name', 'egsmtp' ),
		'egsmtp_field_from_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

	add_settings_field(
		'egsmtp_field_from_mail',
		__( 'Sender Email', 'egsmtp' ),
		'egsmtp_field_from_mail_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

	add_settings_field(
		'egsmtp_field_auth',
		__( 'Authentication', 'egsmtp' ),
		'egsmtp_field_auth_render',
		'pluginPage',
		'egsmtp_pluginPage_section'
	);

}


function egsmtp_field_username_render(  ) {

	$options = get_option( 'egsmtp_settings' );
	?>
	<input type='email' name='egsmtp_settings[egsmtp_field_username]' value='<?php echo $options['egsmtp_field_username']; ?>'>
	<?php

}


function egsmtp_field_password_render(  ) {

	$options = get_option( 'egsmtp_settings' );
	?>
	<input type='password' name='egsmtp_settings[egsmtp_field_password]' value='<?php echo $options['egsmtp_field_password']; ?>'>
	<?php

}

function egsmtp_field_from_render(  ) {

	$options = get_option( 'egsmtp_settings' );
	?>
	<input type='text' name='egsmtp_settings[egsmtp_field_from]' value='<?php echo $options['egsmtp_field_from']; ?>'>
	<?php

}

function egsmtp_field_from_mail_render(  ) {

	$options = get_option( 'egsmtp_settings' );
	?>
	<input type='text' name='egsmtp_settings[egsmtp_field_from_mail]' value='<?php echo $options['egsmtp_field_from_mail']; ?>' placeholder="optional">
	<?php

}


function egsmtp_field_protocol_render(  ) {
	$options = get_option( 'egsmtp_settings' );
	?>
	<select name='egsmtp_settings[egsmtp_field_protocol]'>
		<option value='ssl' <?php selected( $options['egsmtp_field_protocol'], 'ssl' ); ?>>SSL</option>
		<option value='tls' <?php selected( $options['egsmtp_field_protocol'], 'tls' ); ?>>TLS</option>
	</select>
	<?php
}

function egsmtp_field_auth_render(  ) {
	$options = get_option( 'egsmtp_settings' );
	?>
	<select name='egsmtp_settings[egsmtp_field_auth]'>
		<option value='true' <?php selected( $options['egsmtp_field_auth'], 'true' ); ?>>True</option>
		<option value='false' <?php selected( $options['egsmtp_field_auth'], 'false' ); ?>>False</option>
	</select>
	<?php
}


function egsmtp_settings_section_callback(  ) {
	?> <p>Make sure you have applied proper <a href="#">configration</a> to your Google account before continuing</p> <?php
}


function egsmtp_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>Easy Google SMTP Settings</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>
