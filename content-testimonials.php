<?php
/**
 * The content for the displaying on both the testimonials template.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */
?>

<section class="testimonials clearfix">

	<h3><?php echo esc_html( get_theme_mod( 'testimonials_title' ) ); ?></h3>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			var owl = $("#testimonials-<?php echo esc_js( the_ID() ); ?>");
			$(owl).owlCarousel({
				navigation : true,
				loop:true,
				stopOnHover : true,
				autoHeight: true,
				pagination: true,
				singleItem:true,
				slideSpeed: 600,
				addClassActive: true,
			});
			$(".next").click(function(){
				owl.trigger('owl.next');
			})
			$(".prev").click(function(){
				owl.trigger('owl.prev');
			})
			$(".owl-item").click(function(){
				owl.trigger('owl.next');
			})
		});
	</script>

	<div id="testimonials-<?php esc_attr( the_ID() ); ?>">

		<?php
		$args = array(
			'post_type'      => 'testimonial',
			'orderby'        => 'rand',
			'posts_per_page' => '8',
		);

		query_posts( $args );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop-testimonial' );
			endwhile;
		endif;
		wp_reset_postdata();
		?>

	</div>

</section>
