<?php
/** @var \Gianism\Plugins\Bot $this */
/** @var \WP_Post $post */
/** @var \Gianism\Service\Twitter $twitter */
$twitter = \Gianism\Service\Twitter::get_instance();
?>

<div class="gianism-post-container">

	<div class="form-row">
		<label for="content"><i
				class="lsf lsf-balloon"></i> <?php printf( __( 'What do you tweet as <a href="https://twitter.com/%1$s" target="_blank">@%1$s</a>?', 'wp-gianism' ), $twitter->tw_screen_name ); ?>
		</label>
		<textarea id="content" name="content"
					placeholder="<?php echo esc_attr( __( 'Enter your tweet.', 'wp-gianism' ) ); ?>"><?php echo esc_textarea( $post->post_content ); ?></textarea>
		<p class="description">
			<?php _e( 'HTML tags are not allowed. But you can use short codes. Gianism original short codes are below.', 'wp-gianism' ); ?>
			<?php printf( __( 'And ofcourse You can register your own shortcode with <a href="%s">Shortcode API</a>.', 'wp-gianism' ), 'http://codex.wordpress.org/Shortcode_API' ); ?>
		</p>
		<hr/>
		<h4>gianism_limit</h4>
		<p>
			<em><?php _e( 'Attributes', 'wp-gianism' ); ?></em>:
			<code>limit</code>
			<small><?php _e( 'Date time. This will convert to rest time which is relative to current time.', 'wp-gianism' ); ?>
				|
				<code>placeholder</code>
				<small><?php printf( __( 'Place holder. Default is %s.', 'wp-gianism' ), __( '%s left', 'wp-gianism' ) ); ?></small>
		</p>
		<?php
		$next_month = date_i18n( 'Y-m-d', strtotime( 'Next month' ) );
		?>
		<pre>
[gianism_limit limit='<?php echo $next_month; ?>'] => <?php echo do_shortcode( '[gianism_limit limit=\'' . $next_month . '\']' ); ?>
</pre>
		<?php
		/**
		 * Filter hook for bot documentation
		 *
		 * @action gianism_twitter_bot_documentation
		 * @param  WP_Post $post
		 */
		do_action( 'gianism_twitter_bot_documentation', $post )
		?>
	</div>

	<hr/>

	<div class="form-row">
		<table class="date-table" id="gianism-bot-schedule">
			<caption><i class="lsf lsf-time"></i> <?php _e( 'Schedule', 'wp-gianism' ); ?></caption>
			<thead>
			<tr>
				<th>&nbsp;</th>
				<?php for ( $i = 0; $i < 7; $i++ ) : ?>
					<th scope="col"><?php echo date_i18n( 'D', strtotime( 'Last Monday', time() ) + 60 * 60 * 24 * $i ); ?></th>
				<?php endfor ?>
				<th>&nbsp;</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>&nbsp;</th>
				<td colspan="8">
					<select id="g-row-time">
						<?php for ( $i = 0; $i < 24; $i++ ) : ?>
							<option><?php printf( '%02d', $i ); ?></option>
						<?php endfor; ?>
					</select>:
					<select id="g-row-minute">
						<?php for ( $i = 0; $i < 6; $i++ ) : ?>
							<option><?php printf( '%02d', $i * 10 ); ?></option>
						<?php endfor; ?>
					</select>
					<a class="button add-row" href="#"><?php _e( 'Add Time Row', 'wp-gianism' ); ?></a>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach ( $this->get_time_line( $post ) as $time => $dates ) : ?>
				<tr>
					<th><?php echo esc_html( substr( $time, 0, 5 ) ); ?></th>
					<?php for ( $i = 1; $i <= 7; $i++ ) : ?>
						<td><input type="checkbox" name="gianism_bot_schedule[<?php echo esc_attr( $time ); ?>][]"
									value="<?php echo $i; ?>"<?php checked( in_array( (string) $i, $dates, true ) ); ?> />
						</td>
					<?php endfor ?>
					<td><a class="button row-delete" href="#">&times;</a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<script type="text/javascript">
			//<![CDATA[
			window.GianismBotSchedule = <?php echo json_encode( $this->get_schedule( $post ) ); ?>;
			//]]>
		</script>
	</div>

	<?php
	$limit = $this->cron_limit( $post );
	if ( ! empty( $limit ) && ! preg_match( '/[0-9]{4}-[0-9]{2}-[0-9]{2}/u', $limit ) ) :
		?>
		<div class="error">
			<p><?php _e( 'End datetime is mal-formed: YYYY-MM-DD', 'wp-gianism' ); ?></p>
		</div>
	<?php endif; ?>

	<hr/>

	<div class="form-row">
		<label for="tweet_ends"><i class="lsf lsf-dailycalendar"></i> <?php _e( 'End Datetime', 'wp-gianism' ); ?></label>
		<p>
			<input type="date" class="regular-text" name="tweet_ends" id="tweet_ends"
					value="<?php echo esc_html( $limit ); ?>" placeholder="ex. 2014-08-16" autocomplete="on">
		</p>
		<p class="description">
			<?php _e( 'Passing this limit, This bot will be private. Format is YYYY-MM-DD', 'wp-gianism' ); ?>
		</p>
	</div>


</div><!-- //.gianism-post-container -->
