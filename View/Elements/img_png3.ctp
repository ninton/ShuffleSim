<?php
	$name = sprintf( '%s_%s_t%s_img3.png', $sim['Sim']['shuffle_name'], $sim['Sim']['shuffle_params'], $sim['Sim']['trial_num']);
?>
<img src="<?php echo Router::url(array('action' => 'img_png3', $sim['Sim']['id'], $name)); ?>" width="104" height="104" />
