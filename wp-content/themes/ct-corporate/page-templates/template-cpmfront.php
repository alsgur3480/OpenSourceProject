<?php
/**
 *
 * Template Name: Frontpage
 * Description: A page template that displays the Homepage or a Front page as in theme main page with slider and some other contents of the
 * post.
 *
 * @package CT Corporate
 */

get_header();
// Boxed or Fullwidth
$boxedornot = ct_corporate_boxedornot();
$section_background = get_theme_mod('section_background');

    // Get Slider Posts from the customizer
    if ( get_theme_mod( 'featured_post' ) != "" ) {
        $slider_posts_id =  get_theme_mod( 'featured_post' ) ; // can't be escaped as it returns value in array.
        $slider_posts_args = array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'post__in'       => (array)$slider_posts_id,
        );
        $slider_variable = get_posts( $slider_posts_args );
    ?>

    <!-- Home page pro Slider -->
    <div id="home-slider" class="featured-slider slick-slider" >

        <?php
            foreach ( $slider_variable as $key => $slider_value ) {
                $image = wp_get_attachment_url( get_post_thumbnail_id( $slider_value->ID ) );
            ?>
                <div class="slide-item" style="background-image: url('<?php echo esc_url( $image ); ?>');">
                        <div class="slider-image">
                            <div class="slider-desc-wrapper">

                                <div class="slider-desc-text">

                                    <div class="slider-desc">
                                        <h1><a href="<?php echo esc_url( get_permalink( $slider_value->ID ) ); ?>"><?php echo wp_kses_post(wp_trim_words( $slider_value->post_title, 16 )) ?></a></h1>
                                        <p><?php echo  wp_kses_post(ct_corporate_strip_url_content($slider_value, 20)); ?></p>
                                        <a href="<?php echo esc_url( get_permalink( $slider_value->ID ) ); ?>" class="pillbtn promo-btn btn" role="button">
                                            <?php esc_html_e('Read More ','ct-corporate'); ?><i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    <!-- Slide Desc Wrapper -->

                </div>
                <!-- Slide Item -->
        <?php } ?>

    </div>

    <?php } ?>
    <!-- End of Home page slider -->

    <!-- The Call Out section starts here -->
    <?php
        $cat_id = get_theme_mod( 'first_post' );

        if ($cat_id != 'none') {

            $args = array(
                'post_type'     => 'page',
                'post_status'    => 'publish',
                'post__in'       => (array)$cat_id,
                'posts_per_page' => 3,
                );
            $events = new WP_Query( $args );

            if ( $events->have_posts() ) :?>
                <section class="section aboutbox">
                        <?php if ($boxedornot == 'fullwidth') {?>
                            <div class="container">
                        <?php } ?>
                            <div class="row">
                                <h2 class="section-title text-center"><?php echo esc_html(get_theme_mod('first_post_title')); ?></h2>
                                <?php
                                while( $events->have_posts() ) : $events->the_post();
                                    $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                                    $attachment = get_post_meta($post_thumbnail_id);
                                    $featured_image = wp_get_attachment_image_src($post_thumbnail_id , 'full');
                                    ?>
                                <div class="col-md-4">
                                    <article <?php post_class();?>>

                                        <div class="service-wrap mob-center">

                                            <div class="media-wrapper">
                                                <div class="media-wrap" style="background-image:url('<?php echo esc_url($featured_image[0]);?>">
                                                    <a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" class="btn service-read"><?php esc_html_e('Read More', 'ct-corporate'); ?></a>
                                                </div>
                                            </div>
                                            <div class="service-body">
                                                <h3><a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"> <?php the_title(); ?></a></h3>
                                                <p><?php echo  wp_kses_post(ct_corporate_strip_url_content($post, 10)); ?></p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <?php
                                endwhile;
                                 ?>
                            </div>
                            <?php if ($boxedornot == 'fullwidth') {?>
                                </div>
                            <?php }?>

                    </section>
                    <?php
                    endif;
            wp_reset_postdata();

        }

    ?>
    <?php
        if ( is_front_page() ) {
            if ( get_theme_mod( 'cta_heading' ) !='' || get_theme_mod('cta_content_text') !='' ) { ?>
                <section id="promo" class="section promo" style="background: #2b2b2b <?php if(!empty($section_background)) { ?>url(<?php echo esc_url($section_background);?>)repeat center center fixed" <?php } ?>>
                    <?php if ($boxedornot == 'fullwidth') {?>
                        <div class="container">
                    <?php }?>
                        <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="promo-content">
                                        <h2><?php echo esc_attr(get_theme_mod( 'cta_heading' )); ?> </h2>
                                        <p><?php echo esc_attr(get_theme_mod( 'cta_content_text' )); ?></p>
                                    </div>
                                    <?php
                                        $cta_text = esc_attr(get_theme_mod('cta_link_text'));
                                        $cta_link_url = esc_attr(get_theme_mod('cta_link_url'));
                                        if( !empty($cta_text) && !empty($cta_link_url)){
                                    ?>
                                        <a href="<?php echo esc_url($cta_link_url); ?>" class="pillbtn promo-btn btn" target="_blank">
                                            <?php echo esc_html($cta_text); ?>
                                        </a>
                                <?php } ?>
                                </div>
                            </div>
                    <?php if ($boxedornot == 'fullwidth') {?>
                        </div>
                    <?php }?>
                </section>
    <?php   } ?>
<?php

if ( post_type_exists( 'jetpack-portfolio' )) {

    $portfolio_args = array(
        'post_type' => 'jetpack-portfolio',
        'orderby'   => 'DATE',
        'order'     => 'DESC',
        );

    $portfolio_query = new WP_Query($portfolio_args);

        if ($portfolio_query->have_posts()) {
            ?>
            <section id="portfolio" class="section portfolio">
                <?php if ($boxedornot == 'fullwidth') {?>
                        <div class="container">
                    <?php }?>
                    <div class="row">
                        <?php if (get_theme_mod('portfolio_post_title')) { ?><h2 class="section-title text-center"><?php echo esc_html(get_theme_mod('portfolio_post_title')); ?></h2> <?php } ?>
                        <?php while ($portfolio_query->have_posts()) { $portfolio_query->the_post(); ?>
                            <div class="col-md-4">
                                <div class="box">
                                    <?php if (has_post_thumbnail()) { the_post_thumbnail(); }?>
                                    <div class="box-content">
                                        <div class="content">
                                            <h3 class="title"><?php the_title(); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php if ($boxedornot == 'fullwidth') {?>
                        </div>
                    <?php }?>
            </section>
<?php   }

}
 ?>
<!-- Portfolio section ends -->

<div class="pre-footer">
    <?php

            if ( get_theme_mod( 'author_name' ) != '' && get_theme_mod( 'testimonial_content' ) != '' ) { ?>
                <section id="testimonials" class="section ">
                    <?php if ($boxedornot == 'fullwidth') {?>
                        <div class="container">
                    <?php }?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                                <blockquote class="blockquotev1">
                                    <?php echo esc_attr(get_theme_mod( 'testimonial_content' )); ?>
                                  <span>- <?php echo esc_attr(get_theme_mod( 'author_name' )); ?></span>
                                </blockquote>
                            </div>
                        </div>
                    <?php if ($boxedornot == 'fullwidth') {?>
                        </div>
                    <?php }?>
                </section>
    <?php   }
        }?>


</div>

<?php

    $args = array(
        'post_type' => 'post',
        'orderby' => 'DATE',
        'order'     => 'DESC',
        'posts_per_page' => 3,
        );

    $featured = new WP_Query( $args );

    if ( $featured->have_posts() ) :

        ?>
    <section id="about" class="section blogroll aboutbox" >
        <?php if ($boxedornot == 'fullwidth') {?>
            <div class="container">
        <?php }?>
        <div class="row">

            <h2 class="section-title text-center"><?php esc_html_e('From the Blog','ct-corporate');?></h2>

            <?php while( $featured->have_posts() ): $featured->the_post();?>
                <div class="col-md-4 col-sm-12 text-center">
                    <div <?php post_class(); ?>>

                        <div class="blog-content clearfix">

                            <div class="blog-content-image effect-thumb">
                                <?php get_template_part('template-parts/content', get_post_format($post->ID)); ?>
                            </div>

                            <div class="blog-content-head">
                                <h4><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h4>
                            </div>
                            <div class="blog-content-wrap">
                                <p><?php echo wp_kses_post(ct_corporate_strip_url_content($post, esc_attr(get_theme_mod('excerpt_length', 20)) )); ?></p>
                            </div>
                            <?php if ( get_theme_mod('show_blog_meta', 1)  ) { ?>
                                <div class="entry-meta">
                                    <?php
                                    $blog_post_author = get_avatar( get_the_author_meta( 'ID' ) , 32 );
                                    $author_name = get_the_author_meta( 'display_name' );
                                    $author_firstname = get_the_author_meta( 'first_name' );
                                    $author_lastname = get_the_author_meta( 'last_name' );
                                    $author_id = get_the_author_meta( 'ID' );
                                    $author_image = get_avatar($author_id); ?>
                                    <div class="date"><i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo esc_html(get_the_date()); ?></span></div>
                                    <div class="author">
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
                                            <span><?php echo esc_html($author_name); ?></span><span class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60, '', 'author-image', '' ); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Blog Content -->

                    </div>
                    <!-- End the Blog wrap -->
                </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div>
        <!-- End Row -->

        <?php if ($boxedornot == 'fullwidth') {?>
            </div>
        <?php }?>

    </section>
    <!-- End the blogroll -->

<?php endif; ?>
<?php get_footer(); ?>
