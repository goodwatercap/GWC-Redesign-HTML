<?php
/**
 * The company template file
 * Template Name: Company
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */

get_header();?>
    
<!-- Banner Section -->
<?php get_template_part('template-parts/inner-page/banner'); ?>
<!-- Two column Content Section -->
<?php get_template_part('template-parts/inner-page/two-column-content'); ?>
<!-- Company Stats Section -->
<?php get_template_part('template-parts/company/overview'); ?>
<!-- Story Section -->
<?php get_template_part('template-parts/company/story'); ?>
<!-- Photo Gallery Section -->
<?php get_template_part('template-parts/company/photos'); ?>
<!-- Learn more Section -->
<?php get_template_part('template-parts/inner-page/bottom-text'); ?>

<?php get_footer(); ?>