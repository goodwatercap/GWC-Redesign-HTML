<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
 get_header();
?>

<?php
if (is_single()) {
	add_shortcode('gw-post-content-cta', 'gw_post_content_cta_renderer');
	add_shortcode('gw-benchmark-report-cta', 'gw_benchmark_report_cta_renderer');
    add_shortcode('gw-full-image', 'gw_full_image_renderer');
    add_shortcode('gw-image', 'gw_image_renderer');
    add_shortcode('gw-left-side-text', 'gw_left_side_text');
    add_shortcode('gw-right-side-text', 'gw_right_side_text');
	
	function gw_benchmark_report_cta_renderer($atts)
	{	
        $atts = shortcode_atts(
			array(
				'icon_src' => '/wp-content/uploads/2022/09/benchmark-icon.png',
                'title' => 'Like the data you see here?',
                'subtitle' => 'Find out how your key metrics compare against your competitors. Request a benchmark report for your company.',
                'cta_href' => 'mailto:info@goodwatercap.com?subject=Benchmark report for my company',
                'cta_text' => 'Contact Us',				
            ), $atts);		
		return gw_post_content_cta_renderer($atts['icon_src'], $atts['title'], $atts['subtitle'], $atts['cta_href'], $atts['cta_text']);		
	}
	
	function gw_post_content_cta_renderer($icon_src, $title, $subtitle, $cta_href, $cta_text)
	{
		return '<div class="data-cta-container">
					<div class="data-cta-border"></div>
					<div class="data-cta-header">
						<img src="' . $icon_src . '" class="data-cta-icon" />   
						<span class="data-cta-title">' . $title . '</span>
					</div>
					<div class="data-cta-subtitle">' . $subtitle . '</div>
					<a href="' . $cta_href . '" class="button data-cta-button">' . $cta_text . '</a>
				</div>';
	}

    function gw_full_image_renderer($atts)
    {
        $atts = shortcode_atts(
            array(
                'src' => '',
                'title' => '',
                'caption' => ''
            ), $atts);

        return gw_fancybox_renderer($atts['src'], $atts['title'], $atts['caption']);
    }

    function gw_image_renderer($atts)
    {
        $atts = shortcode_atts(
            array(
                'src' => '',
                'title' => '',
                'caption' => '',
                'src2' => '',
                'title2' => '',
                'caption2' => '',
            ), $atts);

        if ($atts['src2'] == '') {
            return '<span class="one-image">
                       ' . gw_fancybox_renderer($atts['src'], $atts['title'], $atts['caption']) . '
                    </span>';
        }

        return '<span class="two-images">
                   ' . gw_fancybox_renderer($atts['src'], $atts['title'], $atts['caption'])
                     . gw_fancybox_renderer($atts['src2'], $atts['title2'], $atts['caption2']) . '
                </span>';
    }

    function gw_fancybox_renderer($src, $title, $caption, $isShareable = 'yes')
    {
        $socialShare = $isShareable === 'yes' ? 'social-share' : '';
        return '<a class="fancybox" href="' . $src . '">
                    <img class="' . $socialShare . '" src="' . $src . '" data-title="' . $title . '" data-caption="' . $caption . '"/>
                </a>';
    }

    function gw_left_side_text($atts)
    {
        $atts = shortcode_atts(
            array(
                'src' => '',
                'title' => '',
                'caption' => '',
                'sharing' => 'yes',
            ), $atts);
        return gw_side_text('side-text-left', $atts['src'], $atts['title'], $atts['caption'], $atts['sharing']);
    }

    function gw_right_side_text($atts)
    {
        $atts = shortcode_atts(
            array(
                'src' => '',
                'title' => '',
                'caption' => '',
                'sharing' => 'yes',
            ), $atts);
        return gw_side_text('side-text-right', $atts['src'], $atts['title'], $atts['caption'], $atts['sharing']);
    }

    function gw_side_text($direction, $src, $title, $caption, $isShareable)
    {
        return '<div class="side-text ' . $direction . '">
                    ' . gw_fancybox_renderer($src, $title, $caption, $isShareable) . '
                </div>';
    }
}
?>

<div class="thesis-page content-template-page <?php echo get_post_field('post_name', get_post()) ?>">
    <div class="site-content-contain">
        <?php
            $featured_image = get_field('featured_image');
            $featured_image_url = $featured_image ? $featured_image['url'] : NULL;
        ?>
		<?php
            $bg_image = $featured_image_url ?: get_the_post_thumbnail_url();
            $subnav_html = get_field('sub_navigation');
            $header_slider = get_field('header_slider');
            $is_gw_ipo = has_category('goodwater-ipo');
            $is_gw_press_preview = has_category('goodwater-press-preview');
        ?>
		<section
			class="first-screen post"
			<?php if ($bg_image) { ?>
					style="background-image: url(<?php echo $bg_image;?>);"
			<?php } ?>
		>
			<div class="container">
                <?php
                    $category = get_the_category()[0];
                    $parent = get_cat_name($category->category_parent);
                    $categoryName = $category->cat_name;
                    $is_gw_press_preview ? $categoryName .= ": Press Preview" : $categoryName;
                ?>
                <div class="category blue">
                    <span class="content"><?php echo $categoryName; ?></span>
                </div>
				<h1><?php echo get_the_title();?></h1>
				<div class="date"><?php echo get_the_date();?></div>
			</div>
            <div class="scroll-to-content" id="scroll-button">&nbsp;</div>
		</section>
        <?php if ($header_slider) { ?>
            <section class="slider">
                <? echo $header_slider; ?>
            </section>
        <?php } ?>
		<div class="content-wrapper">
				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>
                        <?php $empty_subnav = trim($subnav_html) === '' ?>
						<div class="container <?php if ($is_gw_ipo and !$empty_subnav) {echo 'gw-sidebar-container';} ?>">
							<?php get_template_part( 'template-parts/thesis/content', get_post_format() ); ?>
<!--                            --><?php
//                            // If comments are open or we have at least one comment, load up the comment template.
//                            if ( comments_open() || get_comments_number() ) :
//                                comments_template();
//                            endif;
//                            ?>
<!--                            --><?php //if ($is_gw_ipo and !$empty_subnav) { ?>
<!--                                <div class="gw-sidebar">-->
<!--                                    --><?php //if ($subnav_html) {echo $subnav_html;} ?>
<!--                                    <div class="share-buttons">-->
<!--                                        <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u=--><?php //echo get_permalink();?><!--" id="fb-share" target="_blank" title="Share on Facebook"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/facebook_square.svg' ?><!--" alt=""></a class="share-btn">-->
<!--                                        <a class="share-btn" href="http://www.twitter.com/share?url=--><?php //echo get_permalink();?><!--" id="tw-share" target="_blank" title="Share on Twitter"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/twitter_square.svg' ?><!--" alt=""></a>-->
<!--                                        <a class="share-btn" href="https://www.linkedin.com/cws/share?url=--><?php //echo get_permalink();?><!--" id="ln-share" target="_blank" title="Share on LinkedIn"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/linkedin_square.svg' ?><!--" alt=""></a>-->
<!--                                        --><?php //if (get_field('pdf_file')) { ?>
<!--                                            <a href="#collect-email" class="fancybox">-->
<!--                                                <div class="pdf-download">-->
<!--                                                    <img src="--><?php //gw_image_url('social/pdf_white.svg');?><!--" alt="">-->
<!--                                                    <div class="title">Download Report PDF</div>-->
<!--                                                </div>-->
<!--                                            </a>-->
<!--                                            <div class="collect-email" id="collect-email">-->
<!--                                                <input type="hidden" name="_target_url_" value="--><?php //the_field('pdf_file');?><!--">-->
<!--                                                <div class="black-logo">-->
<!--                                                    <img src="--><?php //gw_image_url('logo_black.png'); ?><!--" alt="">-->
<!--                                                </div>-->
<!--                                                <p class="call-to-action">Enter your email address to download the latest from Goodwater</p>-->
<!--                                                <div class="privacy">-->
<!--                                                    By submitting your email, you agree that you have read, understood and agree to be bound by our <a href="--><?php //echo get_permalink(get_page_by_path('legal')) . '#terms' ?><!--">Terms of Use</a> and <a href="--><?php //echo get_permalink(get_page_by_path('legal')) . '#privacy' ?><!--">Privacy Policy</a>.-->
<!--                                                </div>-->
<!--                                                --><?php //mc4wp_show_form(); ?>
<!--                                            </div>-->
<!--                                        --><?php //} ?>
<!--                                    </div>-->
<!--                                </div>-->
<!--                            --><?php //} ?>
						</div>
<!--                        --><?php //if (!$is_gw_ipo or $empty_subnav) { ?>
<!--                            <div class="sidebar-share-buttons">-->
<!--                                <div>share</div>-->
<!--                                <a href="https://www.facebook.com/sharer/sharer.php?u=--><?php //echo get_permalink();?><!--" id="fb-share" target="_blank" title="Share on Facebook"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/facebook.svg' ?><!--" alt=""></a>-->
<!--                                <a href="http://www.twitter.com/share?url=--><?php //echo get_permalink();?><!--" id="tw-share" target="_blank" title="Share on Twitter"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/twitter.svg' ?><!--" alt=""></a>-->
<!--                                <a href="https://www.linkedin.com/cws/share?url=--><?php //echo get_permalink();?><!--" id="ln-share" target="_blank" title="Share on LinkedIn"><img src="--><?php //echo get_template_directory_uri() . '/assets/images/social/linkedin.svg' ?><!--" alt=""></a>-->
<!--                                --><?php //if (get_field('pdf_file')) { ?>
<!--                                    <div>save</div>-->
<!--                                    <a href="#collect-email" class="fancybox collect-email"><img src="--><?php //gw_image_url('social/pdf.svg');?><!--" alt=""></a>-->
<!--                                    <div class="collect-email" id="collect-email">-->
<!--                                        <input type="hidden" name="_target_url_" value="--><?php //the_field('pdf_file');?><!--">-->
<!--                                        <div class="black-logo">-->
<!--                                            <img src="--><?php //gw_image_url('logo_black.png'); ?><!--" alt="">-->
<!--                                        </div>-->
<!--                                        <p class="call-to-action">Enter your email address to download the latest from Goodwater</p>-->
<!--                                        <div class="privacy">-->
<!--                                            By submitting your email, you agree that you have read, understood and agree to be bound by our <a href="--><?php //echo get_permalink(get_page_by_path('legal')) . '#terms' ?><!--">Terms of Use</a> and <a href="--><?php //echo get_permalink(get_page_by_path('legal')) . '#privacy' ?><!--">Privacy Policy</a>.-->
<!--                                        </div>-->
<!--                                        --><?php //mc4wp_show_form(); ?>
<!--                                    </div>-->
<!--                                --><?php //} ?>
<!--                            </div>-->
<!--                        --><?php //} ?>

					<?php endwhile; // End of the loop.
				?>
		</div>
<!--        <div class="about-thesis">-->
<!--            <div class="container">-->
<!--                <div class="about-goodwater">-->
<!--                    <div class="title">What is Goodwater Thesis?</div>-->
<!--                    <div class="content">-->
<!--                        We are creating products that will help all founders better understand the process of building a-->
<!--                        great consumer tech company. We hope to share tools and research that empower all entrepreneurs to-->
<!--                        build high quality consumer tech startups. Our reports are intended to be balanced on-->
<!--                        opportunities and risks.-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="see-also">-->
<!--                    <div class="title">See also:</div>-->
<!--                    --><?php
//                    $args = array('numberposts' => 2, 'category' => [12, -14, -15], 'post__not_in' => Array($post -> ID));
//                    $posts = get_posts($args);
//                    foreach($posts as $post) : setup_postdata($post);
//                        ?>
<!--                        <a class="thesis" href="--><?php //the_permalink(); ?><!--">-->
<!--                            <img class="logo" src="--><?php //echo get_field('logo', get_option('page_for_posts'))['url']; ?><!--" />-->
<!--                            <span class="content">--><?php //the_field('topic', get_option('page_for_posts')); ?><!-- Thesis</span>-->
<!--                        </a>-->
<!--                        --><?php
//                    endforeach; wp_reset_postdata();
//                    ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
	<?php get_footer();?>
</div>
