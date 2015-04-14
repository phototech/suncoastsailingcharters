<?php
	# Include DirectorAPI class file
	# and create a new instance of the class
	# Be sure to have entered your API key and path in the DirectorPHP.php file.
	include('classes/DirectorPHP.php');
	$director = new Director('your-api-key', 'your-api-path');
	
	# When your application is live, it is a good idea to enable caching.
	# You need to provide a string specific to this page and a time limit 
	# for the cache. Note that in most cases, Director will be able to ping
	# back to clear the cache for you after a change is made, so don't be 
	# afraid to set the time limit to a high number.
	# 
	// $director->cache->set('unique_cache_name', '+30 minutes');

	# What sizes do we want?
	$director->format->add(array('name' => 'thumb', 'width' => '100', 'height' => '100', 'crop' => 1, 'quality' => 75, 'sharpening' => 1));
	$director->format->add(array('name' => 'large', 'width' => '800', 'height' => '450', 'crop' => 0, 'quality' => 95, 'sharpening' => 1));
	
	# We can also request the album preview at a certain size
	$director->format->preview(array('width' => '100', 'height' => '50', 'crop' => 1, 'quality' => 85, 'sharpening' => 1));

	# Make API call using get_album method. Replace "1" with the numerical ID for your album
	$album = $director->album->get(1, array('images_only' => true));

	# Set images variable for easy access
	$contents = $album->contents;
	
?><html>
<head>
	<title>SlideShowPro Director API / Galleria Demo</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script src="js/galleria-1.2.3.min.js"></script>
	<script src="js/themes/classic/galleria.classic.min.js"></script>
	
	<style media="screen">
		body { background: #000; text-align: center; margin-top:50px }
		#container { width:960px; margin: 0 auto; }
	</style>
</head>
<body>
	<div id="container">
		<div id="gallery">
			<?php foreach ($contents as $image): ?>
		    	<img src="<?php echo $image->large->url ?>" alt="<?php echo $image->caption; ?>" title="<?php echo $image->title; ?>">
			<?php endforeach; ?>
		</div>
	</div>

	<script>
	    $('#gallery').galleria({
	        width:960,
	        height:600
	    });
	</script>
</body>
</html>