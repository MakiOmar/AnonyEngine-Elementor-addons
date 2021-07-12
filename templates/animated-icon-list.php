<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>

<div <?= $this->get_render_attribute_string( 'animated_icon_list' ); ?>>
	
	<?php foreach ($data as $item) : extract($item); ?>
		
		<span <?= $this->get_render_attribute_string( 'animated_icon_list_item' ); ?>><?php \Elementor\Icons_Manager::render_icon( $content_icon, [ 'aria-hidden' => 'true' ] );?> <?= $content ?></span>
		
	<?php endforeach ?>
				
</div>