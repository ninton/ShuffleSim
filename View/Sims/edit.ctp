<div class="sims form">
<?php echo $this->Form->create('Sim'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sim'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('trial_num');
		echo $this->Form->input('shuffle_name');
		echo $this->Form->input('shuffle_params');
		echo $this->Form->input('result_data');
		echo $this->Form->input('result_img_png');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sim.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sim.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sims'), array('action' => 'index')); ?></li>
	</ul>
</div>
