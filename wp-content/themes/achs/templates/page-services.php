<?php
/**
 * Template Name: Services Page
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner

/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_after_header', 'home_row_sections' , 2 );
function home_row_sections() {
        $section_small_title        = get_field('section_small_title','option');
        $section_title              = get_field('section_title','option');
        $services                   = get_field('services','option');
   ?>
    <!--  Home Services -->
   <section class="section services section-space top-image" id="home-services">
       <div class="wrap">
            <div class="row">
                <h4><?php echo $section_small_title; ?></h4>
                <h2><?php echo $section_title; ?></h2>
                <?php
                    if($services):
                        foreach($services as $row) {
                            ?>
                                <div class="col m4 l4 xl3 s12">
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
                                        <a href="<?php echo $row['link_service'];?>"><h3><?php echo $row['service_title']?></h3></a>
                                        <?php echo $row['service_content']?>
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
}


genesis();