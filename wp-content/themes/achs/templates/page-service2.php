<?php
/**
 * Template Name: Behavioral Health 02
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'services_body_class' );
function services_body_class( $classes ) {
	
	$classes[] = 'page-services-02';
	return $classes;
	
}
/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_before_footer', 'ps_02_row_sections' , 1 );
function ps_02_row_sections() {


    $call_content                   = get_field('call_content','option');
    $call_button_text               = get_field('call_button_text','option');
    $call_button_link               = get_field('call_button_link','option');
    $call_images                    = get_field('images_section', 'option');
    $cant = count($call_images);
    $ic = rand(0, $cant-1);
?>
    <!--  Home Call Action-->
    <section class="call-action " id="home-call-action" style="background-image: url(<?php echo $call_images[$ic]['background_section']?>);">
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
        // col1
        $bottom_image                       = get_field('bottom_image','option');
        $bottom_title                       = get_field('bottom_title','option');
        $bottom_content                     = get_field('bottom_content','option');
        $bottom_button_text             = get_field('bottom_button_text','option');
        $bottom_button_link             = get_field('bottom_button_link','option');
        // col2
        $up_events_bottom_image                       = get_field('up_events_bottom_image','option');
        $up_events_bottom_title                       = get_field('up_events_bottom_title','option');
        $up_events_bottom_content                     = get_field('up_events_bottom_content','option');
        $up_events_bottom_button_text             = get_field('up_events_bottom_button_text','option');
        $up_events_bottom_button_link             = get_field('up_events_bottom_button_link','option');
        // col3
        $spotlight_bottom_image                       = get_field('spotlight_bottom_image','option');
        $spotlight_bottom_title                       = get_field('spotlight_bottom_title','option');
        $spotlight_bottom_content                     = get_field('spotlight_bottom_content','option');
        $spotlight_bottom_button_text             = get_field('spotlight_bottom_button_text','option');
        $spotlight_bottom_button_link             = get_field('spotlight_bottom_button_link','option');
   ?>
     <!--  Home Bootom Section-->
    <section class="section home-bottom section-space" id="home-bottom">
        <div class="wrap animatedParent">
            <div class="row animated fadeIn">
                    <div class="col s12 m4 l4">
                        <div class="service">
                            <div class="service-image" style="background-image: url('<?php echo $bottom_image; ?>')">
                                <div class="service-image-hover">
                                    <a href="<?php echo $bottom_button_link['url'];?>">
                                        <div class="service-white-transparent"></div>
                                    </a>
                                </div>
                            </div>
                            <h3><?php echo $bottom_title?></h3>
                            <?php echo $bottom_content;?>
                            <p><a href="<?php echo $bottom_button_link['url'];?>"><?php echo $bottom_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="service">
                            <div class="service-image" style="background-image: url('<?php echo $up_events_bottom_image; ?>')">
                                <div class="service-image-hover">
                                    <a href="<?php echo $up_events_bottom_button_link['url'];?>">
                                        <div class="service-white-transparent"></div>
                                    </a>
                                </div>
                            </div>
                            <h3><?php echo $up_events_bottom_title ?></h3>
                            <?php echo $up_events_bottom_content;?>
                            <p><a href="<?php echo $up_events_bottom_button_link['url'];?>"><?php echo $up_events_bottom_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="service">
                            <div class="service-image" style="background-image: url('<?php echo $spotlight_bottom_image; ?>')">
                                <div class="service-image-hover">
                                <a href="<?php echo $spotlight_bottom_button_link['url'];?>">
                                        <div class="service-white-transparent"></div>
                                    </a>
                                </div>
                            </div>
                            <h3><?php echo $spotlight_bottom_title?></h3>
                            <?php echo $spotlight_bottom_content;?>
                            <p><a href="<?php echo $spotlight_bottom_button_link['url'];?>"><?php echo $spotlight_bottom_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                    </div>
            </div>
        </div>
    </section>
     <!--/. End Home Bootom Section -->
    <?php
}

remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
add_action( 'genesis_sidebar', 'beatminded_do_default_sidebar' );


function beatminded_do_default_sidebar() {
    $sidebar_image_url = get_field('sidebar_image_url','option');
    $sidebar_title = get_field('sidebar_title','option');
    $sidebar_content = get_field('sidebar_content','option');
    $sidebar_link_text = get_field('sidebar_link_text','option');
    $sidebar_link_url = get_field('sidebar_link_url','option');
	?>
    <section id="nav_menu-5" class="widget widget_nav_menu">
        <div class="widget-wrap">
            <h4 class="widget-title widgettitle">Our Services</h4>
            <div class="menu-our-services-container">
            <?php 
            wp_nav_menu( array(
                'menu'           => 'Our Services'
            ) );
            ?>
            </div>
        </div>
    </section>
    <section id="text-5" class="widget widget_text">
        <div class="widget-wrap">			
            <div class="textwidget">
                <p>
                    <img class="alignnone size-full wp-image-178" src="<?php echo $sidebar_image_url;?>" alt="" width="356" height="283">
                </p>
                <h3><?php echo $sidebar_title?></h3>
                <p><?php echo $sidebar_content?><br>
                <a href="<?php echo $sidebar_link_ur;?>"><?php echo $sidebar_link_text?> <i class="fas fa-caret-right"></i></a></p>
            </div>
		</div>
    </section>
    <?php
}
genesis();