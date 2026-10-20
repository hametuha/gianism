<?php

defined( 'ABSPATH' ) or die();

/** @var \Gianism\UI\SettingScreen $this */
/** @var \Gianism\Service\Google $instance */

?>
<h3>X(Twitter)</h3>

<p class="description"><?php _e( 'First of all, your X account is required. If you don\'t have one, create it at <a href="https://x.com">X</a>', 'gianism' ); ?></p>

<h4>Step1. <?php esc_html_e( 'Create twitter application', 'gianism' ); ?></h4>

<p><?php _e( 'Go to <a href="https://dev.twitter.com">Twitter Developer</a> and sign in with your twitter account. Then go to <a href="https://dev.twitter.com/apps">My Applications</a> and click <code>Create new application</code>.', 'gianism' ); ?></p>

<p><?php sprintf( __( 'In Application detail section, enter application name(same as <code>%s</code> recommended), description and Website. If you are not bot, enter reCaptha and creation flow will be done :)', 'gianism' ), get_bloginfo( 'name' ) ); ?></p>

<p><?php _e( 'Now you have new application. Go to your new app\'s detail page. On <code>Settings</code> tab, various information can be editted. Besides the required informations, you had better to upload Application icon which will be displayed on authentication screen.', 'gianism' ); ?></p>


<table class="gianism-example-table">
	<tr>
		<th>Name</th>
		<td>
			<?php _e( 'App name. Blog name is recommended. User will see this name on authentication screen.', 'gianism' ); ?>
			<br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'gianism' ), get_bloginfo( 'name' ) ); ?>
		</td>
	</tr>
	<tr>
		<th>Description</th>
		<td>
			<?php _e( 'Description about your site. It is recommended explaining your user why you request authentication.', 'gianism' ); ?>
			<br/>
		</td>
	</tr>
	<tr>
		<th>Website</th>
		<td>
			<?php _e( 'Website\'s URL. Use this blog\'s URL', 'gianism' ); ?><br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'gianism' ), home_url( '/', 'http' ) ); ?>
		</td>
	</tr>
	<tr>
		<th>Callback URL</th>
		<td>
			<?php _e( 'The URL where user will be redirect after authentication. If you use other application which use twitter OAuth, leave this blank.', 'gianism' ); ?>
			<br/>
			<?php printf( __( '<strong>e.g.</strong> <code>%s</code>', 'gianism' ), home_url( '/twitter/', $this->option->is_ssl_required() ? 'https' : 'http' ) ); ?>
		</td>
	</tr>
</table>

<p><?php _e( 'Take care of application access type. Default is <code>readonly</code> and it\'s sufficient. Users tend to avoid strong access like <code>Read and Write</code>.', 'gianism' ); ?></p>

<p><?php _e( 'Now you have finished setting application up.', 'gianism' ); ?></p>

<h4>Step2. <?php _e( 'Enter app information', 'gianism' ); ?></h4>

<p><?php _e( 'Gianism requires 5 information. Go to <a href="https://dev.twitter.com/apps">your application\'s detail page</a> and click <code>OAuth tools</code> tab. There, you can get 4 information below: ', 'gianism' ); ?></p>

<ol>
	<li>Consumer key</li>
	<li>Consumer secret</li>
	<li>Access token</li>
	<li>Access token secret</li>
</ol>

<p><?php printf( __( 'Besides above, your twitter screen name will be required. Now please enter these credentials on <a href="%s">Setting page</a>.', 'gianism' ), $this->setting_url() ); ?></p>

