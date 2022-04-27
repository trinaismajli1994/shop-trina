<?php
/**
 * Header class class
 *
 * @package Botiga
 */

if ( !class_exists( 'Botiga_Header' ) ) :
	Class Botiga_Header {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'botiga_header', array( $this, 'header_markup' ) );
			add_action( 'botiga_header', array( $this, 'header_mobile_markup' ) );
			add_action( 'botiga_header', array( $this, 'header_image' ) );
		}

		/**
		 * Core header image
		 */
		public function header_image() {
			$show_header_image_only_home = get_theme_mod( 'show_header_image_only_home', 0 );

			// output
			$output = '<div class="header-image">';
				$output .= get_header_image_tag();
			$output .= '</div>';

			if( $show_header_image_only_home ) {
				if( is_front_page() ) {
					echo wp_kses_post( $output );
				}

				return;
			}

			echo wp_kses_post( $output );
		}

		/**
		 * Desktop header markup
		 */
		public function header_markup() {
			$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			?>

			<?php call_user_func( array( $this, $layout ) ); ?>
			<div class="search-overlay"></div>
			<?php
		}

		/**
		 * Mobile header markup
		 */		
		public function header_mobile_markup() {
			$layout = get_theme_mod( 'header_layout_mobile', 'header_mobile_layout_1' );
			?>

			<div class="botiga-offcanvas-menu">
				<div class="mobile-header-item">
					<div class="row">
						<div class="col">
							<?php $this->logo(); ?>
						</div>
						<div class="col align-right">
							<a class="mobile-menu-close" href="#"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
						</div>
					</div>
				</div>
				<div class="mobile-header-item">
					<?php $this->menu(); ?>
				</div>
				<div class="mobile-header-item">
					<?php $this->render_components( 'offcanvas' ); ?>
				</div>				
			</div>
			
			<?php call_user_func( array( $this, $layout ) ); ?>
			<div class="search-overlay"></div>
			<?php
		}
		
		/**
		 * Desktop: header layout 1
		 */
		public function header_layout_1() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="col-md-5">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-2">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-5 header-elements">
									<?php $this->render_components( 'l1' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}

		/**
		 * Desktop: header layout 2
		 */
		public function header_layout_2() {
			$layout 		= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 		= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= empty( get_theme_mod( 'main_header_menu_position' ) ) ? 'right' : get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="header-col">
									<?php $this->logo(); ?>
								</div>
								<div class="header-col menu-col menu-<?php echo esc_attr( $menu_position ); ?>">
									<?php $this->menu(); ?>
								</div>							
								<div class="header-col header-elements">
									<?php $this->render_components( 'l1' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}
		
		/**
		 * Desktop: header layout 3
		 */
		public function header_layout_3() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= empty( get_theme_mod( 'main_header_menu_position' ) ) ? 'center' : get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4 header-elements header-elements-left">
									<?php $this->render_components( 'l3left' ); ?>
								</div>
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>							
								<div class="col-md-4 header-elements">
									<?php $this->render_components( 'l3right' ); ?>
								</div>							
							</div>
						</div>	
					</div>	
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row">
								<div class="col-md-12 menu-col menu-<?php echo esc_attr( $menu_position ); ?>">
									<?php $this->menu(); ?>
								</div>
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}
		
		/**
		 * Desktop: header layout 4
		 */
		public function header_layout_4() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-8 header-elements">
									<?php $this->render_components( 'l4top' ); ?>
								</div>							
						
							</div>
						</div>	
					</div>	
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row row-menu menu-<?php echo esc_attr( $menu_position ); ?>">
								<div class="col">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-auto header-elements">
									<?php $this->render_components( 'l4bottom' ); ?>
								</div>									
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}	
		
		/**
		 * Desktop: header layout 5
		 */
		public function header_layout_5() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4 header-elements header-elements-left">
									<?php $this->render_components( 'l5topleft' ); ?>
								</div>
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>							
								<div class="col-md-4 header-elements">
									<?php $this->render_components( 'l5topright' ); ?>
								</div>							
							</div>
						</div>	
					</div>		
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row row-menu menu-<?php echo esc_attr( $menu_position ); ?>">
								<div class="col">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-auto header-elements">
									<?php $this->render_components( 'l5bottom' ); ?>
								</div>									
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}			


		/**
		 * Mobile: layout 1
		 */		
		public function header_mobile_layout_1() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4">
								<?php $this->logo(); ?>
							</div>
							<div class="col-8 header-elements valign align-right">
								<?php $this->render_components( 'mobile' ); ?>
								<?php $this->trigger(); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}	

		/**
		 * Mobile: layout 2
		 */		
		public function header_mobile_layout_2() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4 header-elements valign">
								<?php $this->render_components( 'mobile' ); ?>
							</div>							
							<div class="col-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-4 align-right">
								<?php $this->trigger(); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}	

		/**
		 * Mobile: layout 3
		 */		
		public function header_mobile_layout_3() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4">
								<?php $this->trigger(); ?>
							</div>														
							<div class="col-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-4 header-elements valign align-right">
								<?php $this->render_components( 'mobile' ); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}			
				
		/**
		 * Render header components
		 */
		public function render_components( $location ) {
			$defaults 	= botiga_get_default_header_components();
			$components = get_theme_mod( 'header_components_' . $location, $defaults[$location] );

			foreach ( $components as $component ) {
				call_user_func( array( $this, $component ) );
			}
		}

		/**
		 * Social icons
		 */
		public function social() {
			botiga_social_profile( 'social_profiles_header' );
		}

		/**
		 * Main navigation
		 */
		public function menu() {
			if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
			<?php else: ?>	
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<?php endif;
		}

		/**
		 * Button
		 */
		public function button() {
			$text 	= get_theme_mod( 'header_button_text', esc_html__( 'Click me', 'botiga' ) );
			$url	= get_theme_mod( 'header_button_link', '#' );
			$newtab = get_theme_mod( 'header_button_newtab', 0 );
			$open	= '';
			if ( $newtab ) {
				$open = 'target="_blank"';
			}

			?>
				<a <?php echo esc_html( $open ); ?> class="button header-item" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
			<?php
		}

		/**
		 * Contact info
		 */
		public function contact_info() {
			$email 	= get_theme_mod( 'header_contact_mail', esc_html__( 'office@example.org', 'botiga' ) );
			$phone	= get_theme_mod( 'header_contact_phone', esc_html__( '111222333', 'botiga' ) );

			?>
				<div class="header-item header-contact">
					<?php if ( $email ) : ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-mail', true ); ?></i><?php echo esc_html( antispambot( $email ) ); ?></a>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<a href="tel:<?php echo esc_attr( $phone ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-phone', true ); ?></i><?php echo esc_html( $phone ); ?></a>
					<?php endif; ?>					
				</div>
			<?php
		}		

		/**
		 * Woocommerce icons
		 */
		function woocommerce_icons() {

			if ( !class_exists( 'WooCommerce' ) ) {
				return;
			}
			
			echo botiga_woocommerce_header_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}		

		/**
		 * Search icon
		 */
		public function search() {
			?>
				<a href="#" class="header-search header-item">
					<i class="ws-svg-icon icon-search active"><?php botiga_get_svg_icon( 'icon-search', true ); ?></i>
					<i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i>
				</a>
			<?php
		}

		/**
		 * Search form
		 */
		public function search_form() {
			?>
			<div class="header-search-form">
			<?php
				if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
					echo do_shortcode('[wcas-search-form]');
				} else {
					get_search_form();
				}
			?>
			</div>
			<?php
		}

		/**
		 * Site branding
		*/		
		public function logo() {
			?>
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$botiga_description = get_bloginfo( 'description', 'display' );
				if ( $botiga_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $botiga_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-251.2 -1073.7 8461.880603693546 2717.1"><desc>Created with Snap</desc><defs></defs><g><g transform="matrix(24.3368,0,0,24.3368,5820.25,-931.9903)"><g><path d="M40.4,66c0-1.3-0.7-2.6-1.9-3.6v-5c1.1-0.6,1.9-1.7,1.9-3c0-0.2,0-0.3,0-0.5c0.7-1,0.9-2.2,0.7-3.3   c-0.3-2.3-1.7-4.5-1.9-4.9c-0.3-0.4-0.8-0.6-1.2-0.4c-0.4,0.2-0.7,0.6-0.6,1.1c0.4,2.8-0.7,3.6-1.8,3.9c-1.2-0.5-2.6-0.5-3.7,0.1   c-1.1-0.5-2.5-0.6-3.7-0.1c-1.1-0.3-2.2-1.1-1.8-3.9c0.1-0.5-0.2-0.9-0.6-1.1c-0.4-0.2-0.9,0-1.2,0.4C24,46.2,21,51,23.2,53.9   c0,0.2,0,0.3,0,0.5c0,1.3,0.8,2.5,1.9,3v5c-1.2,1-1.9,2.3-1.9,3.6c0,3.2,3.8,5.7,8.6,5.7c0.4,0,0.8,0,1.2-0.1   C37.2,71.3,40.4,68.9,40.4,66z M33.7,69.5c-0.6,0.1-1.3,0.2-2,0.2c-3.6,0-6.6-1.7-6.6-3.7c0-1.1,0.9-1.9,1.5-2.3   c0.3-0.2,0.4-0.5,0.4-0.8v-6.2c0-0.5-0.3-0.9-0.8-1c-0.6-0.1-1.1-0.7-1.1-1.3c0-0.1,0-0.3,0.1-0.5c0.1-0.4,0-0.8-0.3-1.1   c-0.7-0.6-0.6-1.8-0.3-3c0.8,1.7,2.4,2.3,3.3,2.4c0.2,0,0.5,0,0.7-0.1c0.8-0.4,1.8-0.4,2.6,0.1c0.3,0.2,0.8,0.2,1.1,0   c0.8-0.5,1.8-0.5,2.6-0.1c0.2,0.1,0.4,0.2,0.7,0.1c0.9-0.2,2.5-0.7,3.3-2.4c0.3,1.2,0.4,2.3-0.3,3c-0.3,0.3-0.4,0.7-0.3,1.1   c0.1,0.2,0.1,0.3,0.1,0.5c0,0.6-0.5,1.2-1.1,1.3c-0.5,0.1-0.8,0.5-0.8,1v5.7v0.5c0,0.3,0.2,0.6,0.4,0.8c0.6,0.4,1.5,1.2,1.5,2.3   C38.4,67.6,36.4,69,33.7,69.5z" fill="#6daedb" style=""></path><path d="M83.6,62H60.7V33.8c0-0.3-0.1-0.6-0.2-0.8l-5.8-13.2v-11c0-1.1-0.9-2-2-2H22.4c-1.1,0-2,0.9-2,2v11L14.6,33   c-0.1,0.3-0.2,0.5-0.2,0.8v57.4c0,1.1,0.9,2,2,2h9h17.7h3.6h12h24.9c1.1,0,2-0.9,2-2V64C85.6,62.9,84.7,62,83.6,62z M81.6,89.2   H56.7h-10h-1.6v-8.3c2.3-1.4,3.8-4,3.8-7s-1.5-5.6-3.8-7V66h36.5V89.2z M50.7,19.3H24.4v-8.4h26.3V19.3z M52.1,24l4.5,10.3V62h-9   V34L52.1,24z M18.4,34.3l5.7-13h26.8l0.1,0.2l-5.3,11.9c-0.1,0.1-0.1,0.3-0.1,0.4v4.6V62h-2.6c-1.1,0-2,0.9-2,2v4.2   c0,0.9,0.6,1.6,1.4,1.9c1.4,0.5,2.5,2,2.5,3.8s-1,3.3-2.5,3.8c-0.8,0.3-1.4,1-1.4,1.9v9.6H26.2h-0.8h-7V34.3z" fill="#6daedb" style=""></path><path d="M54.2,78.6c-1.9,0-3.5,1.7-3.5,3.8s1.5,3.8,3.5,3.8s3.5-1.7,3.5-3.8S56.2,78.6,54.2,78.6z M54.2,84.1   c-0.8,0-1.5-0.8-1.5-1.8s0.7-1.8,1.5-1.8c0.8,0,1.5,0.8,1.5,1.8S55,84.1,54.2,84.1z" fill="#6daedb" style=""></path><path d="M55.7,73.5c0,3.7,2.7,6.7,6.1,6.7c3.4,0,6.1-3,6.1-6.7c0-3.7-2.7-6.7-6.1-6.7C58.4,66.7,55.7,69.7,55.7,73.5z M65.9,73.5   c0,2.6-1.8,4.7-4.1,4.7s-4.1-2.1-4.1-4.7c0-2.6,1.8-4.7,4.1-4.7S65.9,70.8,65.9,73.5z" fill="#6daedb" style=""></path><path d="M75.7,86.4c2.5,0,4.5-2.2,4.5-4.9c0-2.7-2-4.9-4.5-4.9s-4.5,2.2-4.5,4.9C71.2,84.2,73.2,86.4,75.7,86.4z M75.7,78.6   c1.4,0,2.5,1.3,2.5,2.9s-1.1,2.9-2.5,2.9s-2.5-1.3-2.5-2.9S74.3,78.6,75.7,78.6z" fill="#6daedb" style=""></path></g><desc>Created with Snap</desc><defs></defs></g><g><g transform="matrix(0.5,0,0,-0.5,0,0)"><path d="M1385 -350L1267 -470Q1219 -422 1108 -275Q997 -127 942 -13Q880 -22 814 -22Q590 -22 430 73Q271 169 191 339Q112 510 112 740Q112 1095 297 1300Q482 1505 815 1505Q1143 1505 1328 1298Q1514 1092 1514 739Q1514 482 1409 296Q1304 111 1108 31Q1124 3 1152 -43Q1180 -88 1253 -191Q1327 -293 1385 -350ZM427 291Q558 129 814 129Q1070 129 1199 291Q1329 453 1329 739Q1329 1031 1198 1192Q1068 1353 815 1353Q562 1353 429 1192Q296 1031 296 739Q296 454 427 291ZM1731 366L1731 1097L1899 1097L1899 364Q1899 292 1919 242Q1940 192 1978 164Q2017 137 2065 125Q2114 113 2177 113Q2307 113 2379 170Q2452 227 2452 364L2452 1097L2620 1097L2620 366Q2620 282 2596 215Q2572 148 2531 103Q2491 59 2434 30Q2377 1 2313 -12Q2250 -25 2177 -25Q2105 -25 2041 -12Q1977 1 1919 30Q1862 60 1820 104Q1779 149 1755 216Q1731 283 1731 366ZM4429 0L4262 0L4262 571Q4262 651 4258 705Q4255 759 4242 815Q4230 871 4207 903Q4185 936 4145 956Q4105 977 4049 977Q3939 977 3861 918Q3784 859 3751 752Q3742 680 3742 598L3742 0L3575 0L3575 589Q3575 663 3570 717Q3565 772 3551 823Q3537 875 3513 907Q3490 939 3451 958Q3412 977 3358 977Q3238 977 3156 916Q3075 855 3047 754Q3038 677 3038 587L3038 0L2871 0Q2869 1029 2869 1097L3009 1097L3030 940Q3080 1016 3172 1068Q3264 1120 3381 1120Q3442 1120 3493 1107Q3545 1095 3579 1076Q3614 1057 3641 1030Q3668 1004 3683 978Q3698 953 3708 925Q3828 1120 4075 1120Q4258 1120 4343 1015Q4429 911 4429 706L4429 0ZM5328 1454L5328 1242L5173 1242L5173 1454L5328 1454ZM4937 1454L4937 1242L4783 1242L4783 1454L4937 1454ZM5274 894Q5201 982 5073 982Q4945 982 4864 891Q4783 801 4769 644L5348 644Q5348 807 5274 894ZM5106 -23Q4867 -23 4729 129Q4592 281 4592 545Q4592 800 4725 958Q4858 1117 5075 1120Q5279 1120 5398 980Q5518 841 5518 608Q5518 596 5517 564Q5517 532 5517 518L4764 518Q4767 331 4860 226Q4954 122 5112 122Q5286 122 5461 214L5487 79Q5320 -23 5106 -23ZM6077 -23Q5965 -23 5870 1Q5776 25 5717 63L5738 204Q5905 115 6066 115Q6310 115 6317 287Q6317 360 6265 402Q6213 444 6061 496L5978 525Q5834 573 5772 644Q5711 715 5710 821Q5710 950 5813 1035Q5917 1120 6097 1120Q6283 1120 6436 1048L6387 920Q6232 984 6097 984Q5992 984 5932 942Q5873 901 5873 826Q5873 762 5916 728Q5959 694 6088 650Q6121 638 6171 622Q6337 568 6406 494Q6475 421 6475 296Q6473 144 6366 60Q6259 -23 6077 -23ZM7609 0L7442 0L7442 663Q7442 828 7389 903Q7337 978 7206 978Q7080 978 6993 915Q6907 852 6881 752Q6872 677 6872 585L6872 0L6705 0L6705 1523L6872 1533L6872 1087Q6872 1030 6868 946Q7009 1120 7242 1120Q7609 1120 7609 689L7609 0ZM8165 -20Q8003 -20 7935 59Q7867 138 7863 314L7863 973L7700 973L7707 1083L7862 1097L7919 1348L8029 1352L8029 1097L8334 1097L8334 973L8029 973L8029 344Q8029 219 8067 168Q8105 117 8197 117Q8230 117 8340 133L8347 1Q8228 -20 8165 -20ZM8647 546Q8647 351 8733 233Q8820 116 8986 116Q9150 116 9233 233Q9317 350 9317 548Q9317 749 9234 864Q9152 980 8983 980Q8819 980 8733 862Q8647 744 8647 546ZM9490 549Q9490 294 9354 135Q9218 -23 8978 -23Q8747 -23 8610 137Q8474 297 8474 548Q8474 804 8611 962Q8748 1120 8987 1120Q9222 1120 9356 961Q9490 803 9490 549ZM10218 1107Q10263 1107 10300 1101L10294 947Q10248 955 10214 955Q10074 955 9986 857Q9899 760 9899 616L9899 0L9732 0Q9731 1010 9731 1097L9870 1097L9886 900Q9943 993 10031 1050Q10119 1107 10218 1107ZM10491 1097L10659 1097L10659 -139Q10659 -245 10645 -310Q10632 -375 10594 -421Q10557 -466 10493 -484Q10429 -502 10326 -502L10274 -502L10252 -351L10304 -351Q10343 -351 10371 -347Q10400 -342 10420 -335Q10441 -328 10454 -312Q10467 -296 10474 -282Q10482 -267 10485 -238Q10489 -209 10490 -186Q10491 -163 10491 -121L10491 1097ZM10491 1496L10659 1496L10659 1298L10491 1298L10491 1496ZM11234 112Q11353 112 11443 177Q11534 243 11560 354L11560 539Q11555 539 11499 534Q11444 529 11427 528Q11210 509 11124 457Q11039 405 11039 290Q11039 202 11091 157Q11143 112 11234 112ZM11727 0L11597 0Q11582 64 11568 138Q11477 47 11397 12Q11317 -23 11209 -23Q11055 -23 10961 57Q10868 138 10868 289Q10868 457 10995 538Q11123 619 11363 639Q11396 642 11462 647Q11529 653 11562 656L11562 753Q11562 869 11508 925Q11454 981 11338 981Q11176 981 11011 901Q11006 913 10985 970Q10964 1028 10963 1030Q11036 1071 11136 1095Q11237 1120 11341 1120Q11546 1120 11636 1030Q11727 941 11727 726L11727 0Z" fill="#173753" style=""></path></g></g><g transform="matrix(1,0,0,1,3018,1324.7)"><g transform="matrix(0.5,0,0,-0.5,0,0)"><path d="M819 -22Q650 -22 515 34Q381 91 293 192Q206 294 159 433Q113 572 113 738Q113 962 198 1134Q283 1306 451 1405Q619 1504 849 1504Q1104 1504 1297 1388L1231 1245Q1045 1352 851 1352Q716 1352 609 1305Q503 1259 435 1176Q368 1094 332 982Q297 871 297 738Q297 456 437 292Q578 129 852 129Q1008 129 1169 192L1169 614L820 614L826 765L1331 765L1331 89Q1205 29 1087 3Q970 -22 819 -22ZM2236 894Q2163 982 2035 982Q1907 982 1826 891Q1745 801 1731 644L2310 644Q2310 807 2236 894ZM2068 -23Q1829 -23 1691 129Q1554 281 1554 545Q1554 800 1687 958Q1820 1117 2037 1120Q2241 1120 2360 980Q2480 841 2480 608Q2480 596 2479 564Q2479 532 2479 518L1726 518Q1729 331 1822 226Q1916 122 2074 122Q2248 122 2423 214L2449 79Q2282 -23 2068 -23ZM2600 0L3002 558L2615 1097L2806 1097L3099 679L3393 1097L3584 1097L3196 556L3594 0L3409 0L3100 441L2791 0L2600 0ZM4675 0L4508 0L4508 663Q4508 828 4455 903Q4403 978 4272 978Q4146 978 4059 915Q3973 852 3947 752Q3938 677 3938 585L3938 0L3771 0L3771 1523L3938 1533L3938 1087Q3938 1030 3934 946Q4075 1120 4308 1120Q4675 1120 4675 689L4675 0ZM5198 112Q5317 112 5407 177Q5498 243 5524 354L5524 539Q5519 539 5463 534Q5408 529 5391 528Q5174 509 5088 457Q5003 405 5003 290Q5003 202 5055 157Q5107 112 5198 112ZM5691 0L5561 0Q5546 64 5532 138Q5441 47 5361 12Q5281 -23 5173 -23Q5019 -23 4925 57Q4832 138 4832 289Q4832 457 4959 538Q5087 619 5327 639Q5360 642 5426 647Q5493 653 5526 656L5526 753Q5526 869 5472 925Q5418 981 5302 981Q5140 981 4975 901Q4970 913 4949 970Q4928 1028 4927 1030Q5000 1071 5100 1095Q5201 1120 5305 1120Q5510 1120 5600 1030Q5691 941 5691 726L5691 0Z" fill="#173753" style=""></path></g></g></g></svg>
			</div><!-- .site-branding -->
			<?php
		}

		/**
		 * Mobile menu trigger
		 */
		public function trigger() { ?>
			<?php $icon = get_theme_mod( 'mobile_menu_icon', 'mobile-icon2' ); ?>
			<a href="#" class="menu-toggle">
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( $icon, true ); ?></i>
			</a>
			<?php
		}

		/**
		 * Sticky mode
		 */
		public function sticky() {
			$enabled 	= get_theme_mod( 'enable_sticky_header', 0 );
			$type 		= get_theme_mod( 'sticky_header_type', 'always' );
			$sticky		= '';

			if ( $enabled ) {
				$sticky = 'sticky-header sticky-' . esc_html( $type );
			}

			return $sticky;
		}

	}

	/**
	 * Initialize class
	 */
	Botiga_Header::get_instance();

endif;