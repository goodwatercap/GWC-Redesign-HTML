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
                            <h3><?php echo get_sub_field('name') ?>, <?php echo get_sub_field('title')?> </h3>
                            <?php echo get_sub_field('content');?>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>

        </div>
    </div>
</div>