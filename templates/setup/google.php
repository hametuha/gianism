<?php

defined( 'ABSPATH' ) or die();

/** @var \Gianism\UI\SettingScreen $this */
/** @var \Gianism\Service\Google $instance */

?>
<h3>Google</h3>

<p class="description"><?php _e( 'Google API system is very complex, but don\'t be afraid. Anyway if you don\'t have Google account, go to <a hreF="https://www.google.com/accounts/NewAccount">Create Google account</a> and get it.', 'wp-gianism' ); ?></p>

<h4>Step1. <?php _e( 'Create new Project', 'wp-gianism' ); ?></h4>

<p><?php _e( 'Go to <a href="https://cloud.google.com/console/project">Google API Console &gt; Projects</a> and click <code>Create Project</code>. SMS verification will be required. After finishing, click your new project\'s name and go setting page.', 'wp-gianism' ); ?></p>

<p><?php _e( 'Now, On project page, clicking <code>API &amp; OAuth</code> menu in sidebar, then you are on <code>APIs</code> page which will enable various APIs one by one. Turn Google+ API <code>ON</code>.', 'wp-gianism' ); ?></p>

<p class="notice">
	<?php _e( 'Google API Console is too simple but values to be set are not simple, so you will be easily loose yourself. Be care of where you are.', 'wp-gianism' ); ?>
</p>

<p><?php __( 'Then, go to <code>Credentials</code> below <code>API &amp; auth</code> and click <code>CREATE NEW  CLIENT ID</code>.  Enter below:', 'wp-gianism' ); ?></p>

<table class="gianism-example-table">
	<tr>
		<th>Application type</th>
		<td>
			<?php printf( __( 'Select <code>%s</code>.', 'wp-gianism' ), 'Web application' ); ?><br/>
		</td>
	</tr>
	<tr>
		<th>Authorized Javascript origin</th>
		<td>
			<code><?php echo home_url( '/', 'http' ); ?></code><br/>
			<code><?php echo home_url( '/', 'https' ); ?></code>
		</td>
	</tr>
	<tr>
		<th>Authorized redirect URI</th>
		<td>
			<code><?php echo home_url( '/google-auth/', $this->option->is_ssl_required() ? 'https' : 'http' ); ?></code>
		</td>
	</tr>
</table>

<p><?php _e( 'There you get <code>Client ID for web application</code> section, which provides <code>Client ID</code> and <code>Client secret</code>.', 'wp-gianism' ); ?></p>

<p><?php printf( __( 'Finally, you must set up your application. Go to <code>Consent screen</code> below <code>APIs &amp; oauth</code>, and change Product name to your own. <code>%s</code> is recommended.', 'wp-gianism' ), get_bloginfo( 'name' ) ); ?></p>

<h4>Step2. <?php _e( 'Enter API Information', 'wp-gianism' ); ?></h4>

<p><?php printf( __( 'Input and save 2 information(Client ID and Client Secret) on <a href="%s">WordPress admin screen</a>.', 'wp-gianism' ), $this->setting_url() ); ?></p>
