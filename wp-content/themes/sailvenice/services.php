<?php
/*
Template Name: Services
*/
?>
<?php get_header(); ?>
<article class="clearfix">
	<?php 
	$type = 'services';
	$args=array(
	  'post_type' => $type,
	  'post_status' => 'publish',
	  'paged' => $paged,
	  'posts_per_page' => 10,
	  'caller_get_posts'=> 1
	);
	$temp = $wp_query;  // assign orginal query to temp variable for later use   
	$wp_query = null;
	$wp_query = new WP_Query($args); 
	?>

	<?php get_template_part( 'loop', 'index' );?>
</article>
<?php get_footer(); ?>
