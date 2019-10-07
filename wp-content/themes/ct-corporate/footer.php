<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package CT Corporate
 */
?>


<?php
$boxedornot = ct_corporate_boxedornot();

?>


	</div><!-- #content -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php
				$facebook = get_theme_mod('site_facebook_link');
				$twitter = get_theme_mod('site_twitter_link');
				$site_gplus_link = get_theme_mod('site_gplus_link');
				$site_youtube_link = get_theme_mod('site_youtube_link');
				$site_instagram_url = get_theme_mod('site_instagram_url');
				$linkedin_url = get_theme_mod('linkedin_url');
				$site_dribble_link = get_theme_mod('site_dribble_link');
				$site_pinterest_link = get_theme_mod('site_pinterest_link');
				$site_email_address = get_theme_mod('site_email_address');
				$site_skype_address = get_theme_mod('site_skype_address');

			if( $facebook || $twitter || $site_gplus_link || $site_youtube_link || $site_instagram_url || $linkedin_url || $site_dribble_link || $site_pinterest_link || $site_skype_address || $site_email_address){

			?>
				<section class="section social-section">
					<?php if ($boxedornot == 'fullwidth') {?>
					<div class="container">
						<?php }?>
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="social-content">
									<h2><?php echo esc_html( get_theme_mod( 'social_media_title' ) ) ? esc_html(get_theme_mod( 'social_media_title' )) : esc_html__('SPREAD THE LOVE', 'ct-corporate'); ?></h2>
									<div class="social-sharing">
										<?php if ( get_theme_mod( 'site_facebook_link' ) != null ) { ?>
										<a href="<?php echo esc_url(get_theme_mod( 'site_facebook_link' )); ?>" class="fb" target="_blank"><i class="fa fa-facebook"></i></a>
										<?php }
										if ( get_theme_mod( 'site_twitter_link' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_twitter_link' )); ?>" class="tw" target="_blank"><i class="fa fa-twitter"></i></a>
										<?php }
										if ( get_theme_mod( 'site_gplus_link' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_gplus_link' )); ?>" class="gp" target="_blank"><i class="fa fa-google-plus"></i></a>
											<?php }
										if ( get_theme_mod( 'site_youtube_link' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_youtube_link' )); ?>" class="yt" target="_blank"><i class="fa fa-youtube-play"></i></a>
											<?php }
										if ( get_theme_mod( 'site_instagram_url' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_instagram_url' )); ?>" class="in" target="_blank"><i class="fa fa-instagram"></i></a>
											<?php }
										if ( get_theme_mod( 'linkedin_url' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'linkedin_url' )); ?>" class="ld" target="_blank"><i class="fa fa-linkedin"></i></a>
											<?php }
										if ( get_theme_mod( 'site_dribble_link' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_dribble_link' )); ?>" class="dr" target="_blank"><i class="fa fa-dribbble"></i></a>
											<?php }
										if ( get_theme_mod( 'site_pinterest_link' ) != null ) {
											?>
											<a href="<?php echo esc_url(get_theme_mod( 'site_pinterest_link' )); ?>" class="pi" target="_blank"><i class="fa fa-pinterest"></i></a>
											<?php }
											if ( get_theme_mod( 'site_email_address' ) != null ) {
												?>
										<a href="mailto:<?php echo esc_attr(antispambot(get_theme_mod( 'site_email_address' ))); ?>" class="pi"><i class="fa fa-envelope"></i></a>
										<?php }
										if ( get_theme_mod( 'site_skype_address' ) != null ) {
											?>
											<a href="callto:<?php echo esc_attr(get_theme_mod( 'site_skype_address' )); ?>" class="pi"><i class="fa fa-phone"></i></a>
											<?php } ?>
									</div>
								</div>
							</div>
						</div>
				  	<?php if ($boxedornot == 'fullwidth') {?>
				    	</div>
				    <?php }?>
				</section>
			<?php } ?>
			<div class="footer-widget">
				<div class="container">
					<div class="row">

						<div class="col-md-4 col-sm-12 pad0 foot-bor">
							<?php
								if ( is_active_sidebar( 'footer-1' ) ) {
									dynamic_sidebar( 'footer-1' );
								}
								else{
									if(is_user_logged_in() && current_user_can('edit_theme_options') ){
										echo '<h6 class="text-center"><a href="'.esc_url(admin_url("customize.php")).'"><i class="fa fa-plus-circle"></i>'.esc_html__('Assign a Widget', 'ct-corporate').'</a></h6>';
									}
								}
							?>
						</div>

						<div class="col-md-4 col-sm-12 pad0 foot-bor">
							<?php
								if ( is_active_sidebar( 'footer-2' ) ) {
									dynamic_sidebar( 'footer-2' );
								}
								else{
									if(is_user_logged_in()&& current_user_can('edit_theme_options') ){
										echo '<h6 class="text-center"><a href="'.esc_url(admin_url("customize.php")).'"><i class="fa fa-plus-circle"></i>'.esc_html__('Assign a Widget', 'ct-corporate').'</a></h6>';
									}
								}
							?>
						</div>

						<div class="col-md-4 col-sm-12 pad0 foot-bor br0">
							<?php
								if ( is_active_sidebar( 'footer-3' ) ) {
									dynamic_sidebar( 'footer-3' );
								}
								else{
									if(is_user_logged_in()&& current_user_can('edit_theme_options')  ){
										echo '<h6 class="text-center"><a href="'.esc_url(admin_url("customize.php")).'"><i class="fa fa-plus-circle"></i>'.esc_html__('Assign a Widget', 'ct-corporate').'</a></h6>';
									}
								}
							?>
						</div>
						<!-- End Footer Widget Columns -->

					</div>
				</div>

	        </div>
	        <!-- Footer Widgets -->

	        <div class="copyright clearfix">

	        	<?php if ($boxedornot == 'fullwidth') {?>
			    	<div class="container">
			    <?php }?>

			    <div class="container pad0">

				  	<div class="copyright-content">
				        <p class="text-right">
				        	<?php $copyright_link = esc_url('https://codethemes.co/'); ?>
				        		<?php esc_html_e('Theme by ', 'ct-corporate');?>
		        				<a href="<?php echo esc_url($copyright_link); ?>" target="_blank">
		        					 <?php printf( esc_html__( 'Code Themes','ct-corporate' ), 'Code Themes' ); ?>
		        				</a>
						</p>
				  	</div>

			  	</div>

			  	<?php if ($boxedornot == 'fullwidth') {?>
			    	</div>
			    <?php }?>

			</div>
			<!-- End the Copyright -->

		</footer>
	<!-- End the Footer -->
</div>
<!-- End the Page -->

<a href="#0" class="cp-top"><?php esc_html_e('Top', 'ct-corporate');?></a>
<!-- End the scroll to top -->

<?php wp_footer(); ?>
</body>
</html>