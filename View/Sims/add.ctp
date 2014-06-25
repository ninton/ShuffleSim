<?php
$options = array(
	'random'      => 'random',
	'cut'         => 'cut',
	'hindu'       => 'hindu',
	'random_deal' => 'random_deal',
	'mix_c_rd'    => 'cut + random_deal', 
	'mix_c_rd_c'  => 'cut + random_deal + cut', 
	'mix_c_hindu_c'  => 'cut + hindu(8,12,5) + cut', 
);
$params = array(
	'type' => 'select',
	'options' => $options,
)
?>
<div class="sims form">
<?php echo $this->Form->create('Sim'); ?>
	<fieldset>
		<legend><?php echo __('Add Sim'); ?></legend>
	<?php
		echo $this->Form->input('trial_num', array('default' => 1));
		echo $this->Form->input('shuffle_name', $params);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sims'), array('action' => 'index')); ?></li>
	</ul>
</div>
