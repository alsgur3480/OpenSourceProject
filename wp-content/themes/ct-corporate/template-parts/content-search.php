<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CT Corporate
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
             <?php get_template_part( 'template-parts/content', get_post_format() );  ?>
    </div>
    <!-- End Entry-content -->
    <footer class="entry-footer clearfix">
        <?php ct_corporate_entry_footer(); ?>
    </footer>
</article>
<!-- End Article Post -->