<?php if( array_key_exists('class', $args )){
    $class_name = $args['class'];
    $button_on_left = array_key_exists('button_on_left',$args)?$args['button_on_left']:"";
}?>
<div class="gwc consumer <?php echo $class_name;?>"> 
    <div class="container"> 
        <div class="consumer__wrap"> 
            <?php if( get_field('left_content') || ($button_on_left && get_field('cta')) ):?>
                <div class="consumer__col">
                    <?php echo apply_filters('the_content',get_field('left_content'));
                    $link = $button_on_left ? get_field('cta') : '';
                    if( $link ):?>
                    <a class="l-btn l-btn--dark mt-33 medium-down-hide" href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>"><?php echo $link['title'];?><i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                            </svg></i></a>
                    <?php endif;?>
                </div>
            <?php endif;
            if( get_field('right_content') || get_field('cta')):?>
                <div class="consumer__col">
                    <?php echo apply_filters('the_content',get_field('right_content'));
                    $link = get_field('cta');
                    if( $link ):?>
                        <a class="l-btn l-btn--dark mt-33 <?php echo $button_on_left ? "medium-up-hide": ""?>" href="<?php echo $link['url'];?>" target="<?php echo $link['target'];?>" title="<?php echo $link['title'];?>"><?php echo $link['title'];?><i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                      </svg></i></a>
                    <?php endif;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>