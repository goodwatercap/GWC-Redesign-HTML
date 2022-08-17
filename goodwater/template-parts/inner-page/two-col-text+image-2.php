<?php if( $args['class'] ){
    $class_name = $args['class'];
    $button_on_left = $args['button_on_left'];
}?>
<div class="gwc manifesto <?php echo $class_name;?>">
    <div class="container container--full">
        <?php if( get_field('tcti2-label') ):?>
            <div class="span l-caption"><?php echo esc_html(get_field('tcti2-label'));?></div>
        <?php endif;?>
        <div class="manifesto__wrap">
            <div class="manifesto__content"> 
                <?php if( get_field('tcti2-heading') ):?>
                    <h3><?php echo get_field('tcti2-heading');?></h3>
                <?php endif;
                if( get_field('tcti2-content') ):
                    echo apply_filters('the_content',get_field('tcti2-content'));
                endif;?>
            </div>
            <div class="manifesto__thumb">
                <?php if( get_field('tcti2-desktop_image') ):
                    echo get_image(array('url'=>get_field('tcti2-desktop_image'),'class'=>'is--desktop'));
                endif;
                if( get_field('tcti2-mobile_image') ):
                    echo get_image(array('url'=>get_field('tcti2-mobile_image'),'class'=>'is--mobile'));
                endif;?>   
            </div>
        </div>
    </div>
</div>