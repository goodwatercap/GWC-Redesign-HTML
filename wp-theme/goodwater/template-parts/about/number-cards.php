<?php if( have_rows('ncards') ):?>
    <div class="gwc grid grid--about">
        <div class="container">
            <?php if( get_field('nlabel') ):?>
                <h2 class="l-caption"><?php echo esc_html(get_field('nlabel'));?></h2>
            <?php endif;?>
            <div class="grid__boxes"> 
                <?php while( have_rows('ncards') ) : the_row();?>
                    <div class="grid__card">
                        <div class="gwc card">
                            <?php if( get_sub_field('value') ):?>
                                <h2><?php echo esc_html(get_sub_field('value'));?></h2>
                            <?php endif;
                            if( get_sub_field('label') ):?>
                                <h4><?php echo esc_html(get_sub_field('label'));?></h4>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </div>
<?php endif;?>