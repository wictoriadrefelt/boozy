<?php
/**
 * Welcome page of Easy Mart Theme
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Easy_Mart_Welcome' ) ) :

class Easy_Mart_Welcome {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'about_theme_styles' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'Welcome', 'easy-mart' ), esc_html__( 'Welcome', 'easy-mart' ), 'activate_plugins', 'easy-mart-welcome', array( $this, 'welcome_screen' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function about_theme_styles( $hook ) {
		if( 'appearance_page_easy-mart-welcome' != $hook && 'themes.php' != $hook ) {
			return;
		}
		global $easy_mart_version;

		wp_enqueue_style( 'welcome-theme-style', get_template_directory_uri() . '/inc/welcome/welcome.css', array(), $easy_mart_version );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $easy_mart_version, $pagenow;

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'easy_mart_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'easy_mart_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['easy-mart-hide-notice'] ) && isset( $_GET['_easy_mart_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_easy_mart_notice_nonce'], 'easy_mart_hide_notices_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'easy-mart' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Cheat in &#8217; huh?', 'easy-mart' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['easy-mart-hide-notice'] );
			update_option( 'easy_mart_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		$theme = wp_get_theme( get_template() );
		$theme_name = $theme->get( 'Name' );
?>
		<div id="cv-theme-message" class="updated easy-mart-message">
			<a class="easy-mart-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'easy-mart-hide-notice', 'welcome' ) ), 'easy_mart_hide_notices_nonce', '_easy_mart_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'easy-mart' ); ?></a>
			<h2 class="welcome-title"><?php printf( esc_html__( 'Welcome to %s', 'easy-mart' ), esc_html( $theme_name ) ); ?></h2>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our %2$s welcome page %3$s.', 'easy-mart' ), esc_html( $theme_name ), '<a href="' . esc_url( admin_url( 'themes.php?page=easy-mart-welcome' ) ) . '">', '</a>' ); ?></p>
			<p><a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=easy-mart-welcome' ) ); ?>"><?php printf( esc_html__( 'Get started with %1$s', 'easy-mart' ), esc_html( $theme_name ) ); ?></a></p>
		</div>
<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $easy_mart_version;
		$theme = wp_get_theme( get_template() );

		$theme_name = $theme->get( 'Name' );
		$theme_description = $theme->get( 'Description' );
		$theme_uri = $theme->get( 'ThemeURI' );
?>
		<div class="theme-info-wrapper">
			<div class="easy-mart-theme-info">
				<h1> <?php printf( esc_html__( 'About %1$s', 'easy-mart' ), esc_html( $theme_name ) ); ?> </h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo wp_kses_post( $theme_description ); ?></div>

					<div class="easy-mart-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
					</div>
				</div>
			</div>

			<p class="easy-mart-actions">
				<a href="<?php echo esc_url( $theme_uri ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'easy-mart' ); ?></a>

				<a href="<?php echo esc_url( apply_filters( 'easy_mart_demo_url', 'https://demo.codevibrant.com/easy-mart-landing/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'easy-mart' ); ?></a>

				<a href="<?php echo esc_url( apply_filters( 'easy_mart_pro_theme_url', 'https://codevibrant.com/wpthemes/easy-mart-pro/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'easy-mart' ); ?></a>

				<a href="<?php echo esc_url( apply_filters( 'easy_mart_rating_url', 'https://wordpress.org/support/theme/easy-mart/reviews/?filter=5' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'easy-mart' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'easy-mart-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'easy-mart-welcome' ), 'themes.php' ) ) ); ?>">
					<?php echo esc_html( $theme->display( 'Name' ) ); ?>
				</a>
				
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'easy-mart-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Free Vs Pro', 'easy-mart' ); ?>
				</a>

				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'easy-mart-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'More Themes', 'easy-mart' ); ?>
				</a>

				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'easy-mart-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'easy-mart' ); ?>
				</a>
			</h2>
		</div><!-- .theme-info-wrapper -->
<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );

		$theme_name = $theme->get( 'Name' );
		$theme_description = $theme->get( 'Description' );
		$theme_uri = $theme->get( 'ThemeURI' );
	?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'easy-mart' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'easy-mart' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'easy-mart' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'easy-mart' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'easy-mart' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://docs.codevibrant.com/easy-mart/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'easy-mart' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'easy-mart' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'easy-mart' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/easy-mart/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support', 'easy-mart' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'easy-mart' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'easy-mart' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://codevibrant.com/wpthemes/easy-mart-pro/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View PRO version', 'easy-mart' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Have you need customization?', 'easy-mart' ); ?></h3>
						<p><?php esc_html_e( 'Please send message with your requirement.', 'easy-mart' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://codevibrant.com/contact/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Customization', 'easy-mart' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php printf( esc_html__( 'Translate %1$s', 'easy-mart' ), $theme_name ); ?></h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'easy-mart' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/easy-mart' ); ?>" class="button button-secondary" target="_blank"><?php printf( esc_html__( 'Translate %1$s', 'easy-mart' ), $theme_name ); ?></a>
						</p>
					</div>
				</div>
			</div><!-- .point-releases -->

			<div class="return-to-dashboard easy-mart">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'easy-mart' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'easy-mart' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'easy-mart' ) : esc_html_e( 'Go to Dashboard', 'easy-mart' ); ?></a>
			</div><!-- .return-to-dashboard -->
		</div><!-- .about-wrap -->
	<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'codevibrant',
							'per_page' => 100
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->easy_mart_get_themes( $request );

						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;
						

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) {
					?>
								<div id="<?php echo esc_attr( $theme->slug ); ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo esc_url( $theme->screenshot_url ); ?>"/>
									</div>
									<h3 class="theme-name" id="easy-mart-name"><strong><?php esc_html_e( 'Active', 'easy-mart' ); ?></strong>: <?php echo esc_html( $theme->name ); ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo esc_url( get_site_url(). '/wp-admin/customize.php' ); ?>"><?php esc_html_e( 'Customize', 'easy-mart' ); ?></a>
									</div>
								</div><!-- .theme active -->
						<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => esc_attr( $theme->slug ),
									'fields' => array(
										'template' => true
									)
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->easy_mart_get_themes( $request );
								if ( empty( $theme_details->template ) ) {
							?>
									<div id="<?php echo esc_attr( $theme->slug ); ?>" class="theme">
										<div class="theme-screenshot">
											<img src="<?php echo esc_url( $theme->screenshot_url ); ?>"/>
										</div>

										<h3 class="theme-name"><?php echo esc_html( $theme->name ); ?></h3>

										<div class="theme-actions">
											<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>
												<!-- Activate Button -->
												<a  class="button button-secondary activate"
													href="<?php echo esc_url( wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . esc_attr( $theme->slug ) ) ); ?>" ><?php esc_html_e( 'Activate', 'easy-mart' ) ?></a>
											<?php } else {
												// Set the install url for the theme.
												$install_url = add_query_arg( array(
														'action' => 'install-theme',
														'theme'  => esc_attr( $theme->slug ),
													), self_admin_url( 'update.php' ) );
											?>
												<!-- Install Button -->
												<a data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr( 'Downloaded ', 'easy-mart' ). number_format( $theme_details->downloaded ).' '.esc_attr( 'times', 'easy-mart' ); ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php esc_html_e( 'Install Now', 'easy-mart' ); ?></a>
											<?php } ?>

											<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo esc_url( $theme->preview_url ); ?>"><?php esc_html_e( 'Live Preview', 'easy-mart' ); ?></a>
										</div>
									</div><!-- .theme -->
					<?php
								}
							}
						}
					?>
				</div>
			</div><!-- .cv-theme-holder -->
		</div><!-- .wrap.about-wrap -->
<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function easy_mart_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'easy_mart_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}
	
	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

	?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'View changelog below:', 'easy-mart' ); ?></h4>

			<?php
				$changelog_file = apply_filters( 'easy_mart_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'easy-mart' ); ?></h4>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'easy-mart' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Easy Mart', 'easy-mart' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'Easy Mart Pro', 'easy-mart' ); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Price', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e( 'Free', 'easy-mart' ); ?></td>
						<td><?php esc_html_e( '$59', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Import Demo Data', 'easy-mart' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Pre Loaders', 'easy-mart' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Header Layouts', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'easy-mart' ); ?></td>
						<td><?php esc_html_e( '3', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Archive Pages Layouts', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'easy-mart' ); ?></td>
						<td><?php esc_html_e( '3', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e('2', 'easy-mart');?></td>
						<td><?php esc_html_e( '600+', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Instagram Feature', 'easy-mart' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'No. of Widgets', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e( '7', 'easy-mart' ); ?></td>
						<td><?php esc_html_e( '12', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Custom 404 page', 'easy-mart' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Animation on Section', 'easy-mart' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Bottom Footer Layouts', 'easy-mart' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'easy-mart' ); ?></td>
						<td><?php esc_html_e( '2', 'easy-mart' ); ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'easy_mart_pro_theme_url', 'https://codevibrant.com/wpthemes/easy-mart-pro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Buy Pro', 'easy-mart' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new Easy_Mart_Welcome();