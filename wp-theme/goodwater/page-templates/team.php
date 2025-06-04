<?php
/**
 * The team template file
 * Template Name: Team
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header(); ?>


<!-- Banner Section -->
<?php get_template_part('template-parts/inner-page/banner',null,array('class'=>'banner--team')); ?>
<!-- People Section -->
<?php get_template_part('template-parts/team/people') ?>

<?php get_footer(); ?>
