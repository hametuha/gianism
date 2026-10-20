<?php

defined( 'ABSPATH' ) or die();

/** @var \Gianism\UI\SettingScreen $this */
/** @var \Gianism\Service\Google $google */
$google = $this->service->get( 'google' );

if ( ! $google->enabled ) :
	?>
	<div class="error">
		<p><?php printf( __( 'Google connect is not available. Go to <a href="%s">setting page</a> and turn it on.', 'wp-gianism' ), admin_url( 'options-general.php?page=gianism' ) ); ?></p>
	</div>
	<?php
	return;
endif;

$analytics = \Gianism\Plugins\Analytics::get_instance();

?>

<h3><i class="lsf lsf-key"></i> <?php _e( 'Analytics Token', 'wp-gianism' ); ?></h3>

<?php if ( $analytics->ga_token ) : ?>
	<p class="success">
		<i class="lsf lsf-ok"></i> <?php _e( 'O.K. You have token.', 'wp-gianism' ); ?>
	</p>
	<code><?php print_r( $analytics->ga_token ); ?></code>
	<?php
	$label = __( 'Restore', 'wp-gianism' );
	?>
<?php else : ?>
	<p class="description">
		<i class="lsf lsf-ban"></i> <?php _e( 'You don\'t have token. Token is required to contact with Google Analytics API.', 'wp-gianism' ); ?>
	</p>
	<?php
	$label = __( 'Get', 'wp-gianism' );
	?>
<?php endif; ?>
<p class="submit">
	<a class="button-primary" href="<?php echo $analytics->token_url( $this->setting_url( 'analytics' ) ); ?>">
		<?php echo $label; ?>
	</a>
	<?php if ( $analytics->ga_token ) : ?>
		<a class="button" href="<?php echo $analytics->token_url( $this->setting_url( 'analytics' ), true ); ?>">
			<?php _e( 'Delete', 'wp-gianism' ); ?>
		</a>
	<?php endif; ?>
</p>



<?php if ( $analytics->ga_token ) : ?>
	<h3><i class="lsf lsf-dashboard"></i> <?php _e( 'Account, Profile, View', 'wp-gianism' ); ?></h3>
	<form id="ga-connection"
			action="<?php echo $analytics->token_save_url(); ?>" method="post"
			data-endpoint="<?php echo admin_url( 'admin-ajax.php?action=wpg_ga_account' ); ?>">
		<?php wp_nonce_field( 'wp_gianism_google_save-analytics' ); ?>
		<input type="hidden" name="redirect_to" value="<?php echo esc_url( $this->setting_url( 'analytics' ) ); ?>" />
		<table class="form-table">
			<tbody>
			<tr>
				<th><label for="ga-account"><?php _e( 'Account', 'wp-gianism' ); ?></label></th>
				<td>
					<select class="ga-profile-select" name="ga-account" id="ga-account"
							data-ga-account-id="<?php echo $analytics->ga_profile['account']; ?>"
							data-child="ga-profile" data-clear-target="1">
						<option
							value="0"<?php selected( ! $analytics->ga_profile['account'] ); ?>><?php _e( 'Please select', 'wp-gianism' ); ?></option>
						<?php foreach ( $analytics->ga_accounts as $account ) : ?>
							<option
								value="<?php echo esc_attr( $account->id ); ?>"<?php selected( $account->id, $analytics->ga_profile['account'] ); ?>><?php echo esc_html( $account->name ); ?></option>
						<?php endforeach; ?>
					</select>
					<i class="dashicons dashicons-yes"></i>
					<i class="dashicons dashicons-update"></i>
					<?php if ( ! $analytics->ga_accounts ) : ?>
						<p class="description">
							<?php _e( 'Mmh, can\'t get Analytics accounts. Your token might be wrong.', 'wp-gianism' ); ?>
						</p>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<th><label for="ga-profile"><?php _e( 'Profile', 'wp-gianism' ); ?></label></th>
				<td>
					<select class="ga-profile-select" name="ga-profile" id="ga-profile"
							data-ga-profile-id="<?php echo $analytics->ga_profile['profile']; ?>" data-child="ga-view"
							data-clear-target="2">
						<option
							value="0"<?php selected( ! $analytics->ga_profile['profile'] ); ?>><?php _e( 'Please select', 'wp-gianism' ); ?></option>
					</select>
					<i class="dashicons dashicons-yes"></i>
					<i class="dashicons dashicons-update"></i>
				</td>
			</tr>
			<tr>
				<th><label for="ga-view"><?php _e( 'View', 'wp-gianism' ); ?></label></th>
				<td>
					<select name="ga-view" id="ga-view" data-ga-view-id="<?php echo $analytics->ga_profile['view']; ?>">
						<option
							value="0"<?php selected( ! $analytics->ga_profile['view'] ); ?>><?php _e( 'Please select', 'wp-gianism' ); ?></option>
					</select>
					<i class="dashicons dashicons-yes"></i>
					<i class="dashicons dashicons-update"></i>
				</td>
			</tr>
			</tbody>
		</table>
		<?php submit_button(); ?>
	</form>
<?php endif; ?>

<h3>
	<i class="lsf lsf-server"></i> <?php _e( 'Create Database', 'wp-gianism' ); ?>
</h3>
<p>
	<?php _e( 'Gianism can create a typical table for Google Analytics Ranking. If you need customized one, forget about it and create your own.', 'wp-gianism' ); ?>
</p>

<table class="mysql-table">
	<caption><?php _e( 'Ranking table structure', 'wp-gianism' ); ?></caption>
	<thead>
	<tr>
		<th><?php _e( 'Column', 'wp-gianism' ); ?></th>
		<th><?php _e( 'Type', 'wp-gianism' ); ?></th>
		<th><?php _e( 'Length', 'wp-gianism' ); ?></th>
		<th><?php _e( 'Misc', 'wp-gianism' ); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<th scope="row">ID</th>
		<td>BIGINT</td>
		<td>20</td>
		<td>PK, <code>auto_increment</code></td>
	</tr>
	<tr>
		<th scope="row">category</th>
		<td>VARCHAR</td>
		<td>64</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th scope="row">object_id</th>
		<td>BIGINT</td>
		<td>20</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th scope="row">object_value</th>
		<td>BIGINT</td>
		<td>20</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th scope="row">calc_date</th>
		<td>DATE</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<th scope="row">created</th>
		<td>TIMESTAMP</td>
		<td>&nbsp;</td>
		<td>Default CURRENT_TIMESTAMP</td>
	</tr>
	</tbody>
</table>

<?php if ( $analytics->table_exists() ) : ?>
	<p class="success">
		<i class="dashicons dashicons-yes"></i> <?php _e( 'Table exits.', 'wp-gianism' ); ?>
	</p>
<?php else : ?>
	<form id="ga-table-create"
			action="<?php echo $analytics->table_create_url( $this->setting_url( 'analytics' ) ); ?>"
			method="post">
		<?php wp_nonce_field( 'wp_gianism_google_create-table' ); ?>

		<?php submit_button( __( 'Create Table', 'wp-gianism' ) ); ?>
	</form>
<?php endif; ?>

<h3>
	<i class="lsf lsf-time"></i> <?php _e( 'Installed cron files', 'wp-gianism' ); ?>
</h3>

<p class="description">
	<?php _e( 'To install cron, please visit our information site <a href="https://gianism.info/">gianism.info</a>.', 'wp-gianism' ); ?>
</p>

<?php if ( empty( $analytics->crons ) ) : ?>
	<p><?php _e( 'Nothing is installed.', 'wp-gianism' ); ?></p>
<?php else : ?>
	<form class="gianism-admin-form" id="cron-checker" method="post"
			action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
		<input type="hidden" name="action" value="<?php echo $analytics::AJAX_CRON; ?>"/>
		<?php wp_nonce_field( $analytics::AJAX_CRON ); ?>
		<table class="mysql-table">
			<thead>
			<tr>
				<th><?php _e( 'Class Name', 'wp-gianism' ); ?></th>
				<th><?php _e( 'Category', 'wp-gianism' ); ?></th>
				<th><?php _e( 'Interval', 'wp-gianism' ); ?></th>
				<th><?php _e( 'Available', 'wp-gianism' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			$counter = 0;
			foreach ( $analytics->crons as $class_name ) :
				?>
				<tr>
					<th scope="row">
						<label>
							<input type="radio" name="cron" value="<?php echo $counter; ?>"/>
							<?php echo $class_name; ?>
						</label>
					</th>
					<td><?php echo $class_name::CATEGORY; ?></td>
					<td><?php echo $class_name::INTERVAL; ?></td>
					<td>
						<?php if ( $class_name::SKIP_CRON ) : ?>
							<span class="description"><i class="lsf lsf-ban"></i> No</span>
						<?php else : ?>
							<span class="success"><i class="lsf lsf-check"></i> Yes</span>
						<?php endif; ?>
					</td>
				</tr>
				<?php
				++$counter;
endforeach;
			?>
			</tbody>
		</table>
		<?php submit_button( __( 'Check Data', 'wp-gianism' ) ); ?>
		<pre></pre>
	</form>
<?php endif; ?>

<p class="description">
	<?php printf( __( 'Do you want to know how to install files? Here is <a href="%s">blog post</a> about it.', 'wp-gianism' ), 'http://takahashifumiki.com/web/programing/3184/' ); ?>
</p>

<h3>
	<i class="lsf lsf-upload"></i> <?php _e( 'Installed Ajax files', 'wp-gianism' ); ?>
</h3>

<p class="description">
	<?php _e( 'To install Ajax actions, please visit our information site <a href="https://gianism.info/">gianism.info</a>.', 'wp-gianism' ); ?>
</p>


<?php if ( empty( $analytics->ajaxes ) ) : ?>
	<p><?php _e( 'Nothing is installed.', 'wp-gianism' ); ?></p>
<?php else : ?>
	<form class="gianism-admin-form" id="ajax-checker" method="get"
			action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
		<input type="hidden" name="_wpnonce" value=""/>
		<table class="mysql-table">
			<thead>
			<tr>
				<th><?php _e( 'Class Name', 'wp-gianism' ); ?></th>
				<th><?php _e( 'Endpoint', 'wp-gianism' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ( $analytics->ajaxes as $ajax ) : ?>
				<tr>
					<td>
						<label>
							<input type="radio" name="action" value="<?php echo esc_attr( $ajax::ACTION ); ?>"
									data-nonce="<?php echo esc_attr( $ajax::get_nonce() ); ?>" data-action=""/>
							<?php echo esc_html( $ajax ); ?>
						</label>
					</td>
					<td><?php printf( '<a href="%1$s">%1$s</a>', esc_url( $ajax::endpoint() ) ); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<table class="form-table">
			<tr>
				<th><label for="from"><?php _e( 'From', 'wp-gianism' ); ?></label></th>
				<td><input type="text" class="datepicker" id="from" name="from"
							value="<?php echo date_i18n( 'Y-m-d', strtotime( '1 month ago', time() ) ); ?>"
							placeholder="YYYY-MM-DD"/></td>
			</tr>
			<tr>
				<th><label for="to"><?php _e( 'To', 'wp-gianism' ); ?></label></th>
				<td><input type="text" class="datepicker" id="to" name="to"
							value="<?php echo date_i18n( 'Y-m-d' ); ?>" placeholder="YYYY-MM-DD"/></td>
			</tr>
		</table>
		<p class="descritpion"></p>
		<?php submit_button( __( 'Check Data', 'wp-gianism' ) ); ?>
		<pre></pre>
	</form>
<?php endif; ?>
