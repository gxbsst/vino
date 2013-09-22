<?php 
add_shortcode('vj_tastings', function(){
	$loop = new WP_Query(
		array(
			'post_type' => 'vj_tasting',
			'orderby' => 'title'
			)
		);
	if ($loop->have_posts()) {
		$output = '<ul class="vj_tasting_list">';
		while ($loop->have_posts()) {
			$loop->the_post();
			$meta = get_post_meta(get_the_id(), '');
			$output .= '
			<li>
			  <a href="' . get_permalink() .'">
				' . get_the_title() . ' | ' .
				$meta['vj_tasting_date'][0] .'
			  </a>	
			  </div>' . get_the_excerpt() . '</div>
			';
			// print_r($meta);
		}
	} else {
		$output = 'No Tasting Added.';
	}
	return $output;
});
?>