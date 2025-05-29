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
                <div class="meet__cards">
                    <?php while( have_rows('entrepreneurs_companies') ) : the_row();
                        $featured_company = get_sub_field('entrepreneurs_featured_company');
                        if( $featured_company ):
                            $bg_color   = get_sub_field('bg_color');
                            $label      = get_sub_field('label');
                            $year       = get_sub_field('year');
                            $title      = get_sub_field('title');
                            $image      = get_field('oval_image', $featured_company->ID);
                            $boxImage   = get_field('box_image', $featured_company->ID);
                            $content    = $featured_company->post_content;
                            $tag        = get_field('tag_name', $featured_company->ID);
                            $location   = get_field('location', $featured_company->ID);
                            $link       = get_field('link', $featured_company->ID);?>
                            <div class="meet__tab">
                                <div class="meet__card <?php echo $bg_color;?>">
                                    <div class="meet__headings">
                                        <h2><?php echo esc_html($title);?></h2>
                                        <?php if($year):?>
                                            <h4><div class="meet__invested_in">invested in</div><div><?php echo esc_html($year);?></div></h4>
                                        <?php endif;?>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <div>
                                            <?php if($tag):?>
                                                <span class="l-tag"><?php echo esc_html($tag);?></span>
                                            <?php endif;?>
                                            <?php if($location):?>
                                                <span class="l-tag"><?php echo esc_html($location);?></span>
                                            <?php endif;?>
                                            <div class="meet__content">
                                                <?php echo apply_filters('the_content', $content);?>
                                                <?php if($link):?>
                                                    <a href="<?php echo $link['url'];?>" target="<?php echo $link['target'];?>" title="<?php echo $title .' '. $link['title'];?>" target="_blank"><?php echo $link['title'];?></a>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <?php if($image):?>
                                            <div class="meet__thumb"><?php echo get_image(array('url'=>$image));?></div>
                                        <?php elseif($boxImage):?>
                                            <div class="meet__thumb__box"><?php echo get_image(array('url'=>$boxImage));?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="meet__nav"> 
                                        <div class="meet__slider-arrow">
                                            <button class="meet__arrow meet__arrow--prev" role="button" aria-label="Previous">
                                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.41142 1.32353L13.2122 7.12435M13.2122 7.12435L7.24474 12.7536M13.2122 7.12435L0.787908 6.94284" stroke="white" stroke-width="1.25"></path>
                                                </svg>
                                            </button>
                                            <button class="meet__arrow meet__arrow--next" role="button" aria-label="Next">
                                                <svg width="15" height="14" viewbox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.41142 1.32353L13.2122 7.12435M13.2122 7.12435L7.24474 12.7536M13.2122 7.12435L0.787908 6.94284" stroke="white" stroke-width="1.25"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;
                    endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>