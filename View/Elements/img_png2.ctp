<?php
	$name = sprintf( '%s_%s_t%s_img2.png', $shuffleSim['ShuffleSim']['shuffle_name'], $shuffleSim['ShuffleSim']['shuffle_params'], $shuffleSim['ShuffleSim']['trial_num']);
?>
<img src="<?php echo Router::url(array('action' => 'img_png2', $shuffleSim['ShuffleSim']['id'], $name)); ?>" width="104" height="104" />
