<?php 
App::uses('ShuffleSim', 'ShuffleSim.Lib');
?>
<div class="sims view">
<h2><?php echo __('ShuffleSim'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shuffleSim['ShuffleSim']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($shuffleSim['ShuffleSim']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trial Num'); ?></dt>
		<dd>
			<?php echo h($shuffleSim['ShuffleSim']['trial_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Name'); ?></dt>
		<dd>
			<?php echo h($shuffleSim['ShuffleSim']['shuffle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Params'); ?></dt>
		<dd>
			<?php echo h($shuffleSim['ShuffleSim']['shuffle_params']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Index'); ?></dt>
		<dd>
			<?php echo nl2br(h($shuffleSim['ShuffleSim']['shuffle_index'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Img Png'); ?></dt>
		<dd>
			<?php echo $this->element('img_png', array('shuffleSim' => $shuffleSim)); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result Data'); ?></dt>
		<dd>
			See $shuffleSim['ShuffleSim']['data'])
			&nbsp;
		</dd>
		</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Sim'), array('action' => 'delete', $shuffleSim['ShuffleSim']['id']), null, __('Are you sure you want to delete # %s?', $shuffleSim['ShuffleSim']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sims'), array('action' => 'index')); ?> </li>
	</ul>
</div>
