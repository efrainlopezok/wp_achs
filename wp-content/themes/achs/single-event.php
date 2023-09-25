<?php

add_action( 'genesis_after_header', 'sk_display_featured_image' );
function sk_display_featured_image() {
	
	if (  has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
        <div class="single-featured-image" style="background-image: url('<?php echo $image[0]; ?>')">
        </div>
        <?php
	}
	
}

add_filter( 'body_class', 'single_blog_body_class' );
function single_blog_body_class( $classes ) {
	
	$classes[] = 'page-blog page-event';
	return $classes;
	
}

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

add_filter( 'genesis_post_meta', 'ig_entry_meta_footer' );
function ig_entry_meta_footer( $post_meta ) {
	$post_meta = '';
	return $post_meta;
}

add_action( 'genesis_entry_header', 'wpsites_excerpt', 11 ); 
function wpsites_excerpt() {
    echo '<div class="post-entry">';
        //echo '<div class="post-date">'.get_the_date().'</div>';
        echo '<h3>'.get_the_title().'</h3>';
    echo '</div>';
}

add_action( 'genesis_before_footer', 'related_row_sections' , 1 );
function related_row_sections() {
    $posts = get_field('group_related_posts');
    echo '<div class="posts_related animatedParent">';
        echo '<div class="wrap animated fadeIn delay-350">';
        echo '<h4>You may also like</h4>';
        if( $posts ): ?>
            <div class="row">
            <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                <?php setup_postdata($post);  ?>
                <div class="blog-item col m4" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink($post->ID); ?>';">
						<?php
							if ( has_post_thumbnail() ) {
							    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
	
							}
							?>
						<div class="blog-image" style="background-image: url('<?php echo $large_image_url[0];?>')">
						</div>
						<div class="blog-content">	
							<h4><?php echo $post->post_title;?></h4>
							<p><?php echo wp_trim_words($post->post_content,20); ?></p>
							<p><a class="readmore" href="<?php echo get_permalink($post->ID); ?>">Read more <i class="fas fa-caret-right"></i></a></p>
						</div>

						
				</div>
            <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
        else:
            $args=array(
                'orderby' => rand,
                'post_type' => 'event',
                'post_status' => 'publish',
                'posts_per_page' => 3
            );
            $my_query = null;
            $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                    echo '<div class="row">';
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div class="blog-item col m4" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
						<?php
							if ( has_post_thumbnail() ) {
							    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	
							}
							?>
						<div class="blog-image" style="background-image: url('<?php echo $large_image_url[0];?>')">
						</div>
						<div class="blog-content">	
							<h4><?php echo get_the_title();?></h4>
							<p><?php echo wp_trim_words(get_the_excerpt( ),10); ?></p>
							<p><a class="readmore" href="<?php echo get_permalink(); ?>">Read more <i class="fas fa-caret-right"></i></a></p>
						</div>

						
				    </div>
                    <?php
                    endwhile;
                    echo '</div>';
                }
                wp_reset_query(); 
        endif; 
        echo '</div>';
    echo '</div>';
    ?>
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