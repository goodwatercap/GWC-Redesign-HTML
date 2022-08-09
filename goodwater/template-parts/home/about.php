<div class="gwc healthcare"> 
    <div class="container container--full">
        <div class="healthcare__box">
            <div class="healthcare__consumer">
                <?php if( get_field('about_mobile_label') ):?>
                    <h2 class="is--mobile"><span> <?php echo esc_html(get_field('about_mobile_label'));?> </span></h2>
                <?php endif;
                if( get_field('about_heading')):?>
                    <?php echo apply_filters('the_content',get_field('about_heading')); ?>
                <?php endif;
                if( get_field('about_sub_heading') ):?>
                    <h3><?php echo esc_html(get_field('about_sub_heading'));?> </h3>
                <?php endif;?>
            </div>
            <div class="healthcare__content">
                <?php if( get_field('about_content') ):
                    echo apply_filters('the_content',get_field('about_content'));
                endif;
                $link = get_field('about_link');
                if( $link ):?>
                    <a class="l-btn l-btn--dark" href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>"><?php echo $link['title'];?><i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                  </svg></i></a>
                <?php endif;?>
            </div>
            <?php $thumb_img = get_field('about_image');
            if( $thumb_img ):?>
                <div class="healthcare__thumb"> 
                    <?php echo get_image(array('url'=>$thumb_img, 'set'=>'no')); ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>