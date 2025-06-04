<div class="gwc banner banner--inner team">
    <div class="banner__wrap">
        <div class="container">
            <span class="l-banner"><?php echo esc_html(get_field('label'));?></span>
            <div class="container people_container">
                <?php while( have_rows('member') ) : the_row(); ?>
                    <div class="person">
                        <div class="img__thumb">
                            <?php echo get_image(array('url'=>get_sub_field('headshot'))); ?>
                        </div>
                        <div class="content">
                            <h3>
                                <?php echo get_sub_field('name') ?>, <?php echo get_sub_field('title')?>
                                <a href="<?php echo get_sub_field('linkedin'); ?>" title="linkedin" target="_blank">
                                    <img src="<?php echo get_template_directory_uri() . '/images/linkedin.svg' ?>"
                                         alt="linkedin" id="" class="" srcset="">
                                </a>
                            </h3>
                            <?php echo get_sub_field('content');?>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>

        </div>
    </div>
</div>