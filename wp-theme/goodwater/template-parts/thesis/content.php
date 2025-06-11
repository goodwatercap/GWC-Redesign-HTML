<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
		<?php	if ( 'post' === get_post_type() && !is_single() ) : ?>
            <a class="post" href="<?php the_permalink();?>">
                <div class="post-image"><img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>"></div>
                <?php
                $category = get_the_category();
                $parent = get_cat_name($category[0]->category_parent);
                $categoryName = $category[0]->cat_name;
                ?>
                <div class="post-content">
                   <div class="post-text">
                       <h3><?php the_title();?></h3>
                       <p><?php the_field('subtitle');?></p>
                   </div>
                   <div class="post-tags">
                        <div class="l-tag <?php echo $categoryName ?>">
                            <?php echo $categoryName ?>
                        </div>
                   </div>
                </div>


            </a>
		<?php endif;?>

	
	
		<?php	if (is_single()) : ?>
				<div class="entry-content">
					<div class="post-content">
					<?php 
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Read Blog<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
						get_the_title()
					), false);?>
					</div>
				</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
