<?php 
/* not appropriated pagination system
 * wp_pagenavi(); // plugin
 * kriesi_pagination($pages = '', $range = 2); // function
 * kriesi_pagination($additional_loop->max_num_pages);
*/

global $wp_rewrite;			
//$current_cat = get_query_var('cat');
//$current_cat = $query_cat;
//$current_cat_name = get_query_var('category_name');
//$current_cat_name = get_categories("include=$current_cat");
//$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
$related_query->query_vars['paged'] > 1 ? $current = $related_query->query_vars['paged'] : $current = 1;
//$current_uri = $_SERVER['REQUEST_URI'];

$pagination = array(
	//'base' => @add_query_arg( array('cat' => $current_cat, 'paged' => '%_%'), $_SERVER['SERVER_NAME'] ),
	//'base' => @add_query_arg( array('paged' => '%#%'), $_SERVER['SERVER_NAME'] ),
	//'base' => @add_query_arg("paged",'%#%'),
	//'base' => '%_%',
	//'base' => $base,
	//'format' => "{$current_cat_name->category_nicename}/page/%#%",
	//'format' => '/page/%#%',
	//'format' => '?paged=%#%',
	//'format' => '',
	'total' => $related_query->max_num_pages,
	'current' => $current,
	'show_all' => false,
	'mid_size' => 3,
	'end_size' => 2,
	'prev_text' => __('«'),
	'next_text' => __('»'),
	'type' => 'list',
	//'add_args' => @add_query_arg("cat"), // doesn't work
	//'add_args' => @add_query_arg('category_name')
	);

	if( $wp_rewrite->using_permalinks() )
	//$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',$current_uri ) ) . "$current_cat_name/", 'cat' . "page/%#%/", 'paged');
	//$pagination['base'] = user_trailingslashit( "$current_cat_name", 'cat' . "page/%#%/", 'paged');
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . "page/%#%/", 'paged');

if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array('s'=>get_query_var('s'));

// query posts count
//if ( is_home() ) { $counter = query_posts("showposts=-1"); $count_text = "art&iacute;culos"; }
//elseif ( is_search() ) { $counter = query_posts("s=$s&showposts=-1"); $count_text = "resultados"; }
//elseif ( is_category() ) { $query_cat = $related_query->query_vars['cat']; $counter = query_posts("cat=$query_cat&showposts=-1"); $count_text = "art&iacute;culos"; }
//	$count_posts = $related_query->post_count;
//	wp_reset_query();


echo "<div id='navega'><nav>";
//echo "<ul id='navega'>";
echo paginate_links($pagination);
//echo "<div class='nav-counter'>$count_posts $count_text</div>";

// begin TEST AREA
//echo "<div style='display: none;'>";
//print_r($wp_query->query_vars);
//echo "<br />base var: "; echo $base;
//echo $current_uri;
//echo "<br />$current_cat_name<br />";
//$try = "har{$pagination->format}<br />";
//$try = get_pagenum_link(1);
//echo "$try<br />";
//echo $_SERVER['SERVER_NAME'];
//echo "</div>";
// end TEST AREA

//echo "</ul><!-- end id navega -->";
echo "</nav></div>";
?>
