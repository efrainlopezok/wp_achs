<?php
/**
 * Template Name: Locations
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'locations_body_class' );
function locations_body_class( $classes ) {
	
	$classes[] = 'locations';
	return $classes;
	
}
/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_before_footer', 'locations_row_sections' , 1 );
function locations_row_sections() {

    $call_content                   = get_field('location_content');
    $call_button_text               = get_field('location_link_text');
    $call_button_link               = get_field('location_link');
    $call_bkg                       = get_field('location_background_image');
    if($terms = get_field('all_providers')):
        echo '<section class="providers" style="margin-bottom: 50px;"><div class="wrap">';
        echo do_shortcode('[providers]');
        echo '</div></section>';
    endif;
    ?>
    
    <!--  Service Call Action-->
    <!-- <section class="call-action" id="home-call-action " style="background-image: url(<w?php echo  $call_bkg;?>);">
        <div class="wrap">
                <div class="row animatedParent">
                        <div class="col call-content animated fadeIn delay-500">
                            <w?php echo $call_content; ?>
                            <p style="text-align:center;"><a class="btn btn-transparent-orange" href="<w?php echo  $call_button_link;?>"><w?php echo  $call_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                </div>
        </div>
    </section> -->
    <?php
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
                        <div class="col m7 floating-image">
                            <img src="<?php echo $call_images[$ic]['image_section']?>" />
                        </div>
                </div>
         </div>
    </section>
     <!--/. End Home Call Action -->
    <?php
}



genesis();