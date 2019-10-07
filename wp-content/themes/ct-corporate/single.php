<?php
/**
 * The template for displaying all single posts.
 *
 * @package CT Corporate
 */

get_header();
// Boxed or Fullwidth
$boxedornot = ct_corporate_boxedornot();
$content_class = "";
$sidebar_class = ct_corporate_check_sidebar();
if($sidebar_class == 'pull-left'):
    $content_class = 'pull-right';
elseif($sidebar_class == 'pull-right'):
    $content_class = 'pull-left';
elseif($sidebar_class == 'no-sidebar'):
    $content_class = 'no-sidebar';
endif;

?>

	<?php ct_corporate_breadcrumb(); ?>
	<!-- End the Breadcrumb -->

	<?php if ($boxedornot == 'fullwidth') {?>
		<!-- Start the container -->
        <div class="container full-width-container">
    <?php }?>

		<div id="primary" class="content-area <?php echo $content_class;?>">

			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

					<?php the_post_navigation( array(
            'prev_text'				=> __( '%title <i class="fa fa-long-arrow-left post-arrow"></i>', 'ct-corporate' ),
            'next_text'				=> __( '<i class="fa fa-long-arrow-right post-arrow"></i> %title', 'ct-corporate' ),
            'in_same_term'    		=> true,
            'screen_reader_text'	=> esc_html__( 'Continue Reading', 'ct-corporate'),
        ) );?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main>
			<!-- End #main -->
		</div>
		<!-- End #primary -->

<?php if($sidebar_class != 'no-sidebar'):?>


        <div id="secondary" class="widget-area clearfix <?php echo $sidebar_class;?>" role="complementary">
            <?php if (is_active_sidebar('sidebar-1')) {
                dynamic_sidebar('sidebar-1');
            } ?>
        </div>

<?php endif; ?>

	<?php if ($boxedornot == 'fullwidth') {?>
        </div>
        <!-- End the Container -->
    <?php }?>

<?php get_footer(); ?>