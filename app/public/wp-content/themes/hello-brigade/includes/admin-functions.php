<?php

/**
 * Admin functions.
 *
 */

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @return void
 */
function hello_brigade_fail_load_admin_notice() {
	// Leave to Elementor Pro to manage this.
	if ( function_exists( 'elementor_pro_load_plugin' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	if ( 'true' === get_user_meta( get_current_user_id(), '_hello_brigade_install_notice', true ) ) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	$installed_plugins = get_plugins();

	$is_elementor_installed = isset( $installed_plugins[ $plugin ] );

	if ( $is_elementor_installed ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$message = __( 'Hello Brigade theme is a lightweight starter theme designed to work perfectly with Elementor Page Builder plugin.', 'hello-brigade' );

		$button_text = __( 'Activate Elementor', 'hello-brigade' );
		$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$message = __( 'Hello Brigade theme is a lightweight starter theme. We recommend you use it together with Elementor Page Builder plugin, they work perfectly together!', 'hello-brigade' );

		$button_text = __( 'Install Elementor', 'hello-brigade' );
		$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
	}

	?>
	<style>
		.notice.hello-brigade-notice {
			border-left-color: #9b0a46 !important;
			padding: 20px;
		}
		.rtl .notice.hello-brigade-notice {
			border-right-color: #9b0a46 !important;
		}
		.notice.hello-brigade-notice .hello-brigade-notice-inner {
			display: table;
			width: 100%;
		}
		.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-notice-icon,
		.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-notice-content,
		.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-install-now {
			display: table-cell;
			vertical-align: middle;
		}
		.notice.hello-brigade-notice .hello-brigade-notice-icon {
			color: #9b0a46;
			font-size: 50px;
			width: 50px;
		}
		.notice.hello-brigade-notice .hello-brigade-notice-content {
			padding: 0 20px;
		}
		.notice.hello-brigade-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.hello-brigade-notice h3 {
			margin: 0 0 5px;
		}
		.notice.hello-brigade-notice .hello-brigade-install-now {
			text-align: center;
		}
		.notice.hello-brigade-notice .hello-brigade-install-now .hello-brigade-install-button {
			padding: 5px 30px;
			height: auto;
			line-height: 20px;
			text-transform: capitalize;
		}
		.notice.hello-brigade-notice .hello-brigade-install-now .hello-brigade-install-button i {
			padding-right: 5px;
		}
		.rtl .notice.hello-brigade-notice .hello-brigade-install-now .hello-brigade-install-button i {
			padding-right: 0;
			padding-left: 5px;
		}
		.notice.hello-brigade-notice .hello-brigade-install-now .hello-brigade-install-button:active {
			transform: translateY(1px);
		}
		@media (max-width: 767px) {
			.notice.hello-brigade-notice {
				padding: 10px;
			}
			.notice.hello-brigade-notice .hello-brigade-notice-inner {
				display: block;
			}
			.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-notice-content {
				display: block;
				padding: 0;
			}
			.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-notice-icon,
			.notice.hello-brigade-notice .hello-brigade-notice-inner .hello-brigade-install-now {
				display: none;
			}
		}
	</style>
	<script>jQuery( function( $ ) {
			$( 'div.notice.hello-brigade-install-elementor' ).on( 'click', 'button.notice-dismiss', function( event ) {
				event.preventDefault();

				$.post( ajaxurl, {
					action: 'hello_brigade_set_admin_notice_viewed'
				} );
			} );
		} );</script>
	<div class="notice updated is-dismissible hello-brigade-notice hello-brigade-install-elementor">
		<div class="hello-brigade-notice-inner">
			<div class="hello-brigade-notice-icon">
				<img src="<?php echo esc_url( HELLO_BRIGADE_URI . '/assets/images/elementor-logo.png' ); ?>" alt="Elementor Logo" />
			</div>

			<div class="hello-brigade-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing Hello Brigade Theme!', 'hello-brigade' ); ?></h3>
				<p>
					<p><?php echo esc_html( $message ); ?></p>
					<a href="https://go.elementor.com/hello-theme-learn/" target="_blank"><?php esc_html_e( 'Learn more about Elementor', 'hello-brigade' ); ?></a>
				</p>
			</div>

			<div class="hello-brigade-install-now">
				<a class="button button-primary hello-brigade-install-button" href="<?php echo esc_attr( $button_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html( $button_text ); ?></a>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Set Admin Notice Viewed.
 *
 * @return void
 */
function ajax_hello_brigade_set_admin_notice_viewed() {
	update_user_meta( get_current_user_id(), '_hello_brigade_install_notice', 'true' );
	die;
}

add_action( 'wp_ajax_hello_brigade_set_admin_notice_viewed', 'ajax_hello_brigade_set_admin_notice_viewed' );

if ( ! did_action( 'elementor/loaded' ) ) {
	add_action( 'admin_notices', 'hello_brigade_fail_load_admin_notice' );
}
