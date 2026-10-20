<?php

namespace Gianism\UI;

/**
 * Setting Screen
 *
 * @package Gianism
 */
class SettingScreen extends Screen {

	protected $slug = 'gianism';

	protected $default_view = 'home';

	/**
	 * SettingScreen constructor.
	 */
	protected function admin_init() {
		// Add admin page
		add_options_page(
			__( 'Gianism Setting', 'gianism' ),
			__( 'Gianism Setting', 'gianism' ),
			'manage_options',
			'gianism',
			[ $this, 'render' ]
		);
		// Add option save hook
		add_action( 'load-settings_page_gianism', [ $this, 'update_option' ] );
		// Add view
		foreach ( [
			'home'      => sprintf( '<i class="lsf lsf-home"></i> %s', __( 'Home', 'gianism' ) ),
			'setting'   => sprintf( '<i class="lsf lsf-paramater"></i> %s', __( 'Setting', 'gianism' ) ),
			'setup'     => sprintf( '<i class="lsf lsf-help"></i> %s', __( 'How to set up', 'gianism' ) ),
			'customize' => sprintf( '<i class="lsf lsf-wrench"></i> %s', __( 'Customize', 'gianism' ) ),
			'advanced'  => sprintf( '<i class="lsf lsf-magic"></i> %s', __( 'Advanced Usage', 'gianism' ) ),
		] as $slug => $label ) {
			$this->views[ $slug ] = $label;
		}
	}

	/**
	 * Update option
	 */
	public function update_option() {
		if ( $this->input->verify_nonce( 'gianism_option' ) ) {
			$this->option->update();
			wp_redirect( $this->setting_url( 'setting' ) );
			exit;
		}
	}
}
