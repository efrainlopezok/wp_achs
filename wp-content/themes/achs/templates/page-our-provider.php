<?php
/**
 * Template Name: Our Provider Template
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
    $op_locations = get_field('op_locations');
    if($op_locations)   {
        echo '<ul class="collapsible" data-collapsible="accordion">';
        foreach($op_locations as $row)  {
            echo '<li>';
                ?>
                <div class="collapsible-header"><?php echo $row['op_title']?> <i class="fas fa-plus"></i> <i class="fas fa-minus"></i></div>
                <?php if($row['op_content_options'] == 'op_images'): 
                        $images = $row['ct_images'];
                        $size = 'full';
                        if( $images ): ?>
                        <div class="collapsible-body body-images">
                            <div class="row">
                                <?php foreach( $images as $image ): ?>
                                    <div class="col m3 s6">
                                        <?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                       </div>
                        <?php endif;  
                    else:
                        ?>
                    <div class="collapsible-body">
                        <?php echo $row['ct_content']; ?>
                    </div>
                        <?php
                    endif;
            echo '</li>';
        }

        echo '</ul>';
    }
}

add_action( 'genesis_before_footer', 'provider_row_sections' , 1 );
function provider_row_sections() {

    $call_content                   = get_field('call_content','option');
    $call_button_text               = get_field('call_button_text','option');
    $call_button_link               = get_field('call_button_link','option');
?>
     <!--  Home Call Action-->
     <section class="call-action" id="home-call-action">
         <div class="wrap">
                <div class="row animatedParent">
                        <div class="col m5 s12 call-content animated fadeInLeft">
                            <?php echo $call_content; ?>
                            <p><a class="btn btn-transparent-orange" href="<?php echo  $call_button_link;?>"><?php echo  $call_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                        <div class="col s7 floating-image">
                                <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/people.png" />
                        </div>
                </div>
         </div>
    </section>
     <!--/. End Home Call Action -->
     <?php
}

genesis();