<div class="sims form">
<?php echo $this->Form->create('Sim'); ?>
	<fieldset>
		<legend><?php echo __('Add Hindu'); ?></legend>
	<?php
		echo $this->Form->input('trial_num', array('default' => 1));
		echo $this->Form->hidden('shuffle_name', array('default' => 'hindu'));
		echo $this->Form->input('min_pos'      , array('default' => 4));
		echo $this->Form->input('max_pos'      , array('default' => 20));
		echo $this->Form->input('repeat_num'   , array('default' => 5));
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
