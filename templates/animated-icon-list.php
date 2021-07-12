<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>

<div <?= $this->get_render_attribute_string( 'animated_icon_list' ); ?>>
	
	<?php foreach ($data as $item) : extract($item); ?>
		
		<div <?= $this->get_render_attribute_string( 'animated_icon_list_item' ); ?>>
			<div class="anli-number"><?= $content_number ?></div>
			<div class="anli-icon"><?php \Elementor\Icons_Manager::render_icon( $content_icon, [ 'aria-hidden' => 'true' ] );?></div>
			<div class="anli-content"><?= $content ?></div>
				
		</div>
		
	<?php endforeach ?>
				
</div>