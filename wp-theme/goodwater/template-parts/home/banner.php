<div class="gwc banner banner--full-width">
    <div class="banner__inner">
        <div class="banner__wrap">
<!--            <video class="banner__video" autoplay="autoplay" loop muted playsinline> -->
<!--                --><?php //$video_mp4 = get_field('video_mp4');
//                $video_webm      = get_field('video_webm');
//                if( $video_mp4 ): ?>
<!--                    <source src="--><?php //echo $video_mp4['url'];?><!--" type="video/mp4">-->
<!--                --><?php //endif;
//                if( $video_webm ):?>
<!--                    <source src="--><?php //echo $video_webm['url'];?><!--" type="video/webm">-->
<!--                --><?php //endif;?>
<!--            </video>-->
            <div class="container">
                <div class="banner__message">
                    <div class="banner__details">
                        <?php if( get_field('banner_sub_heading') ): ?>
                            <div class="banner__consumer">
                                <?php echo apply_filters('the_content',get_field('banner_sub_heading')); ?>
                            </div>
                        <?php endif;
                        if( get_field('banner_heading') ):?>
                            <?php echo apply_filters('the_content',get_field('banner_heading')); ?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>