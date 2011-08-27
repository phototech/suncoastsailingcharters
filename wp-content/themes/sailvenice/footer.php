		<footer class="clearfix">
		&copy;<?= date('Y'); ?> <?php bloginfo('name'); ?>
				<?php wp_nav_menu(array('depth'=>1,'theme_location'=>'secondary', 'container' => 'nav', 'fallback_cb' => false)); ?>
		</footer>
		</section>
		<script type="text/javascript">// <![CDATA[
				SlideShowPro({
					attributes: {
						src: "<?php bloginfo('template_directory'); ?>/swf/header.swf",
						id: "slideshow",
						width: 760,
						height: 161
					},
					mobile: {
						auto: false
					},
					params: {
						bgcolor: "#000000",
						allowfullscreen: false,
						wmode: "transparent"
					},
					flashvars: {
						<?php if (get_post_meta($post->ID, "slideshowpro", true)) : ?>
						xmlFilePath: "<?php echo get_post_meta($post->ID, "slideshowpro", true); ?>"
						<?php else : ?>
						xmlFilePath: "<?php echo site_url(); ?>/slideshowpro/images.php?gallery=1"
						<?php endif; ?>
					}
				});
			// ]]>
			</script>
	</body>
</html>