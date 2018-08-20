<?php
if ( ! defined('ABSPATH') ) {
    require( dirname( __FILE__ ) . './..'.'/wp-load.php' );
    }
    $today = date("Y-m-d");
//function isiemail() {
	$blogs = get_last_updated();
	foreach ($blogs AS $blog) {    
		switch_to_blog($blog["blog_id"]);
		$today = getdate();
		$args = array(
    	'post_type'         => 'post',
    	'post_status'       => 'publish',
    	'date_query'        => array(
    		array(
            'year'  => $today['year'],
            'month' => $today['mon'],
            'day'   => $today['mday']
        		)
    		)
		);
		$wpb_all_query = new WP_Query($args); ?>
		<?php if ( $wpb_all_query->have_posts() ) : ?>
	 
	    	<!-- the loop -->
	    		<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); 

	      		 $judul = esc_html( get_the_title() );
	      		 $blog = esc_html( get_bloginfo() );
	      		 $waktu = get_the_date('Y-m-d');
				 $konten = get_the_date('Y-m-d')." | ".get_bloginfo()." | ".'<a href="'.get_permalink().'">'.get_the_title().'</a></br>';
				 $semuakonten[]=$konten
	      		 ?>
	    	<?php endwhile; ?>
	    	<!-- end of the loop -->
	    	<?php wp_reset_postdata(); ?>
	 		<?php endif; ?>
	 		<?php restore_current_blog(); 
	 	}

$artikel = implode(" ",$semuakonten);
//echo $artikel; ?>