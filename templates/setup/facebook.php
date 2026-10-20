<?php

defined( 'ABSPATH' ) or die();

/** @var \Gianism\UI\SettingScreen $this */
/** @var \Gianism\Service\Facebook $instance */

?>
<h3>Facebook</h3>

<p class="description"><?php _e( 'First of all, Facebook account is required. If you don\'t have one, create it at <a href="https://www.facebook.com">facebook.com</a>', 'wp-gianism' ); ?></p>

<h4>Step1. <?php _e( 'Create App on Facebook developers', 'wp-gianism' ); ?></h4>

<p><?php _e( 'Gianism refers user\'s Facebook credential as Facebook app. Go to <a href="https://developers.facebook.com">Facebook developers</a> and sign up as developer. On registeration flow, you will have to enter mobile phone number or credit card number.', 'wp-gianism' ); ?></p>

<p><?php printf( __( 'Authenticated as developer, go to <a href="https://developers.facebook.com/apps">Apps</a> and create new App. You can enter name as you like, but the same name as WordPress site name <code>%s</code> is recommended for usability.', 'wp-gianism' ), get_bloginfo( 'name' ) ); ?></p>

<p><?php _e( 'Though App credential is available for various usage(iOS app, Android app, Page tab, etc), minimum requirments are like below.', 'wp-gianism' ); ?></p>

<table class="gianism-example-table">
	<tr>
		<th>Display Name</th>
		<td>
			<?php _e( 'App name. Blog name is recommended. User will see this name on authentication screen.', 'wp-gianism' ); ?>
			<br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
		</td>
	</tr>
	<tr>
		<th>Namespace</th>
		<td>
			<?php _e( 'Unique string which identifies your app.', 'wp-gianism' ); ?><br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_html( $_SERVER['HTTP_HOST'] ) ); ?>
		</td>
	</tr>
	<tr>
		<th><?php _e( 'Contact mail address', 'wp-gianism' ); ?></th>
		<td>
			<?php _e( 'Contact mail address. It will be displayed on authentication screen on Facebook.', 'wp-gianism' ); ?>
			<br/>
			<?php
			// translators: %s is email
			printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_html( $this->option->get( 'admin_email' ) ) );
			?>
		</td>
	</tr>
	<tr>
		<th>App Domains</th>
		<td>
			<?php _e( 'Your domain.', 'wp-gianism' ); ?><br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_html( $_SERVER['HTTP_HOST'] ) ); ?>
		</td>
	</tr>
	<tr>
		<th>Sandbox Mode</th>
		<td>
			<?php _e( 'On development environment or test flight, turn sandbox ON.', 'wp-gianism' ); ?><br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_html__( 'OFF', 'wp-gianism' ) ); ?>
		</td>
	</tr>
	<tr>
		<th>Type</th>
		<td>
			<?php _e( 'You can activate several connection types, but below is required.', 'wp-gianism' ); ?><br/>
			<code>Website with Facebook Login</code>
		</td>
	</tr>
	<tr>
		<th>Valid redirect URIs</th>
		<td>
			<?php _e( 'The URL where user will be redirected after authentication.', 'wp-gianism' ); ?>
			<br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'wp-gianism' ), esc_url( home_url( "/{$instance->url_prefix}/", $this->option->is_ssl_required() ? 'https' : 'http' ) ) ); ?>
		</td>
	</tr>
</table>

<h4>Step2. <?php _e( 'Enter App ID and App secret', 'wp-gianism' ); ?></h4>

<p><?php printf( __( 'Once you create Facebook App, App ID and App secret will be provided. Now you can enter it on <a href="%s">WordPress Admin screen</a>.', 'wp-gianism' ), $this->setting_url() ); ?></p>
