<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goodwater
 */

?>
<!doctype html>
<html class="no-js loading" dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="keywords" content="Goodwater Capital">
    <meta name="description" content="Goodwater Capital">
    <meta name="format-detection" content="telephone=no">

	<?php wp_head(); ?>

    <link href="<?php echo get_template_directory_uri(); ?>/css/thesis.css" rel="stylesheet" type="text/css" />
</head>
<?php 
	$body_custom_class = get_field('body_class');
	if( is_404() ):
		$body_custom_class = "error";
	endif;
?>
<body <?php body_class('no-js '.$body_custom_class); ?> dir="ltr">
<?php wp_body_open(); ?>
	<div id="page-wrap">
		<header class="gwc header">
	        <div class="container container--lg">
	          	<div class="header__wrap">
	            	<div class="header__brand">
	              		<div class="header__brand-inner">
	              			<a class="header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Logo">
	              				<?php 
	              					echo get_image(array('url'=>get_theme_mod('header_light_logo'),'class'=>'is--blue')); 
	              					echo get_image(array('url'=>get_theme_mod('header_blue_logo'),'class'=>'is--light'));
	              				?>
	              			</a>
	              		</div>
	            	</div>
	            	<div class="header__nav"> 
	            		<!-- Main Menu -->
		              	<?php get_template_part('template-parts/menu/main-menu');?>
		              	<div class="header__anchor">
		                	<div class="header__bottom is--mobile">
		                  		<div class="header__col">
		                    		<div class="header__contact"> 
		                    			<?php if( have_rows('mobile_address_rows', 'option') ):
		                    				if( get_field('mobile_contact_heading', 'option') ):?>
		                      					<h3><?php echo esc_html( get_field('mobile_contact_heading', 'option') );?></h3>
		                      				<?php endif;?>
				                  			<ul> 
				                  				<?php while( have_rows('mobile_address_rows', 'option') ) : the_row();?>
							                    	<li><p><?php echo esc_html( get_sub_field('mobile_address') );?></p></li>
							                    <?php endwhile;?>
							          		</ul>
							          	<?php endif;?>	
		                    		</div>  	
			                    	<?php if( get_field('email_id', 'option') ):?>
					                    <div class="header__mail"> 
					                    	<?php if( get_field('email_heading', 'option') ):?>
					                      		<h3><?php echo esc_html( get_field('email_heading', 'option') );?></h3>
					                      	<?php endif;?>
					                      	<ul> 
					                        	<li> <a href="mailto:<?php echo sanitize_email( get_field('email_id', 'option') );?>" title="mail"><?php echo esc_html( get_field('email_id', 'option') );?></a></li>
					                      	</ul>
					                    </div>
					                <?php endif;?>
		                  		</div>
		                  		<div class="header__col">
		                    		<div class="header__careers"> 
		                    			<?php if( get_field('careers_heading', 'option') ):?>
		                      				<h3><?php echo esc_html( get_field('careers_heading', 'option') );?></h3>
		                      			<?php endif;?>
		                      			<!-- Career Menu -->
		                      			<?php get_template_part('template-parts/menu/career');?>
		                    		</div>
				                    <!-- <div class="header__resources"> -->
				                    	<?php //if( get_field('resources_heading', 'option') ):?>
				                      		<!-- <h3><?php //echo esc_html( get_field('resources_heading', 'option') );?></h3> -->
				                      	<?php //endif;?>
				                      	<!-- Resources Menu -->
				                      	<?php //get_template_part('template-parts/menu/resources');?>
				                    <!-- </div> -->
		                  		</div>
		                  		<?php if( have_rows('social_media_items', 'option') ):?>
			                  		<div class="header__social"> 
					                    <ul> 
					                    	<?php while( have_rows('social_media_items', 'option') ) : the_row();
                                        	$link = get_sub_field('link');
                                        		if( $link ):?>
							                      	<li><a href="<?php echo esc_url( $link['url'] );?>" title="<?php echo $link['title'];?>" target="<?php echo $link['target'];?>"> <?php echo get_image(array('url'=>get_sub_field('icon'))); ?></a></li>
						                      	<?php endif;
                                    		endwhile;?>
					                    </ul>
			                  		</div>
			                  	<?php endif;?>
		                	</div>
	              		</div>
	            	</div>
	            	<button class="header__burger js-menu" aria-label="menu"><span>Navigation Menu</span><span>Navigation Menu</span><span>Navigation Menu</span></button>
	        	</div>
	    	</div>
		</header>