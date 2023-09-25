<?php
/**
 * Template Name: Contact Template
 *
 * @package WordPress
 * @subpackage ACHS
 * @since ACHS
 */


//* Remove .site-inner
add_filter( 'body_class', 'contact_body_class' );
function contact_body_class( $classes ) {
	
	$classes[] = 'page-contact page-blog';
	return $classes;
	
}

add_action( 'genesis_before_footer', 'properties_row_sections' , 1 );
function properties_row_sections() {
    $properties = get_field('properties');
    echo '<div class="properties">';
        echo '<div class="wrap">';
        if( $properties ): ?>
            <div class="row">
            <?php foreach( $properties as $row): // variable must be called $post (IMPORTANT) 
                    $property_image = $row['property_image'];
                    $property_title = $row['property_title'];
                    $property_address = $row['property_address'];
                    $property_phone = $row['property_phone'];
                    $property_fax = $row['property_fax'];
                    $property_email = $row['property_email'];
                ?>
                <div class="blog-item col l4 m6 s12" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
						<div class="blog-image" style="background-image: url('<?php echo $property_image;?>')">
						</div>
						<div class="blog-content hide-mobile">	
							<h4><?php echo $property_title;?></h4>
							<p><?php echo $property_address; ?></p>
                            <p><strong>Phone:</strong> <?php echo $property_phone; ?></p>
                            <p><strong>Fax:</strong> <?php echo $property_fax; ?></p>
                            <p><strong>Email:</strong> <?php echo $property_email; ?></p>
						</div>
                        <div class="blog-content hide-desktop show-mobile">	
							<h4><?php echo $property_title;?></h4>
							<p><?php echo $property_address; ?></p>
                            <ul class="buttons-contact">
                                <li class="btn-call"><a href="tel:<?php echo $property_phone; ?>"><i class="fas fa-phone"></i> Call</a></li>
                                <li class="btn-mail"><a href="mailto:<?php echo $property_email; ?>"><i class="far fa-envelope"></i> Mail</a></li>
                            </ul>
						</div>
						
				</div>
            <?php endforeach; ?>
            </div>
            <?php 
        endif; 
        echo '</div>';
    echo '</div>';
}

genesis();