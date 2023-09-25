<?php
/**
 * Template Name: Event Template
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'blog_body_class' );
function blog_body_class( $classes ) {
	
	$classes[] = 'page-blog page-event';
	return $classes;
	
}
/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_before_footer', 'blog_row_sections' , 1 );
function blog_row_sections() {
    ?>
    <section class="blog-section" id="event">
        <div class="wrap">
            <?php echo do_shortcode('[event]'); ?>
        </div>
    </section> 
    <?php
    // $call_content                   = get_field('blog_ca_service_cta_call_content');
    // $call_button_text               = get_field('blog_ca_service_cta_call_button_text');
    // $call_button_link               = get_field('blog_ca_service_cta_call_button_link');
    ?>
    <!--  Blog Call Action-->
    <!-- <section class="call-action" id="home-call-action">
        <div class="wrap">
                <div class="row">
                        <div class="col call-content">
                        
                            <p style="text-align:center;"><a class="btn btn-transparent-orange" href="<w?php echo  $call_button_link;?>"><w?php echo  $call_button_text;?> <i class="fas fa-caret-right"></i></a></p> 
                        </div>
                </div>
        </div>
    </section> -->
    <!--/. End Blog Call Action -->
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


 