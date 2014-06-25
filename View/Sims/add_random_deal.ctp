<div class="sims form">
<?php echo $this->Form->create('Sim'); ?>
	<fieldset>
		<legend><?php echo __('Add Random Deal'); ?></legend>
	<?php
		echo $this->Form->input('trial_num', array('default' => 1));
		echo $this->Form->hidden('shuffle_name', array('default' => 'random_deal'));
		echo $this->Form->input('block_num', array('default' => 10));
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
