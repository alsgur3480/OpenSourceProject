<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package CT Corporate
 */

get_header();
// Boxed or Fullwidth
$boxedornot = ct_corporate_boxedornot();
?>
	<?php ct_corporate_breadcrumb(); ?>
	<!-- End the Breadcrumb -->

	<?php if ($boxedornot == 'fullwidth') {?>
		<!-- Start the container. If full width layout is selected in the Customizer.-->
        <div class="container full-width-container">
    <?php }?>

		<div id="primary" class="content-area ">

			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">

					<div class="no-image-fall image-404">
						<span><?php esc_html_e('404 Error. This page can&rsquo;t be found.','ct-corporate');?></span>
					</div>

					<div class="page-content">

						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try to search it below?','ct-corporate' ); ?></p>

						<section class="searchpage-form">
							<div class="page-content">
								<?php get_search_form(); ?>
							</div>
							<!-- End the .page-content -->
						</section>
						<!-- End .no-results -->
					</div>
					<!-- End the .page-content -->

				</section>
				<!-- End the .error-404 -->

			</main>
			<!-- End the #main -->

		</div>
		<!-- End the #primary -->

		<div id="secondary" class="widget-area clearfix left-sidebar" role="complementary">
			<?php get_sidebar(); ?>
		</div>
		<!-- End the Sidebar -->

	<?php if ($boxedornot == 'fullwidth') {?>
        </div>
		<!-- End the container -->
    <?php }?>

<?php get_footer(); ?>