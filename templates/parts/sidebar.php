<?php
/** @var \Gianism\UI\Screen $this */

defined( 'ABSPATH' ) || exit;
?>
<div class="sidebar">
	<div id="index">
		<h4><?php _e( 'Index', 'wp-gianism' ); ?></h4>
		<ol id="index-list">
		</ol>

		<h4><?php _e( 'Support', 'wp-gianism' ); ?></h4>

		<p class="forum-link">
			<?php
			printf(
				__( 'Have some questions? Go to our support site <a href="%s" target="_blank">gianism.info</a>!', 'wp-gianism' ),
				gianism_utm_link(
					'https://gianism.info/',
					[
						'utm_medium' => 'sidebar',
					]
				)
			);
			?>
		</p>

		<p class="github-link">
			<?php printf( __( 'This plugin\'s is hosted on <a href="%s">Github</a>. Pull requests are welcomed.', 'wp-gianism' ), 'https://github.com/fumikito/Gianism' ); ?>
		</p>

		<?php
		$locale = get_locale();
		$user   = get_userdata( get_current_user_id() );
		?>

		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
				<form
					action="//gianism.us14.list-manage.com/subscribe/post?u=9b5777bb4451fb83373411d34&amp;id=1e82da4148&amp;SINGUP=WordPress"
					method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
					target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<h4><?php _e( 'Join our News Letter!', 'wp-gianism' ); ?></h4>
						<div class="mc-field-group">
							<label for="mce-EMAIL">
								<?php _e( 'Email', 'wp-gianism' ); ?>
								<span class="asterisk">*</span>
							</label>
							<input type="email" name="EMAIL" class="required email" id="mce-EMAIL" value="<?php echo esc_attr( $user->user_email ); ?>">
						</div>
						<div class="mc-field-2col mc-field-name-<?php echo esc_attr( get_locale() ); ?>">
							<div>
								<div class="mc-field-group first-name">
									<label for="mce-FNAME"><?php _e( 'First Name', 'wp-gianism' ); ?></label>
									<input type="text" value="<?php echo esc_attr( get_user_meta( $user->ID, 'first_name', true ) ); ?>" name="FNAME" class="" id="mce-FNAME">
								</div>
							</div>
							<div>
								<div class="mc-field-group last-name">
									<label for="mce-LNAME"><?php _e( 'Last Name', 'wp-gianism' ); ?></label>
									<input type="text" value="<?php echo esc_attr( get_user_meta( $user->ID, 'last_name', true ) ); ?>" name="LNAME" class="" id="mce-LNAME">
								</div>
							</div>
							<div style="clear:both;"></div>
						</div>
						<p>
									<label class="inline" for="mce-group[1111]-1111-0">
										<input type="checkbox" value="1" name="group[1111][1]"
												id="mce-group[1111]-1111-0" <?php checked( str_contains( $locale, 'en_' ) ); ?>>
										<?php _e( 'English', 'wp-gianism' ); ?>
									</label>
									<label class="inline" for="mce-group[1111]-1111-1">
										<input type="checkbox" value="2" name="group[1111][2]"
												id="mce-group[1111]-1111-1" <?php checked( 'ja', $locale ); ?>>
										<?php _e( 'Japanese', 'wp-gianism' ); ?>
									</label>
						</p>
						<input type="hidden" name="group[1115]" value="16"/>
						<input type="hidden" name="b_9b5777bb4451fb83373411d34_1e82da4148" value="">
					</div>
					<p class="submit">
						<input type="submit" value="<?php _e( 'Subscribe', 'wp-gianism' ); ?>" name="subscribe"
								id="mc-embedded-subscribe" class="button-primary">
					</p>
				</form>
			</div>
		</div>

		<h4><?php _e( 'Our social Account', 'wp-gianism' ); ?></h4>

		<div class="fb-page" data-href="https://www.facebook.com/gianism.info" data-small-header="true"
			data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"
			data-show-posts="false">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="https://www.facebook.com/gianism.info"><a
						href="https://www.facebook.com/gianism.info">Gianism</a></blockquote>
			</div>
		</div>
		<p class="social-link">
			<a href="https://twitter.com/intent/tweet?screen_name=wpGianism" class="twitter-mention-button"
				data-lang="ja" data-related="takahashifumiki">Tweet to @wpGianism</a>
			<script>!function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (!d.getElementById(id)) {
						js = d.createElement(s);
						js.id = id;
						js.src = "//platform.twitter.com/widgets.js";
						fjs.parentNode.insertBefore(js, fjs);
					}
				}(document, "script", "twitter-wjs");</script>
		</p>

		<p class="hametuha-link">
			<small>Powered by</small>
			<a href="<?php echo gianism_utm_link( 'https://hametuha.co.jp/', [ 'utm_medium' => 'sidebar' ] ); ?>"
				target="_blank">
				<img src="<?php echo $this->url; ?>assets/img/hametuha-logo.png">
			</a>
		</p>

	</div>
</div>
