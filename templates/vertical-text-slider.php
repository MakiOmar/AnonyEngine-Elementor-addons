<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>

<ul class="anoshc-slick-vtext">
	
	<?php foreach ($data as $item) : extract($item) ?>
		
		<li><?php \Elementor\Icons_Manager::render_icon( $content_icon, [ 'aria-hidden' => 'true' ] );?> <?= $content ?></li>
		
	<?php endforeach ?>
				
</ul>