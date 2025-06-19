<?php 
/**
 * imgid    = image id
 * url      = image url
 * id       = attribute id
 * class    = attribute class
 * set      = src set. no for disbale src set. 
 * lazy     = lazy load. no for disbale lazy load. 
 */

function image_from_url($url){
    $feature_id = attachment_url_to_postid($url);
    return $feature_id;
}

function image_from_id($id){
    $post_image_url = wp_get_attachment_image_src($id,$size = 'full');
    $url 	= $post_image_url[0];
    return $url;
}


function get_image($data, $size='full'){

    $id     = array_key_exists('imgid',$data)?$data['imgid']:'';
    $url    = array_key_exists('url',$data)?$data['url']:"";
    
    if($url){
        $id = image_from_url($url);
    }

    if($id){
        $url = image_from_id($id);
    }

    if($url && $id){
      
        $img_id    = array_key_exists('id',$data)?$data['id']:"";
        $img_class = array_key_exists('class',$data)?$data['class']:"";
        $img_set   = array_key_exists('set',$data)?$data['set']:"";
        $img_lazy  = array_key_exists('lazy',$data)?$data['lazy']:"";
        $img_type  = array_key_exists('type',$data)?$data['type']:"";
        $img_size  = array_key_exists('size',$data)?$data['size']:"";
        $img_anim  = array_key_exists('anim',$data)?$data['anim']:"";
       

        $image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
        if(!$image_alt){
            $image_alt = get_the_title($id);
        } 
        
        if($img_set == 'no'){
            $image_srcset = '';
        } else {
            $image_srcset = wp_get_attachment_image_srcset( $id, 'full');
        }

        if($img_lazy != 'yes'){
            $lazy = '';
        } else {
            $lazy = 'loading="lazy"';
        }
        $image_attributes = wp_get_attachment_image_src($id, 'full');
        if($img_size=='no'){
            $h = '';
            $w = '';
        } else {
            $h = $image_attributes[2];
            $w = $image_attributes[1];
        }

        if($img_anim){
            $anim = $img_anim;
        } else {
            $anim = '';
        }

        $sizes_attr = '';
        if ($size == 'medium') {
            $sizes_attr = 'sizes="(min-width: 500px) 500px, 100vw"';
        } else if ($size == 'small') {
            $sizes_attr = 'sizes="(min-width: 300px) 300px, 100vw"';
        } else if ($size == 'large') {
            $sizes_attr = 'sizes="(min-width: 800px) 800px", 100vw';
        }
        
        //$result = '<img width="'.$w.'" height="'.$h.'" src="'.$url.'" alt="'.$image_alt.'" id="'.$img_id.'" class="'.$img_class.'" '.$lazy.' srcset="'.$image_srcset.'" '.$anim.'>';
        $result = '<img src="'.$url.'" alt="'.$image_alt.'" id="'.$img_id.'" class="'.$img_class.'" srcset="'.$image_srcset.'" '.$sizes_attr.'" '.$lazy.'" '.$anim.'>';
          
        return $result;
    }

}

function featured_image($id){
    if($id){
        $feat_image = wp_get_attachment_url( get_post_thumbnail_id($id));
        $data = $this->image($feat_image);
        if($data){
            return $data;
        }            
    }
}

?>