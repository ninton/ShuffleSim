<?php
	$name = sprintf( '%s_%s_t%s.png', $sim['Sim']['shuffle_name'], $sim['Sim']['shuffle_params'], $sim['Sim']['trial_num']);
?>
<img src="<?php echo Router::url(array('action' => 'result_img_png', $sim['Sim']['id'], $name)); ?>" width="104" height="104" />
