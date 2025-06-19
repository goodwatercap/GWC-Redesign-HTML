<?php
/**
 * The archive template file
 * Template Name: Archive
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
get_header();
?>
<div class="archive-page">
    <!-- Banner Section -->
    <?php get_template_part('template-parts/inner-page/banner'); ?>
    <div class="container container--lg">
        <?php
        insights_posts_query();
        if ( have_posts() ) : ?>
            <div class="posts-wrapper">
                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    ?>
                    <div class="post-wrapper">
                    <?php get_template_part( 'template-parts/thesis/content', get_post_format() ); ?>
                    </div>
                <?php endwhile;?>
            </div>

            <?php
//            the_posts_pagination( array(
//                'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
//                'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
//                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
//            ) );

        else :

            get_template_part( 'template-parts/thesis/content', 'none' );

        endif; ?>
    </div>
    <div class="gwc masterclass">
        <div class="container container--lg">
            <h2 class="l-caption">Masterclass</h2>
            <div class="masterclasses-wrapper">
                <?php
                foreach (retrieve_contentful_listings(0, 20) as $count => $item) {
                    get_template_part( 'template-parts/thesis/masterclass-content', null, array('fields' => $item));
                } ?>
            </div>
        </div>
    </div>


    <?php get_footer(); ?>
</div>