<div class="gwc approach approach--about">
    <?php if( have_rows('card_slider') ): $count=0; $counter=0;?>
        <div class="approach__wrap">
            <div class="approach__slider"> 
                <?php while( have_rows('card_slider') ) : the_row(); $count++; $counter++;
                    if($count<10):
                        $count = "0".$count;
                    else:
                        $count;
                    endif;

                    if($counter==1):
                        $bg_class = "bg--gold";
                    elseif($counter==2):
                        $bg_class = "bg--lawn";
                    elseif($counter==3):
                        $bg_class = "bg--lake";
                    elseif($counter==4):
                        $bg_class = "bg--sky";
                    elseif($counter==5):
                        $bg_class = "bg--violet";
                        $counter=0;
                    endif;
                    ?>
                    <div class="approach__slide"> 
                        <div class="approach__tab <?php echo $bg_class;?>"> 
                            <span><?php echo $count;?></span>
                            <?php if( get_sub_field('card_slider_heading') ):?>
                                <h2><?php echo esc_html(get_sub_field('card_slider_heading'));?></h2>
                            <?php endif;
                            if( get_sub_field('card_slider_content') ):?>
                                <h3><?php echo esc_html(get_sub_field('card_slider_content'));?></h3>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
            <div class="approach__nav"> 
                <div class="approach__slider-arrow">
                    <button class="approach__arrow approach__arrow--prev" role="button" aria-label="Previous">
                        <svg width="15" height="14" viewbox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.41142 1.32353L13.2122 7.12435M13.2122 7.12435L7.24474 12.7536M13.2122 7.12435L0.787908 6.94284" stroke="white" stroke-width="1.25"></path>
                        </svg>
                    </button>
                    <button class="approach__arrow approach__arrow--next" role="button" aria-label="Next">
                        <svg width="15" height="14" viewbox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.41142 1.32353L13.2122 7.12435M13.2122 7.12435L7.24474 12.7536M13.2122 7.12435L0.787908 6.94284" stroke="white" stroke-width="1.25"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>