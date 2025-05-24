<?php
/**
 * The homepage template file
 * Template Name: Home
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */

get_header(); ?>

<!-- Banner Section -->
<?php get_template_part('template-parts/home/banner'); ?>
<!-- About Section -->
<?php get_template_part('template-parts/home/about'); ?>
<!-- Entrepreneurs Section -->
<?php get_template_part('template-parts/home/entrepreneurs'); ?>
<!-- Impact Section -->
<?php get_template_part('template-parts/home/impact'); ?>

<?php get_footer(); ?>