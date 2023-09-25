<?php
/*
Button
---------------------------------------------------------------------------------------------------- */
// Example usage 1
// [button href="YOUR LINK" target="self"]Button Text[/button]
// Example usage 2
// [button href="YOUR LINK" target="self" text="Button Text"]

function myprefix_button_shortcode( $atts, $content = null ) {
	
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
        'align'  => 'left',
		'color'  => 'green',
	), $atts ) );

	// Use text value for items without content
	$content = $text ? $text : $content;

	// Return button with link
	if ( $url ) {

		$link_attr = array(
			'href'   => esc_url( $url ),
			'title'  => esc_attr( $title ),
			'target' => ( 'blank' == $target ) ? '_blank' : '',
			'class'  => 'myprefix-button '.esc_attr( $color ),
		);

		$link_attrs_str = '';

		foreach ( $link_attr as $key => $val ) {

			if ( $val ) {

				$link_attrs_str .= ' '. $key .'="'. $val .'"';

			}

		}


		return '<p style="text-align: '.$atts['align'].'"><a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .' <i class="fas fa-caret-right"></i></span></a></p>';

	}

	// No link defined so return button as a span
	else {

		return '<p style="text-align: '.$atts['align'].'"><span class="myprefix-button"><span>'. do_shortcode( $content ) .'</span></span></p>';

	}

}
add_shortcode( 'button', 'myprefix_button_shortcode' );

function transparent_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
		'color'  => 'white',
	), $atts ) );

	return '<a href="'.$url.'" class="btn-transparent '.$color.'" target="'.$target.'" title="'.$title.'">'.$content.'</a>';

}
add_shortcode( 'button_link', 'transparent_button_shortcode' );

/*
Socials
---------------------------------------------------------------------------------------------------- */
function socials_function($atts, $content) {
	ob_start();
	$out = '';
	$socials = get_field('socials','option');
	if($socials):
		echo '<ul class="footer-socials">';
		foreach($socials as $row)	{
			if($row['social']=='youtube')
				echo '<li><a href="'.$row['social_url'].'" target="'.$row['target'].'"><i class="fontello-'.$row['social'].'"></i></a></li>';
			else
				echo '<li><a href="'.$row['social_url'].'" target="'.$row['target'].'"><i class="icon-'.$row['social'].'"></i></a></li>';
		}
		echo '</ul>';
	endif;
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

add_shortcode( 'socials', 'socials_function' );

/*
Social links
---------------------------------------------------------------------------------------------------- */
function social_links_function($atts, $content) {
	ob_start();
	$out = '';
	$socials = get_field('social_links','option');
	if($socials):
		foreach($socials as $social){
			echo '<a href="'.$social['link'].'" target="_blank" class="social-link"><i class="fab fa-'.$social['social'].'"></i></a>';
		}
	endif;
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

add_shortcode( 'social-links', 'social_links_function' );

/*
Intro Text
---------------------------------------------------------------------------------------------------- */
function intro_text($atts, $content) {
	$stl = '';
	if($color = $atts['color']) $stl = 'style=	"color: '.$color.';"'; 
	return '<div class="intro-text" '.$stl.'>'.do_shortcode($content).'</div>';
}
add_shortcode( 'intro', 'intro_text' );

/*
Testimonials
---------------------------------------------------------------------------------------------------- */
function testimonials_function($atts, $content) {
	ob_start();
	extract( shortcode_atts( array(
		'id'    => '',
	), $atts ) );
	$out = '';
	// $post = get_post( $id );
	$block_testimonial = get_field('block_testimonial', $id);
	if( $block_testimonial ):
		echo '<div class="testimonials">';
		foreach($block_testimonial as $row) {  
			$testimonial_content			= $row['testimonial_content'];
			$title 							= $row['title'];
			$button_url						= $row['button_url'];
			$button_text 					= $row['button_text'];
			$button_target 					= $row['button_target'];
			echo '<div class="testimonial">';
				echo '<div class="wrap">';
				echo '<div class="testimonial-content">'.$testimonial_content.'</div>';
				echo '<div class="testimonial-separator"></div>';
				echo '<div class="testimonial-title">'.$title.'</div>';
				echo do_shortcode('[button align="center" target="'.$button_target.'" url="'.$button_url.'" color="white large transparent"]'.$button_text.'[/button]');
				echo '</div>';
			echo '</div>';
		}
		echo '</div>';
	endif;
	
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'testimonials', 'testimonials_function' );

/*
Faq
---------------------------------------------------------------------------------------------------- */
function vendor_faq($atts, $content) {
	ob_start();
	
	$out = '';
	$faqs = get_field('faq');
	if($faqs):
		$i = 1;
		echo '<div class="accordion">';
		foreach($faqs as $faq)	{
			
			$faq_title = $faq['faq_title'];
			$faq_content = $faq['faq_content'];
			echo '<div class="accordion-section">';
				echo '<a class="accordion-section-title" href="#accordion-'.$i.'">'.$faq_title.'</a>';
				echo '<div id="accordion-'.$i.'" class="accordion-section-content">';
					echo do_shortcode($faq_content);
				echo '</div>';
			echo '</div>';
			$i++;
		}
		echo '</div>';
	endif;
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'faq', 'vendor_faq' );

/*
Deals
---------------------------------------------------------------------------------------------------- */
function deals_function($atts, $content) {
	ob_start();
	extract( shortcode_atts( array(
		'count'    => '-1',
		'button_text' => 'View Deals',
		'button_link' => ''
	), $atts ) );
	$out = '';
	$args = array('post_type' => 'vendor','posts_per_page'=>$count);
	$loop = new WP_Query($args);

	if ( $loop->have_posts() ) : 
		echo '<div class="row">';
		while ( $loop->have_posts() ) : $loop->the_post();
			$logo = get_field('vendor_logo');
			echo '<div class="col s12 m6 l4">';
				if($logo )
					echo '<div class="box-logo" onclick="location.href=\''.get_permalink().'\';"><img src="'.$logo.'" /></div>';
				else
				echo '<div class="hero-logo">'.get_the_title().'</div>';
			echo '</div>';
		endwhile;
		echo '</div>';
		if($button_link):
			echo '<div class="row">';
				echo do_shortcode('[button align="center" url="'.$button_link.'" color="blue large"]'.$button_text.'[/button]');
			echo '</div>';
		endif;
	else:
		echo '<h1>No posts here!</h1>';
	endif;
	wp_reset_postdata();
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'deals', 'deals_function' );

/*
Deals List
---------------------------------------------------------------------------------------------------- */
function vendor_list_function($atts, $content) {
	ob_start();
	extract( shortcode_atts( array(
		'count'    => '-1'
	), $atts ) );
	$out = '';
	$args = array('post_type' => 'vendor','posts_per_page'=>$count);
	$loop = new WP_Query($args);
	$tags[] = array();
	if ( $loop->have_posts() ) : 
		echo '<div class="row">';
			$wcatTerms = get_terms('tags_vendor', array('hide_empty' => 0, 'parent' =>0)); 
			echo '<ul class="simplefilter">';
				echo '<li class="active" data-filter="all">All Partners</li>';
				$i = 1;
			foreach($wcatTerms as $wcatTerm):
				// echo '<li data-filter="'.$i.'">'.$wcatTerm->name.'</li>';
				echo '<li data-filter="'.$wcatTerm->term_id.'">'.$wcatTerm->name.'</li>';
				$tags[$i] = $wcatTerm->slug;
				$i++;
			endforeach;
				echo '<li class="search-box">
						<div class="search-row">
							<input type="text" class="filtr-search" placeholder="Search" name="filtr-search" data-search>
						</div>
					</li>';
			echo '</ul>'; 
		echo '</div>';

		echo '<div class="filtr-container">';
			while ( $loop->have_posts() ) : $loop->the_post();
		 		$logo = get_field('vendor_logo');
		 		$terms =  wp_get_object_terms( get_the_ID(), 'tags_vendor', array('fields'=>'ids'));
				 $terms_str = implode(", ", $terms);
			
		 		$terms_slug =  wp_get_object_terms( get_the_ID(), 'tags_vendor', array('fields'=>'slugs'));
		 		$terms_slug_str = implode(" ", $terms_slug);
		 		echo '<div class="col s12 m6 l4 filtr-item" data-category="'.$terms_str.'" data-sort="'.$terms_slug_str.'">';
		 			if($logo )
		 				echo '<div class="box-logo" onclick="location.href=\''.get_permalink().'\';"><img src="'.$logo.'" /></div>';
		 			else
		 				echo '<div class="hero-logo">'.get_the_title().'</div>';
		 			echo '<span class="item-desc">'.get_the_title().'</span>';
		 		echo '</div>';
		 	endwhile;
		echo '</div>';
		echo '<script>';
		echo 'jQuery(document).ready(function($) {';
		echo 'jQuery(".filtr-container").filterizr();';
		echo '});';
		echo '</script>';
	else:
		echo '<h1>No posts here!</h1>';
	endif;
	wp_reset_postdata();
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'vendor_list', 'vendor_list_function' );

/*
Video
---------------------------------------------------------------------------------------------------- */
function video_function($atts, $content) {
	ob_start();
	extract( shortcode_atts( array(
		'url'    => '',
		'width'	 => '590',
		'height' => '332'
	), $atts ) );
	$out = '';
	$video = determineVideoUrlType($url);
	if($video['video_type'] == 'youtube'){
		echo '<div class="deals-video">';
		echo $content;
		echo '<button></button>';
			echo '<iframe width="'.$width.'" height="'.$height.'" src="'.$url.'" allowfullscreen class="youtube"></iframe>';
		echo '</div>';
	} elseif($video['video_type'] == 'vimeo'){
		echo '<div class="deals-video">';
		echo $content;
		echo '<button></button>';
			echo '<iframe src="'.$url.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="vimeo"></iframe>';
		echo '</div>';
	} else {
		echo '<div class="deals-video">';
		echo $content;
		echo '<button></button>';
		echo '<video width="'.$width.'" height="'.$height.'" controls>
				<source src="'.$url.'" type="video/mp4"></source>
			</video>';
		echo '</div>';
	}

	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'daseke_video', 'video_function' );

function determineVideoUrlType($url) {

    $yt_rx = '/^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$/';
    $has_match_youtube = preg_match($yt_rx, $url, $yt_matches);


    $vm_rx = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([‌​0-9]{6,11})[?]?.*/';
    $has_match_vimeo = preg_match($vm_rx, $url, $vm_matches);


    //Then we want the video id which is:
    if($has_match_youtube) {
        $video_id = $yt_matches[5]; 
        $type = 'youtube';
    }
    elseif($has_match_vimeo) {
        $video_id = $vm_matches[5];
        $type = 'vimeo';
    }
    else {
        $video_id = 0;
        $type = 'mp4';
    }


    $data['video_id'] = $video_id;
    $data['video_type'] = $type;

    return $data;

}
/*
Blog
---------------------------------------------------------------------------------------------------- */
add_shortcode( 'blog' , 'all_posts_function' );
function all_posts_function() {
	$a = shortcode_atts( array(
        'posts' 			=>  '6',
    ), $atts );
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $a['posts'],
		'post_status'    => 'publish',
		// 'orderby'		 => 'menu_order',
		'orderby'		 => 'post_date',
		'order'			 => 'DESC',
		'paged'          => get_query_var( 'paged' )
	);
	$out	=	'';
	 
	global $wp_query;
	$wp_query = new WP_Query( $args );
	ob_start();
	if ( have_posts() ) :
		$i = 250;
		$first = 'first'; 
		?>
			<div class="row blog-wrap animatedParent">
			
			<?php while ( have_posts() ) : the_post(); 
				
			?>	<div class="blog-item col m6 l6 xl4 animated fadeInUpShort delay-<?php echo $i; ?>" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
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
				$i = $i + 250;
				endwhile; ?>
				<div class="blog-pagination">
						<?php genesis_numeric_posts_nav(); ?>
				</div>	
		</div>
			
	<?php endif;
	wp_reset_query();
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

/*
Event
---------------------------------------------------------------------------------------------------- */
add_shortcode( 'event' , 'all_events_function' );
function all_events_function() {
	$a = shortcode_atts( array(
        'posts' 			=>  '6',
    ), $atts );
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'event',
		'posts_per_page' => $a['posts'],
		'post_status'    => 'publish',
		// 'orderby'		 => 'menu_order',
		'orderby'		 => 'post_date',
		'order'			 => 'DESC',
		'paged'          => get_query_var( 'paged' )
	);
	$out	=	'';
	 
	global $wp_query;
	$wp_query = new WP_Query( $args );
	ob_start();
	if ( have_posts() ) :
		$i = 250;
		$first = 'first'; 
		?>
			<div class="row blog-wrap animatedParent">
			
			<?php while ( have_posts() ) : the_post(); 
				
			?>	<div class="blog-item col m6 l6 xl4 animated fadeInUpShort delay-<?php echo $i; ?>" style="cursor: pointer;" onclick="window.location='<?php echo get_permalink(); ?>';">
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
				$i = $i + 250;
				endwhile; ?>
				<div class="blog-pagination">
						<?php genesis_numeric_posts_nav(); ?>
				</div>	
		</div>
			
	<?php endif;
	wp_reset_query();
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

/*
Search
---------------------------------------------------------------------------------------------------- */
add_shortcode( 'search_ach' , 'search_ach_function' );
function search_ach_function() {
	$out	=	'';
	ob_start();
	?>
	<li class="masthead">
	<form action="" class="masthead-search">
		<label for="masthead-search-toggle" class="masthead-search-toggle"></label>
		<input type="checkbox" id="masthead-search-toggle" class="isHidden"/>
		<div class="masthead-search-indicator"></div>
		<div class="masthead-search-search">
		<label for="masthead-search-search" class="isHidden">Search</label>
		<input type="search" id="masthead-search-search"/>
		</div>
	</form>
</li>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

/*
Providers List
---------------------------------------------------------------------------------------------------- */
add_shortcode( 'providers', 'providers_function' );
 
function providers_function($atts, $content) {
	$out	=	'';


    $terms = get_field('all_providers');
    // print_r($terms);
    $out	.= '<div class="page-our-provider zzz">';
        foreach($terms as $category){
            $active = "";
            $out	.= '<div class="material-content cpt-provider">'; 
                if($location == $category['prov_title']) $active = "active";
                // $out	.= '<div class="provider-header '.$active.'">'.$category['prov_title'].' <i class="fas fa-plus"></i> <i class="fas fa-minus"></i></div>';
                $out	.= '<div class="body-images">';
					$out	.= '<div class="row">';
                      
                        if ( $category['prov_provider'] ) {
                        //     while ( $query->have_posts() ) {
                        //         $query->the_post(); 
                        	foreach($category['prov_provider'] as $provider){
                            // setup_postdata($provider);
							$out	.= '<div class="col m3 s6">';
                                if ( has_post_thumbnail($provider->ID) ) {
                                    $thumb_id = get_post_thumbnail_id($provider->ID);
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'provider-thumbnail', true);
                                    $out	.= '<img src="'.$thumb_url[0].'" />';
                                } else {
                                    $out .= '<img src="'.get_stylesheet_directory_uri().'/assets/images/default.png" />';
                                }
                                $out	.= '<a href="'.get_the_permalink($provider->ID).'">';
									$out	.= '<div class="hover-details">';
										$out	.= '<i class="fas fa-search"></i>';
										$out	.= '<strong>'.get_the_title($provider->ID).'</strong>';
                                        if(get_field('provider_title', $provider->ID))
											$out	.= '<span>'.get_field('provider_title', $provider->ID).'</span>';
									$out	.= '</div>';
								$out	.= '</a>';
							$out	.= '</div>';    
                            } 
                            // wp_reset_postdata();
                        }
					$out	.= '</div>';
				$out	.= '</div>';
			$out	.= '</div>';
        // wp_reset_postdata();
    }
	$out	.= '</div>';
	return $out;
}