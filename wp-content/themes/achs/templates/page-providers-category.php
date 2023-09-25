<?php
/**
 * Template Name: Providers Category Template
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */

 //* Remove .site-inner
add_filter( 'body_class', 'our_provider_body_class' );
function our_provider_body_class( $classes ) {
	
	$classes[] = 'page-our-provider';
	return $classes;
	
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child2_do_custom_loop' );
 
function child2_do_custom_loop() {
    // $terms = get_terms( array(
    //     'taxonomy' => 'provider-category',
    //     'hide_empty' => true,
    //     'orderby' => 'menu_order',
    //     'order' => 'ASC',
    // ) );
    // print_r(get_field('all_providers'));
    $location = strtoupper($_GET['location']);
    $terms = get_field('all_providers');
    // print_r($terms);
    echo '<ul class="collapsible cpt-provider" data-collapsible="accordion">';
        foreach($terms as $category){
            $active = "";
            echo '<li>'; 
                if($location == $category['prov_title']) $active = "active";
                echo '<div class="collapsible-header '.$active.'">'.$category['prov_title'].' <i class="fas fa-plus"></i> <i class="fas fa-minus"></i></div>';
                echo '<div class="collapsible-body body-images">';
                    echo '<div class="row">';
                        // $args = array(
                        //     'post_type' => 'provider',
                        //     // 'orderby' => 'title',
                        //     // 'order' => 'ASC',
                        //     'posts_per_page' => -1,
                        //     // 'meta_key'			=> 'provider_title',
                        //     'orderby'			=> 'menu_order',
                        //     'order'				=> 'ASC',
                        //     'tax_query' => array(
                        //         array(
                        //         'taxonomy' => 'provider-category',
                        //         'field' => 'term_id',
                        //         'terms' => $category->term_id,
                        //         )
                        //     )
                        // );
                        // $query = new WP_Query( $args );
                        if ( $category['prov_provider'] ) {
                        //     while ( $query->have_posts() ) {
                        //         $query->the_post(); 
                        foreach($category['prov_provider'] as $provider){
                            // setup_postdata($provider);
                                echo '<div class="col m3 s6">';
                                    if ( has_post_thumbnail($provider->ID) ) {
                                        $thumb_id = get_post_thumbnail_id($provider->ID);
                                        $thumb_url = wp_get_attachment_image_src($thumb_id,'provider-thumbnail', true);
                                        echo '<img src="'.$thumb_url[0].'" />';
                                    } else {
                                        echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/default.png" />';
                                    }
                                    echo '<a href="'.get_the_permalink($provider->ID).'">';
                                        echo '<div class="hover-details">';
                                            echo '<i class="fas fa-search"></i>';
                                            echo '<strong>'.get_the_title($provider->ID).'</strong>';
                                            if(get_field('provider_title', $provider->ID))
                                                echo '<span>'.get_field('provider_title', $provider->ID).'</span>';
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';    
                            } 
                            // wp_reset_postdata();
                        }
                    echo '</div>';
                echo '</div>';
            echo '</li>';
        wp_reset_postdata();
    }
    echo '</ul>';
}

add_action( 'genesis_before_footer', 'provider_row_sections' , 1 );
function provider_row_sections() {

    $call_content                   = get_field('call_content','option');
    $call_button_text               = get_field('call_button_text','option');
    $call_button_link               = get_field('call_button_link','option');
    $call_images                    = get_field('images_section', 'option');
    $cant = count($call_images);
    $ic = rand(0, $cant-1);
?>
     <!--  Home Call Action-->
     <section class="call-action" id="home-call-action" style="background-image: url(<?php echo $call_images[$ic]['background_section']?>);">
         <div class="wrap">
                <div class="row animatedParent">
                        <div class="col m5 s12 call-content animated fadeInLeft">
                            <?php echo $call_content; ?>
                            <p><a class="btn btn-transparent-orange" href="<?php echo  $call_button_link;?>"><?php echo  $call_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                        <div class="col s7 floating-image">
                            <img src="<?php echo $call_images[$ic]['image_section']?>" />
                        </div>
                </div>
         </div>
    </section>
     <!--/. End Home Call Action -->
     <?php
}

genesis();