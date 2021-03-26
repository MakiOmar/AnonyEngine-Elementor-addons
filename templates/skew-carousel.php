<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
?>

<section id="slider">
	<div class="slider-content">
		<?php foreach ($data as $index => $item) : 
			extract($item);
			
			$class = '';
			
			if($index == 0){
				 $class = ' image-first';
			}
			
			$arrkeys  = array_keys($data);
			
			if($index == end($arrkeys) ){
				 $class = ' image-last';
			}
			
		?>
			
			<div class="image<?= $class ?>" data-href="#" data-click="0">
				<div class="slider-item">
					<div class="item-img-1" data-src="<?= $img1_url ?>"></div>
					<div class="item-img-2" data-src="<?= $img2_url ?>"></div>
				</div>
				<div class="image-text"><?= $description ?></div>
			</div>
		
		<?php endforeach ?>
	</div>
</section>