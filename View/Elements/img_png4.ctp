<?php
	$name = sprintf( '%s_%s_t%s_img4.png', $shuffleSim['ShuffleSim']['shuffle_name'], $shuffleSim['ShuffleSim']['shuffle_params'], $shuffleSim['ShuffleSim']['trial_num']);
?>
<img src="<?php echo Router::url(array('action' => 'img_png4', $shuffleSim['ShuffleSim']['id'], $name)); ?>" width="104" height="104" />
