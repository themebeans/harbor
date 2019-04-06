<?php
/**
 * The template for displaying the default searchform whenever it is called in the theme.
 *
 * @package     Harbor
 * @link        https://themebeans.com/themes/harbor
 */
?>

<form method="get" id="searchform" class="searchform" action="<?php echo home_url(); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'Click to search...', 'harbor' ); ?>" onfocus="if(this.value=='<?php _e( 'Click to search...', 'harbor' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e( 'Click to search...', 'harbor' ); ?>';" />
</form><!-- END #searchform -->
