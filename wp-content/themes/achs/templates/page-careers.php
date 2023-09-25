<?php
/**
 * Template Name: Careers Page
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner

/* # Home Page Block Sections
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_after_entry_content', 'careers_loop' , 2 );
function careers_loop() {
    ?>
    <!--/. Careers section Section -->
    <?php
    $careers = get_field('careers');
    echo '<div class="page-our-provider">';
        echo '<ul class="collapsible cpt-provider" data-collapsible="accordion">';
            foreach($careers as $career){
                echo '<li>';
                    echo '<div class="collapsible-header">'.$career['title_career'].' <i class="fas fa-plus"></i> <i class="fas fa-minus"></i></div>';
                    echo '<div class="collapsible-body body-images">'.$career['content_career'].'</div>';
                echo '</li>';
            }    
        echo '</ul>';
    echo '</div>';
    ?>
     <!--/. End Careers Section -->
   <?php
}


genesis();