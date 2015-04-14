<?php
	include('php/director/classes/DirectorPHP.php');
	$director = new Director('local-2cbbcf7d4f7f17cf375f3e1ba3d7343b', 'sailvenice.com/slideshowpro');
	$director->format->add(array('name' => 'large', 'width' => '760', 'height' => '161', 'crop' => 1, 'quality' => 100, 'sharpening' => 1));
	// this gets the first random image shouldn't be nessessarry as long as the user doesn't add 'other' images.
	$img = $director->content->all(array('limit' => 1, 'sort_on' => 'random'));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php bloginfo('name'); ?><?php wp_title("-",true); ?></title>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<?php wp_head(); ?>
		<?php if (is_single()) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php if (has_post_thumbnail()) { 
				$getimage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$ogimage = $getimage[0];
			} elseif (is_attachment()) {
				$getimage = wp_get_attachment_image_src('', 'full');
				$ogimage = $getimage[0];
			} else {
				$ogimage = get_bloginfo('template_directory').'/img/social.png';
			}
			endwhile;
		} else {
			$ogimage = get_bloginfo('template_directory').'/img/social.png';
		} ?>
		<meta name="og:title" content="<?php the_title(); ?>" />
		<meta name="og:type" content="article" />
		<meta name="og:image" content="<?php print $ogimage; ?>" />
		<meta name="og:description" content="<?php the_excerpt_rss() ?>" />
		<meta name="og:url" content="<?php the_permalink(); ?>" />
		<meta name="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta name="fb:page_id" content="161485573930411" />
		<script src="<?php bloginfo('url'); ?>/slideshowpro/m/embed.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_directory'); ?>/js/script.js" type="text/javascript"></script>
	</head>
	<body <?php body_class(); ?>>
		<section>
			<header class="clearfix">
				<a href="<?php echo site_url(); ?>">
					<img src="<?php bloginfo('template_url');?>/img/logo.png" alt="<?php bloginfo('name'); ?>" />
				</a>
				<?php wp_nav_menu(array('depth'=>2,'theme_location'=>'primary', 'container' => 'nav', 'fallback_cb' => false)); ?>
			</header>
			<div id="slideshowcontainer">
				<div class="shadow"></div>
				<h1 class="title">
					<?php if (single_tag_title( '', false )) : ?>
					<?php single_tag_title('tag &rarr; ', true); ?>
					<?php elseif (get_the_title()) : ?>
					<?php the_title(); ?>
					<?php endif; ?>
				</h1>
				<div id="slideshow">
					<div class="ssp-mobile-poster">
						<img src="<?php echo $img[0]->large->url; ?>" alt="" />
					</div>
				</div>
			</div>
