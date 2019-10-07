<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package CT Corporate
 */
$featured_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$featured_image_id = get_post_thumbnail_id();
$image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
$alttxt = ($image_alt ? $image_alt : '');
$front = get_option('show_on_front');
?>
<?php if (!is_single() && !is_archive() && !is_search() && !is_page_template('page-templates/template-blog.php')): ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="post-content entry-content">
            <?php if ($front == "page") :
                if ($featured_image) { ?>
                    <div class="featured-image archive-thumb">
                        <a title="<?php the_title(); ?>" href="<?php echo esc_url(get_permalink()); ?>"
                           class="post-thumbnail">
                            <img src="<?php echo esc_url($featured_image); ?>"
                                 class="attachment-custom_post_size wp-post-image"
                                 alt="<?php echo esc_attr($alttxt); ?>">
                            <div class="share-mask">
                                <div class="share-wrap">
                                    <div class="share-content">
                                        <h2><?php esc_html_e('Read More', 'ct-corporate'); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } else { ?>
                    <div class="clearfix">
                        <ul class="gallery_wrap row clearfix">
                            <?php
                            $gallery = get_post_gallery();
                            echo $gallery;
                            ?>
                        </ul>
                    </div>
                <?php }
            else: // if front page is latest posts?>
                <div class="clearfix">
                    <ul class="gallery_wrap row clearfix">
                        <?php
                        $gallery = get_post_gallery();
                        echo $gallery;
                        ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (is_front_page() && $front == 'posts' || is_home()) { ?>

                <header class="entry-header">
                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                </header>

                <div class="entry-wrap clearfix">
                    <?php echo wp_kses_post(ct_corporate_strip_url_content($post, 20)); ?>
                </div>

            <?php } ?>

        </div>
        <!-- End Entry Content -->

        <?php if (is_front_page() && $front == 'posts') { ?>

            <footer class="entry-footer clearfix">
                <?php ct_corporate_entry_footer(); ?>
            </footer><!-- .entry-footer -->

        <?php } ?>

    </article>

<?php else: ?>

    <!-- If the post is single or archive display this block  -->
    <?php if (is_single() && !empty($featured_image)) { ?>
        <div class="featured-image archive-thumb">
            <a title="<?php the_title(); ?>" href="<?php echo esc_url(get_permalink()); ?>" class="post-thumbnail">
                <img src="<?php echo esc_url($featured_image); ?>" class="attachment-custom_post_size wp-post-image" alt="<?php echo esc_attr($alttxt); ?>">
                <div class="share-mask">
                    <div class="share-wrap">
                        <div class="share-content">
                            <h2><?php esc_html_e('Read More', 'ct-corporate'); ?></h2>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
    <header class="entry-header">

        <?php if (is_single()) {
            the_title('<h2 class="entry-title">', '</h2>');
        } else {
            the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        } ?>

        <div class="entry-meta">
            <?php ct_corporate_posted_on(); ?>
        </div>

    </header>

    <?php if (!is_single()) { ?>
        <div class="clearfix">
            <ul class="gallery_wrap row clearfix">
                <?php
                $gallery = get_post_gallery();
                echo $gallery;
                ?>
            </ul>
        </div>
    <?php } ?>

    <div class="entry-wrap clearfix">
        <?php
        if (is_single()) {
            the_content(sprintf(
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ct-corporate'),
                get_the_title()
            ));

            $default = array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ct-corporate') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'ct-corporate') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            );
            wp_link_pages($default);

        } else { ?>
            <?php
            $title = get_the_title();
            if (empty($title)) {
                echo '<a href="' . esc_url(get_the_permalink()) . '">';
            }
            echo wp_kses_post(ct_corporate_strip_url_content($post, 40));
            if (empty($title)) {
                echo '</a>';
            }
        }
        ?>
    </div>

    <?php if (!is_archive() && !is_search()) { ?>

        <footer class="entry-footer clearfix">
            <?php ct_corporate_entry_footer(); ?>
        </footer>

    <?php } ?>

    <!-- End Entry Footer -->

<?php endif; ?>