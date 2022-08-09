<?php 
// Portfolio load more
function portfolio_filter_ajax(){
    if(isset($_POST['type'])){
        $type     = $_POST['type'];
        $taxonomy = $_POST['taxonomy'];
        $val      = $_POST['val'];
        $limit    = $_POST['limit'];
        header("Content-Type: text/html");
        if( $type == 'filter' ){
            $type_attr = 'filter';
            $args = array(
                'post_type'         => 'companies',
                'post_status'       => 'publish',
                'posts_per_page'    => $limit,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'term_id',
                        'terms'    => $val,
             
                    ),
                ),
            );
        }else if( $type == 'search' ){
            $type_attr = 'search';
            $args = array(
                'post_type'         => 'companies',
                'post_status'       => 'publish',
                'posts_per_page'    => $limit,
                's' => $val
            );
        }
        
        $companies  = new WP_Query($args);
        $max_pages  = $companies->max_num_pages;
        $total_post = $companies->found_posts;
        $out = '';
        if ($companies -> have_posts()) : //$count = 0;
            $out .= '<div class="filter__boxes">';
                while ($companies -> have_posts()) : $companies -> the_post(); //$count++;
                    // if($count==1){
                    //     $hover_class = "filter--lake";
                    // }elseif($count==2){
                    //     $hover_class = "filter--lawn";
                    // }elseif($count==3){
                    //     $hover_class = "filter--violet";
                    //     $count = 0;
                    // }
                    $title    = get_the_title();
                    $tags     = get_the_terms( get_the_ID(), 'company_category' ); 
                    if ( ! empty( $tags ) ) {
                        $tag = $tags[0]->name;   
                    }
                    // $locs     = get_the_terms( get_the_ID(), 'location' ); 
                    // if ( ! empty( $locs ) ) {
                    //     $loc = $locs[0]->name;   
                    // }
                    $link                       = get_field('link');
                    $location_country_state     = get_field('locationcountrystate');
                    $out .= '<div class="filter__box">
                            <a href="'.$link['url'].'" title="'.esc_html($title).'" target="_blank">
                                <div class="gwc filter filter--box">
                                    <span class="l-tag">'.esc_html($tag).'</span>
                                    <span class="l-tag">'.esc_html($location_country_state).'</span>
                                    <div class="filter__head">
                                        <h2>'.esc_html($title).'</h2>'.get_image(array('imgid'=> 216)).'
                                    </div>
                                    '.apply_filters('the_content', get_the_content()).'
                                </div>
                            </a>
                        </div>';
                endwhile;
            $out .= '</div>';
            if( $total_post >= $limit ):
                $out .= '<div class="filter__load-more" data-page="1" data-max-pages="'.$max_pages.'" data-type="'.$type_attr.'"> <a class="l-btn" href="#" title="Load more">Load More</a></div>';
            endif; 
        endif;
        wp_reset_postdata();
        die($out);
    }else{
        echo -1;
    }
}
add_action('wp_ajax_nopriv_portfolio_filter_ajax', 'portfolio_filter_ajax');
add_action('wp_ajax_portfolio_filter_ajax', 'portfolio_filter_ajax');
?>