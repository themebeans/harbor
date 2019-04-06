<div id="projects" class="projects">

	<div class="grid-sizer"></div>

	<?php if ( is_search() ) { ?>

		<article class="project masonry-project masonry-search">
			<form method="get" id="searchform" class="searchform search" action="<?php echo home_url(); ?>/">
				<input type="text" name="s" id="s" value="<?php _e( 'Search again...', 'harbor' ); ?>" onfocus="if(this.value=='<?php _e( 'Search again...', 'harbor' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e( 'Search again...', 'harbor' ); ?>';" />
			</form><!-- END #searchform -->
		</article>

	<?php } ?>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'loop-post' ); // PULL LOOP-POST.PHP
		endwhile;
endif;
	?>

</div>
