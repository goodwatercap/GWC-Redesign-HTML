<div class="gwc meet">
    <div class="container container--full">
        <div class="meet__slider"> 
            <div class="meet__head"> 
                <?php if( get_field('entrepreneurs_heading') ):?>
                    <?php echo apply_filters('the_content',get_field('entrepreneurs_heading')); ?>
                <?php endif;?>
                <?php $link = get_field('entrepreneurs_section_link');
                if($link):?>
                    <a class="l-btn l-btn--dark" href="<?php echo $link['url'];?>" target="<?php echo $link['target'];?>" title="<?php echo $link['title'];?>"><?php echo $link['title'];?><i> <svg width="11" height="11" viewbox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.21047 1.17139H9.41407M9.41407 1.17139L9.17486 9.3715M9.41407 1.17139L0.500392 9.82837" stroke="white" stroke-width="1.25"></path>
                  </svg></i></a>
                <?php endif;?>
            </div>
            <?php if( have_rows('entrepreneurs_companies') ):?>
                <div class="gwc delivery">
                    <div class="delivery__slider">
                        <?php while( have_rows('entrepreneurs_companies') ) : the_row();
                            $featured_company = get_sub_field('entrepreneurs_featured_company');
                            if( $featured_company ):
                                $bg_color   = get_sub_field('bg_color');
                                $logo       = get_sub_field('logo', $featured_company->ID);
                                $delivery_class = get_sub_field('delivery_class');
                                $image      = get_field('box_image', $featured_company->ID);
                                $content    = $featured_company->post_content;
                                $tag        = get_field('tag_name', $featured_company->ID);
                                $location   = get_field('location', $featured_company->ID);
                                $link       = get_field('link', $featured_company->ID);?>
                                <div class="delivery__slide">
                                    <div class="delivery__tab <?php echo esc_attr($bg_color); ?>">
                                        <div class="container">
                                            <div class="delivery__row">
                                                <div class="delivery__content">
                                                    <?php if($logo):?>
                                                        <div class="delivery__logo <?php echo esc_html($delivery_class);?>"><?php echo get_image(array('url'=>$logo)); ?></div>
                                                    <?php endif;
                                                    if($tag):?>
                                                        <span class="l-tag"><?php echo esc_html($tag);?></span>
                                                    <?php endif;?>
                                                    <?php if($location):?>
                                                        <span class="l-tag"><?php echo esc_html($location);?></span>
                                                    <?php endif;?>
                                                    <?php echo apply_filters('the_content', $content);?>
                                                    <?php if($link):?>
                                                        <a href="<?php echo $link['url'];?>" title="<?php echo $link['title'];?>" target='_blank'><?php echo $link['title'];?><i> <svg width="23" height="21" viewbox="0 0 23 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6881 1.00809L21.0488 10.5907M21.0488 10.5907L11.4191 19.8899M21.0488 10.5907L0.999819 10.2909" stroke="white" stroke-width="1.5"></path></svg></i></a>
                                                    <?php endif;?>
                                                </div>
                                                <?php if($image):?>
                                                    <div class="delivery__thumb"><?php echo get_image(array('url'=> $image)); ?></div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;
                        endwhile;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>