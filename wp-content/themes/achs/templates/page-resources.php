<?php
/**
 * Template Name: Page Resources
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'services_body_class' );
function services_body_class( $classes ) {
	
	$classes[] = 'page-resources';
	return $classes;
	
}

//* Add Board after Loop
add_filter( 'genesis_loop', 'resources_loop' );
function resources_loop( ) {
    echo '<div class="materials-downloable">';
        echo '<ul class="material-content material-item">';
            echo '<li>';
                // echo '<div class="collapsible-header">Officers <i class="fas fa-plus"></i> <i class="fas fa-minus"></i></div>';
                echo '<div class="material-image body-images">';
                    echo '<div class="row">';
                        if ( get_field('materials') ) {
                            foreach(get_field('materials') as $material) {
                                echo '<div class="col m3 s6">';
                                    if ( $material['image'] ) {
                                        echo '<img src="'.$material['image'].'" />';
                                    } else {
                                        echo '<img src="'.get_stylesheet_directory_uri().'/assets/images/default.png" />';
                                    }
                                    echo '<a href="'.$material['file'].'" download>';
                                        echo '<div class="hover-details">';
                                            echo '<i class="fas fa-download"></i>';
                                            // if($member['title'])
                                                echo '<strong>'.$material['title'].'</strong>';
                                            // if($member['name'])
                                            //     echo '<span>'.$member['name'].'</span>';
                                            // if($member['place'])
                                            //     echo '<div><strong><i>'.$member['place'].'</i></strong></div>';
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';    
                            } 
                        }
                    echo '</div>';
                echo '</div>';
            echo '</li>';
        echo '</ul>';
    echo '</div>';
	
}

genesis();