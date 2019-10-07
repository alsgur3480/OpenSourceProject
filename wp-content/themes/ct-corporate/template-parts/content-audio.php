<?php
/**
 * The template for displaying Audio post formats
 *
 * @package CT Corporate
 */
?>
<?php
    global $post;
    $featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $content =  trim(  get_post_field('post_content', $post->ID) );
    $front = get_option('show_on_front');
    if(!is_single() && !is_archive() && !is_search() &&  !is_page_template('page-templates/template-blog.php')) {
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="post-content entry-content">

            <?php if( is_front_page() &&$front == 'posts'){ ?>

                <div class="featured-item clearfix">
                    <?php
                        $content = trim(  get_post_field('post_content', $post->ID) );
                        $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                        if( $new_content){
                            echo do_shortcode( $matches[0][0] );
                        }
                        else{
                            echo ct_corporate_the_featured_video($content);
                        }
                    ?>
                </div>

            <?php  } ?>

            <?php if(  is_front_page() && $front == 'posts'){ ?>

                <header class="entry-header">

                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                    <div class="entry-meta">
                        <?php ct_corporate_posted_on(); ?>
                    </div>
                    <!-- End Entry-meta -->

                </header>

            <?php } ?>

            <?php if($front == 'posts' && is_front_page()){ ?>

                <div class="entry-wrap clearfix">
                    <?php the_excerpt(); ?>
                </div>

            <?php } else { ?>

               <div class="entry-wrap clearfix">

                    <?php
                        $content = trim(  get_post_field('post_content', $post->ID) );
                        $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
                        if( $new_content){
                            echo do_shortcode( $matches[0][0] );
                        }
                        else{
                            echo ct_corporate_the_featured_video($content);
                        }
                    ?>

                </div>

            <?php } ?>

        </div>
        <!-- End Entry Content -->

        <?php if( is_front_page() &&$front == 'posts'){ ?>

            <footer class="entry-footer clearfix">

                <?php ct_corporate_entry_footer(); ?>

            </footer>
            <!-- End Entry-footer -->

        <?php } ?>

    </article>

<?php } else {  ?>

    <!-- If the post is single or archive display this block  -->
        <header class="entry-header">

            <?php
                if ( is_single() ) {
                    the_title( '<h2 class="entry-title">', '</h2>');
                }
                else {
                    the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                }
            ?>

            <div class="entry-meta">
                <?php ct_corporate_posted_on(); ?>
            </div>

        </header>

        <div class="entry-wrap clearfix">

            <?php

                if(is_search() || is_archive()  || is_page_template('page-templates/template-blog.php')){
                    $title = get_the_title();
                    if(empty($title)) { echo '<a href="'.esc_url(get_the_permalink()).'">';}
                         echo wp_kses_post(ct_corporate_strip_url_content($post, 40 ));
                    if(empty($title)) { echo '</a>'; }
                }
                else{
                    the_content( __( 'more <span class="meta-nav">...</span>', 'ct-corporate' ) );

                    $default =  array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:','ct-corporate' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page','ct-corporate' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                    );

                wp_link_pages( $default );
                }
            ?>
        </div>

        <?php if (!is_archive() && !is_search()) { ?>

            <footer class="entry-footer clearfix">
                <?php ct_corporate_entry_footer(); ?>
            </footer>

        <?php } ?>
        <!-- End Entry Footer -->

<?php } ?>