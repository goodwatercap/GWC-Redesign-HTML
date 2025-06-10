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
				<div class="post-image"><img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>"></div>
				<div class="post-content">
					<div class="container">						
						<?php
                            $category = get_the_category();
                            $parent = get_cat_name($category[0]->category_parent);
                            $categoryName = $category[0]->cat_name;
                        ?>
                        <div class="post-category <?php echo $categoryName ?>">
                            <?php echo $categoryName ?>
                        </div>
						<h2><?php the_title();?></h2>
						<div class="subtitle"><?php the_field('subtitle');?></div>
						<a href="<?php the_permalink();?>" class="l-btn l-btn--dark">Read More <i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                                </svg></i></a>
					</div>
				</div>					
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
