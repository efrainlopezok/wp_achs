<?php
/**
 * Template Name: Behavioral Health 01
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'services_body_class' );
function services_body_class( $classes ) {
	
	$classes[] = 'page-services-01';
	return $classes;
	
}
add_action('genesis_before_entry_content', 'tag_title_loop');
function tag_title_loop(){
    if(get_field('tag_title'))
        echo '<h4 class="tag-title">'.get_field('tag_title').'</h4>';
}
/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_before_footer', 'ps_01_row_sections' , 1 );
function ps_01_row_sections() {
    $service_files  = get_field('service_files');
    if($service_files):
    ?>
    <!--  Service Files  -->
    <section class="service-files section-space" id="service-files">
        <div class="row">
            <?php 
            foreach($service_files as $row) {
            ?>
            <div class="col l6 m6 s6">
                <a target="_blank" href="<?php echo $row['service_file']; ?>"><i class="fas fa-download"></i> <?php echo $row['service_text']; ?></a>
            </div>
            <?php } ?>
        </div>
    </section>
    <!--/. End Service Files -->
   <?php
    endif;
        $section_title              = get_field('bh_services_section_title');
        $services                   = get_field('services','option');
   ?>
    <!--  Home Services -->
   <section class="section services section-space" id="home-services">
       <div class="wrap">
            <div class="row">
                <h2><?php echo $section_title; ?></h2>
                <?php
                    if($services):
                        foreach($services as $row) {
                            ?>
                                <div class="col m3 s12">
                                    <div class="service animatedParent">
                                        <a href="<?php echo $row['link_service'];?>">
                                            <div class="service-image animated fadeIn" style="background-image: url('<?php echo $row['service_image']; ?>')">
                                                <div class="service-image-hover">
                                                    <div class="service-white-transparent">
                                                    <img src="<?php echo $row['icon_service'];?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <h3><?php echo $row['service_title']?></h3>
                                    
                                    </div>
                                </div>
                            <?php
                        }
                    endif;
                ?>
            </div>
       </div>
   </section>
    <!--/. End Home Services -->
    <?php
    $call_content                   = get_field('service_ca_call_content');
    $call_button_text               = get_field('service_ca_call_button_text');
    $call_button_link               = get_field('service_ca_call_button_link');
    ?>
    <!--  Service Call Action-->
    <section class="call-action" id="home-call-action ">
        <div class="wrap">
                <div class="row animatedParent">
                        <div class="col call-content animated fadeIn delay-500">
                            <?php echo $call_content; ?>
                            <p style="text-align:center;"><a class="btn btn-transparent-orange" href="<?php echo  $call_button_link;?>"><?php echo  $call_button_text;?> <i class="fas fa-caret-right"></i></a></p>
                        </div>
                </div>
        </div>
    </section>
    <!--/. End Service Call Action -->
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
 <!--  Service Bootom Section-->
<section class="section home-bottom section-space" id="home-bottom">
    <div class="wrap animatedParent">
        <div class="row animated fadeInUp">
                <div class="col s12 m4 l4">
                    <div class="service ">
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
 <!--/. End Service Bootom Section -->
 <?php
}


genesis();