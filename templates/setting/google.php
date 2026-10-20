<?php
/** @var \Gianism\UI\Screen $this */
/** @var \Gianism\Service\Google $instance */

defined( 'ABSPATH' ) || exit;
?>

<h3>Google</h3>
<table class="form-table">
	<tbody>
	<tr>
		<th><label><?php printf( __( 'Connect with %s', 'wp-gianism' ), 'Google' ); ?></label></th>
		<td>
			<?php $this->switch_button( 'ggl_enabled', $this->option->is_enabled( 'google' ) ); ?>
			<p class="description">
				<?php printf( __( 'You have to create %1$s App <a target="_blank" href="%2$s">here</a> to get required infomation.', 'wp-gianism' ), 'Google API Console', 'https://code.google.com/apis/console' ); ?>
				<?php printf( __( 'See detail at <a href="%1$s">%2$s</a>.', 'wp-gianism' ), $this->setting_url( 'setup' ), __( 'How to set up', 'wp-gianism' ) ); ?>
			</p>
		</td>
	</tr>

	<tr>
		<th><label for="ggl_consumer_key"><?php _e( 'Client ID', 'wp-gianism' ); ?></label></th>
		<td>
			<input class="regular-text" type="text" name="ggl_consumer_key" id="ggl_consumer_key"
				value="<?php echo esc_attr( $instance->ggl_consumer_key ); ?>"/>
		</td>
	</tr>
	<tr>
		<th><label for="ggl_consumer_secret"><?php _e( 'Client Secret', 'wp-gianism' ); ?></label></th>
		<td>
			<input class="regular-text" type="text" name="ggl_consumer_secret" id="ggl_consumer_secret"
				value="<?php echo esc_attr( $instance->ggl_consumer_secret ); ?>"/>
		</td>
	</tr>
	<tr>
		<th><label for="ggl_redirect_uri"><?php _e( 'Redirect URI', 'wp-gianism' ); ?></label></th>
		<td>
			<p class="description">
				<?php
				$end_point = esc_url( $instance->get_redirect_endpoint() );
				printf(
					// translators: %1$s is redirect URI, %2$s is Google API Console, %3$s is link to Google API Console.
					__( 'Please set %1$s to %2$s on <a target="_blank" href="%4$s">%3$s</a>.', 'wp-gianism' ),
					__( 'Redirect URI', 'wp-gianism' ),
					'<code>' . $end_point . '</code>',
					'Google API Console',
					'https://code.google.com/apis/console'
				);
				?>
				<a class="button" href="<?php echo esc_attr( $end_point ); ?>"
					onclick="window.prompt('<?php esc_attr_e( 'Please copy this URL.', 'wp-gianism' ); ?>', this.href); return false;">
					<?php esc_html_e( 'Copy', 'wp-gianism' ); ?>
				</a>
				<br/>
				<?php
				$this->new_from( '2.0' );
				printf( __( '<strong>Notice: </strong> Setting is changed on <code>Gianims v2.0</code>. You must set up again on Google API Console.', 'wp-gianism' ) );
				?>
			</p>
		</td>
	</tr>
	<tr>
		<th><label for="ggl_workspace_mode"><?php _e( 'Workspace Limited', 'wp-gianism' ); ?></label></th>
		<td>
			<?php $this->switch_button( 'ggl_workspace_mode', $instance->ggl_workspace_mode, 1 ); ?>
			<br />
			<?php
			$this->new_from( '5.4' );
			printf(
				'<p class="description">%s</p>',
				wp_kses_post( __( 'Restrict site access to users from specific Google Workspace domains. Other social login providers should be disabled when this mode is active.', 'wp-gianism' ) )
			);
			?>
		</td>
	</tr>
	<tr>
		<th><label for="ggl_workspace_allowed_domains"><?php _e( 'Allowed Domains', 'wp-gianism' ); ?></label></th>
		<td>
			<?php
			$allowed_domains = $instance->ggl_workspace_allowed_domains;
			?>
			<textarea name="ggl_workspace_allowed_domains" id="ggl_workspace_allowed_domains"
				class="large-text" rows="3" placeholder="example.com&#10;company.co.jp"><?php echo esc_textarea( $allowed_domains ); ?></textarea>
			<p class="description">
				<?php esc_html_e( 'Enter allowed domains, one per line. Only users with email addresses from these domains can log in when Workspace Limited mode is enabled.', 'wp-gianism' ); ?>
			</p>
		</td>
	</tr>
	</tbody>
</table>
<?php submit_button(); ?>
