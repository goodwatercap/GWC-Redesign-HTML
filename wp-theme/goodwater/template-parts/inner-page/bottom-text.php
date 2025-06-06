<div class="gwc opportunities opportunities--about">
    <div class="container">
        <?php if( get_field('bottom_heading') ):?>
            <h2><?php echo apply_filters('the_content',get_field('bottom_heading'));?></h2>
        <?php endif;
        if( get_field('bottom_text') ):?>
            <h3><?php echo apply_filters('the_content',get_field('bottom_text'));?></h3>
        <?php endif;
        $link = get_field('bottom_link');
        if($link):?>
            <div class="opportunities__btn"><a class="l-btn l-btn--dark" href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>" target="<?php echo $link['target'];?>"><?php echo $link['title'];?><i>
                <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                </svg>
            </i></a></div>
        <?php endif;?>
    </div>
</div>