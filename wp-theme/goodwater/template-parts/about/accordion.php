<?php if( have_rows('accordions') ): $count=0;?>
    <div class="gwc accordion accordion--about">
        <div class="container">
            <?php if( get_field('acclabel') ):?>
                <h2 class="l-caption"><?php echo esc_html(get_field('acclabel'));?></h2>
            <?php endif;?>
            <div class="accordion__wrap">
                <?php while( have_rows('accordions') ) : the_row(); $count++; ?>
                    <div class="l-accordion">
                        <div class="accordion__title"> <span><?php echo $count;?></span>
                            <?php if( get_sub_field('acc_title') ):?>
                                <h3><?php echo esc_html(get_sub_field('acc_title'));?></h3>
                            <?php endif;?>
                        </div>
                        <div class="l-accordion__content">
                            <div class="l-accordion__block">
                                <?php if( get_sub_field('acc_content') ):?>
                                    <p><?php echo esc_html(get_sub_field('acc_content'));?></p>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
<?php endif;?>