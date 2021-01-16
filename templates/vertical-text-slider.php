<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>

<div class="anoshc-slick-vtext">
	
	<?php foreach ($data as $item) : extract($item) ?>
		
		<p><?php \Elementor\Icons_Manager::render_icon( $content_icon, [ 'aria-hidden' => 'true' ] );?> <?= $content ?></p>
		
	<?php endforeach ?>
				
</div>