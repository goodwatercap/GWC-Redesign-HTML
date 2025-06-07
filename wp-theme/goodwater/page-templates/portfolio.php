<?php
/**
 * The homepage template file
 * Template Name: Portfolio
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */

get_header();?>
    
<!-- Banner Section -->
<?php get_template_part('template-parts/inner-page/banner'); ?>
<!-- Two column Content Section -->
<?php get_template_part('template-parts/inner-page/two-column-content',null,array('class'=>'consumer--portfolio')); ?>
<!-- Company Section -->
<?php get_template_part('template-parts/portfolio/company'); ?>
<!-- Filter Section -->
<?php get_template_part('template-parts/portfolio/filter'); ?>
<!-- Career Section -->
<?php get_template_part('template-parts/portfolio/career'); ?>

<?php get_footer(null, array('footnote'=>'<div class="footer__footnote">* Goodwater GPs invested in company before Goodwater</div>')); ?>