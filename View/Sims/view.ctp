<?php 
App::uses('ShuffleSim', 'ShuffleSim.Lib');
?>
<div class="sims view">
<h2><?php echo __('Sim'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trial Num'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['trial_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Name'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['shuffle_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Params'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['shuffle_params']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shuffle Index'); ?></dt>
		<dd>
			<?php echo nl2br(h($sim['Sim']['shuffle_index'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result Img Png'); ?></dt>
		<dd>
			<?php echo $this->element('result_img_png', array('sim' => $sim)); ?>
			<?php echo $this->element('img_png2', array('sim' => $sim)); ?>
			<?php echo $this->element('img_png3', array('sim' => $sim)); ?>
			<?php echo $this->element('img_png4', array('sim' => $sim)); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Result Data'); ?></dt>
		<dd>
			<?php echo h($sim['Sim']['result_data']); ?>
			&nbsp;
		</dd>
		</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Sim'), array('action' => 'delete', $sim['Sim']['id']), null, __('Are you sure you want to delete # %s?', $sim['Sim']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sims'), array('action' => 'index')); ?> </li>
	</ul>
</div>
