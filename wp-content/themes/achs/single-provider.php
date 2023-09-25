<?php
/**
 * Template Name: Single Provider
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'provider_body_class' );
function provider_body_class( $classes ) {
	
	$classes[] = 'page-provider page-contact';
	return $classes;
	
}

/* # Hero Images on Page
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_after_header', 'single_deals_display_featured_image', 1 );
function single_deals_display_featured_image() {
	echo '<div class="hero">';
		echo '<div class="wrap animatedParent">';
            echo '<div class="hero-content animated fadeIn">';
                echo '<h2 style="text-align: center;">ACHS Providers</h2>';
                echo '<a class="back-to-list" href="/provider-list/" style="text-align: center;">View All Providers</a>';
            echo '</div>';
            echo '</div>';	
		echo '</div>';	
    echo '</div>';		
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );
 
function child_do_custom_loop() {
    $args = array('post_type' => 'provider','posts_per_page'=>1, 'p'=>get_the_ID(),);
    $loop = new WP_Query($args);
    if ( $loop->have_posts() ) : 
        echo '<div class="single-provider">';
        while ( $loop->have_posts() ) : $loop->the_post();
            $title = get_the_title();
            $subtitle = get_field('provider_title');
            $provider_content = get_field('provider_content');
            $provider_content_right = get_field('provider_content_right_provider_content');
            $content = get_the_content();
            ?>
            
            <div class="provider-item row">
                <div class="col m4">
                    <?php if ( has_post_thumbnail() ) {
							    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							}
							?>
						<div class="blog-image" style="background-image: url('<?php echo $large_image_url[0];?>')">
						</div>
                </div>
                <div class="col m8">
                    <h5><?php echo $subtitle;?></h5>
                    <h2><?php echo $title;?></h2>
                    <div class="row">
                        <?php /*if($content): 
                                the_content();
                            else:*/    
                        ?>
                        <div class="col m6">
                            <?php
                                foreach($provider_content as $pr) {
                                   $list_group = $pr['list_group'];
                                   if( $list_group ):
                                        $pr_title = $list_group['pr_title'];
                                        $pr_list  = $list_group['pr_list'];
                                        echo '<h6>'.$pr_title.'</h6>';
                                        if($pr_list):
                                            echo '<ul>';
                                            foreach($pr_list as $row) {
                                                $pr_list_txt = $row['pr_list_txt'];
                                                echo '<li>'.$pr_list_txt.'</li>';
                                            }
                                            echo '</ul>';
                                        endif;
                                   endif;
                                }
                            ?>
                        </div>
                        <div class="col m6">
                            <?php
                                foreach($provider_content_right as $pr) {
                                   $list_group = $pr['list_group'];
                                   if( $list_group ):
                                        $pr_title = $list_group['pr_title'];
                                        $pr_list  = $list_group['pr_list'];
                                        echo '<h6>'.$pr_title.'</h6>';
                                        if($pr_list):
                                            echo '<ul>';
                                            foreach($pr_list as $row) {
                                                $pr_list_txt = $row['pr_list_txt'];
                                                echo '<li>'.$pr_list_txt.'</li>';
                                            }
                                            echo '</ul>';
                                        endif;
                                   endif;
                                }
                            ?>
                        </div> 
                            <?php //endif;
                            echo '<div class="clearfix">';
                            the_content();
                            echo '</div>';?>
                    </div>
                </div>
                <?php /*if(!empty($content)):?>
                     <div class="col s12 botom-list">
                         <div class="row">
                         <div class="col m6">
                            <?php
                                foreach($provider_content as $pr) {
                                   $list_group = $pr['list_group'];
                                   if( $list_group ):
                                        $pr_title = $list_group['pr_title'];
                                        $pr_list  = $list_group['pr_list'];
                                        echo '<h6>'.$pr_title.'</h6>';
                                        if($pr_list):
                                           
                                            foreach($pr_list as $row) {
                                                $pr_list_txt = $row['pr_list_txt'];
                                                echo '<p>';
                                                echo $pr_list_txt;
                                                echo '</p>';
                                            }
                                           
                                        endif;
                                   endif;
                                }
                            ?>
                        </div>
                        <div class="col m6">
                            <?php
                                foreach($provider_content_right as $pr) {
                                   $list_group = $pr['list_group'];
                                   if( $list_group ):
                                        $pr_title = $list_group['pr_title'];
                                        $pr_list  = $list_group['pr_list'];
                                        echo '<h6>'.$pr_title.'</h6>';
                                        if($pr_list):
                                           
                                            foreach($pr_list as $row) {
                                                $pr_list_txt = $row['pr_list_txt'];
                                                echo '<p>';
                                                echo $pr_list_txt;
                                                echo '</p>';
                                            }
                                           
                                        endif;
                                   endif;
                                }
                            ?>
                        </div> 
                         </div>
                    </div>           
                <?php endif;*/?>
            </div>
            <?php
        endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
}

add_action( 'genesis_before_footer', 'provider_row_sections' , 1 );
function provider_row_sections() {


    $locations_short_title          = get_field('locations_short_title','option');
    $locations_title                  = get_field('locations_title','option');
    // Tab1
    $tab_title                  = get_field('tab_title','option');
    $tab_image                  = get_field('tab_image','option');
    $tab_content                = get_field('tab_content','option');
     // Tab2
    $dental_tab_title                  = get_field('dental_tab_title','option');
    $dental_tab_image                  = get_field('dental_tab_image','option');
    $dental_tab_content                = get_field('dental_tab_content','option');
      // Tab3
    $franconia_content_tab_title                  = get_field('franconia_content_tab_title','option');
    $franconia_content_tab_image                  = get_field('franconia_content_tab_image','option');
    $franconia_content_tab_content                = get_field('franconia_content_tab_content','option');
     // Tab4
     $warren_content_tab_title                  = get_field('warren_content_tab_title','option');
     $warren_content_tab_image                  = get_field('warren_content_tab_image','option');
     $warren_content_tab_content                = get_field('warren_content_tab_content','option');
      // Tab5
    $whitefield_content_tab_title                  = get_field('whitefield_content_tab_title','option');
    $whitefield_content_tab_image                  = get_field('whitefield_content_tab_image','option');
    $whitefield_content_tab_content                = get_field('whitefield_content_tab_content','option');
     // Tab6
    $woodsville_content_tab_title                  = get_field('woodsville_content_tab_title','option');
    $woodsville_content_tab_image                  = get_field('woodsville_content_tab_image','option');
    $woodsville_content_tab_content                = get_field('woodsville_content_tab_content','option');
    
?>
    <!--  Home Locations -->
    <section class="section locations section-space top-image" id="home-locations">
        <div class="wrap animatedParent">
                <div class="row animated fadeIn">
                    <h4><?php echo $locations_short_title; ?></h4>
                    <h2><?php echo $locations_title; ?></h2>      
                    <div class="col s12">
                        <!-- Dropdown Structure -->
                        <a class='btn current-element-tab' href='#'><?php echo $tab_title;?></a>
                        <ul class="tab-dropdown">
                            <li class="item-dropdown"><a class="active" href="#tab1"><?php echo $tab_title;?></a></li>
                            <li class="item-dropdown"><a href="#tab3"><?php echo $franconia_content_tab_title;?></a></li>
                            <li class="item-dropdown"><a href="#tab4"><?php echo $warren_content_tab_title;?></a></li>
                            <li class="item-dropdown"><a href="#tab6"><?php echo $woodsville_content_tab_title;?></a></li>
                            <li class="item-dropdown"><a href="#tab5"><?php echo $whitefield_content_tab_title;?></a></li>
                        </ul>
                        <!-- Dropdown Structure -->
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab col s3"><a class="active" href="#tab1"><?php echo $tab_title;?></a></li>
                            <!-- <li class="tab col s3"><a href="#tab2"><?php echo $dental_tab_title;?></a></li> -->
                            <li class="tab col s3"><a href="#tab3"><?php echo $franconia_content_tab_title;?></a></li>
                            <li class="tab col s3"><a href="#tab4"><?php echo $warren_content_tab_title;?></a></li>
                            <li class="tab col s3"><a href="#tab6"><?php echo $woodsville_content_tab_title;?></a></li>
                            <li class="tab col s3"><a href="#tab5"><?php echo $whitefield_content_tab_title;?></a></li>
                        </ul>
                    </div>
                    <div id="tab1" class="col s12 tab-content">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">
                                <?php echo $tab_content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="tab2" class="col s12 tab-content">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $dental_tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">
                                <?php echo $dental_tab_content;?>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div id="tab3" class="col s12 tab-content">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $franconia_content_tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">    
                                <?php echo $franconia_content_tab_content;?>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="col s12 tab-content">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $warren_content_tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">
                                <?php echo $warren_content_tab_content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="col s12 tab-content">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $whitefield_content_tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">
                                <?php echo $whitefield_content_tab_content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab6" class="col s12 tab-content ">
                        <div class="row">
                            <div class="col s12 m4 l6" style="background-image: url('<?php echo $woodsville_content_tab_image;?>')">
                            </div>
                            <div class="col s12 m8 l6 map-content" style="background-image: url('<?php echo get_stylesheet_directory_uri()?>/assets/images/map.jpg')">
                                <div class="map-content-txt">
                                <?php echo $woodsville_content_tab_content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!--/. End Home Locations -->
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
                <div class="row">
                        <div class="col m5 s12 call-content">
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
