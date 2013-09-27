<?php 
global $wp_rewrite;			
global $the_query;
$the_query->query_vars['paged'] > 1 ? $current = $the_query->query_vars['paged'] : $current = 1;

$pagination = array(
	'base' => @add_query_arg('page','%#%'),
	'format' => '',
	'total' => $the_query->max_num_pages,
	'current' => 0,
	'show_all' => true,
  'prev_text'    => '&#8592;',
  'next_text'    => '&#8594;',
	'type' => 'list',
	);


echo '<div class="pagination box">' . paginate_links($pagination) . '</div>'; 		
?>
