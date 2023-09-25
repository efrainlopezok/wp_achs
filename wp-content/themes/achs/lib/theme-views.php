<?php

/**
 * Custom queries, hooks, etc go here
 */

genesis_register_sidebar( array(
    'id' => 'top-bar',
    'name' => __( 'Top Bar', 'theme-prefix' ),
    'description' => __( 'This is the top barr.', 'achs' ),
   ) );

add_action( 'genesis_before_header', 'utility_bar' );

function utility_bar() {
 
    echo '<div class="full-top-bar"><div class="wrap">';
 
            genesis_widget_area( 'top-bar', array(
            'before' => '<div class="top-bar">',
            'after' => '</div>',
            ) );

 
    echo '</div></div>';
 
}

/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'logo', 'option' );
	echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="TI"><img src="'.$logo.'" alt="logo"/></a>';
}
add_action( 'genesis_site_title', 'custom_site_title' );


add_action( 'genesis_before_footer', 'rtug_after_footer_widgets' );
function rtug_after_footer_widgets() {
    ?>
    <div class="pre-copy">
        <div class="wrap">
            <div class="row">
                <div class="col l8 m6 s12">
                    <h6>Enter Your Email to Hear More About ACHS Services, Events, and Offerings:</h6>
                </div>
                <div class="col l4 m6 s12">
                    <?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
/* # Copyright
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
    $copy_right = get_field( 'copy_right', 'option' );
    $footer_right = get_field( 'footer_right', 'option' );
    ?>
        <div class="row">
            <div class="col m8 copy-left">
                <p>&copy; <?php echo date("Y"); ?> <?php echo $copy_right;?></p>
            </div>
            <div class="col m4 copy-right">
                <?php echo $footer_right ?>
            </div>
        </div>

	<?php
}
/* # Remove Pages Title
---------------------------------------------------------------------------------------------------- */
remove_action('genesis_entry_header', 'genesis_do_post_title');

/* # Force Full Page 
---------------------------------------------------------------------------------------------------- */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


/* # Hero Images on Page
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_after_header', 'deals_display_featured_image', 1 );
function deals_display_featured_image() {
    $hero_option		= get_field('hero_option');	
	if( $hero_option[0] == 'yes') {
        $hero_slide  = get_field('hero_slide');
        if(count($hero_slide) > 1):
            echo '<div class="hero-slide loading">';
            foreach ($hero_slide as $row) {
                $hero_content       = $row['block_text'];
                $background_image   = $row['background_image'];
                echo '<div class="hero" style="background-image: url('.$background_image.');">';
                    echo '<div class="wrap animatedParent">';
                        if($hero_content ):
                            echo '<div class="hero-content">';
                            echo do_shortcode($hero_content);
                            echo '</div>';
                        else:
                            echo '<h2>'.get_the_title().'</h2>';
                        endif;
                    echo '</div>';	
                echo '</div>';	
            }
            echo '</div>'; 
            ?>
            <?php    
        else:
            $hero_content       = $hero_slide[0]['block_text'];
            $background_image   = $hero_slide[0]['background_image'];
            $tagline            = $hero_slide[0]['tagline'];
                echo '<div class="hero" style="background-image: url('.$background_image.');">';
                    echo '<div class="wrap animatedParent">';
                        if($hero_content ):
                            echo '<div class="hero-content animated fadeIn">';
                            echo do_shortcode($hero_content);
                            echo '<div class="hero-tagline">'.do_shortcode($tagline).'</div>';
                            echo '</div>';
                        else:
                            echo '<h2>'.get_the_title().'</h2>';
                        endif;
                        echo '</div>';	
                    echo '</div>';	
                echo '</div>';		
        endif;
        
	} 

}



