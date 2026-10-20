<?php

defined( 'ABSPATH' ) or die();

/** @var \Gianism\UI\SettingScreen $this */

?>

<div class="gianism-home">

	<blockquote class="gianism-home-quote">
		<i class="lsf lsf-quote"></i>
		<p>
			<?php _e( 'What you have is mine, what I have is also mine!', 'wp-gianism' ); ?>
		</p>
		<cite>- <?php _e( 'Takeshi Gōda', 'wp-gianism' ); ?> -</cite>
	</blockquote>

	<p class="gianism-home-lead">
		<?php _e( 'Gianism let your site <strong>more social</strong>. Your users can log in to your site via popular SNS.', 'wp-gianism' ); ?>
		<?php _e( 'Besides that, some powerful add-ons are available. Your user can be your evangelist. You can even automate your own WordPress. Interact with APIs and make something great!', 'wp-gianism' ); ?>
	</p>

	<table class="gianism-home-table">
		<caption><?php _e( 'Available Services', 'wp-gianism' ); ?></caption>
		<thead>
			<tr>
				<th><?php _e( 'Name', 'wp-gianism' ); ?></th>
				<th class="status"><?php _e( 'Status', 'wp-gianism' ); ?></th>
				<th class="type"><?php _e( 'Type', 'wp-gianism' ); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $this->service->service_list() as $service ) : ?>
			<tr>
				<td><?php echo esc_html( $service['label'] ); ?></td>
				<td class="status">
					<?php if ( $service['enabled'] ) : ?>
						<i class="lsf lsf-check" style="color: green; font-size: 1.4em;"></i>
					<?php else : ?>
						<i class="lsf lsf-ban" style="color: lightgrey; font-size: 1.4em;"></i>
					<?php endif; ?>
				</td>
				<td class="type">
					<?php if ( $service['default'] ) : ?>
						<?php _e( 'Default', 'wp-gianism' ); ?>
					<?php else : ?>
						<?php _e( 'Add on', 'wp-gianism' ); ?>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<p class="description">
		<?php
		printf(
			__( 'You can enable all services via <a href="%1$s">Setting</a> and find more services at <a href="%2$s">gianism.info</a>.', 'wp-gianism' ),
			$this->setting_url( 'setting' ),
			gianism_utm_link( 'https://gianism.info/', [ 'utm-medium' => 'dashboard' ] )
		);
		?>
	</p>


	<table class="gianism-home-table">
		<caption><?php _e( 'Add-ons', 'wp-gianism' ); ?></caption>
		<thead>
		<tr>
			<th><?php _e( 'Name', 'wp-gianism' ); ?></th>
			<th><?php _e( 'Description', 'wp-gianism' ); ?></th>
			<th class="status"><?php _e( 'Status', 'wp-gianism' ); ?></th>
			<th class="type"><?php _e( 'Type', 'wp-gianism' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $this->service->get_plugins() as $plugin ) : /** @var \Gianism\Plugins\PluginBase $plugin */ ?>
			<tr>
				<td><?php echo esc_html( $plugin->plugin_name ); ?></td>
				<td>
					<?php echo esc_html( $plugin->plugin_description() ); ?>
				</td>
				<td class="status">
					<?php if ( $plugin->plugin_enabled() ) : ?>
						<i class="lsf lsf-check" style="color: green; font-size: 1.4em;"></i>
					<?php else : ?>
						<i class="lsf lsf-ban" style="color: lightgrey; font-size: 1.4em;"></i>
					<?php endif; ?>
				</td>
				<td class="type">
					<?php if ( $this->service->is_default_plugin( $plugin->plugin_name ) ) : ?>
						<?php _e( 'Default', 'wp-gianism' ); ?>
					<?php else : ?>
						<?php _e( 'Add on', 'wp-gianism' ); ?>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<p class="description">
		<?php
		printf(
			__( 'Are you interested with add-ons? Find more at <a href="%s">gianism.info</a>!', 'wp-gianism' ),
			gianism_utm_link( 'https://gianism.info/', [ 'utm-medium' => 'dashboard' ] )
		);
		?>
	</p>

</div>
