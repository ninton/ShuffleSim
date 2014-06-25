<div class="sims index">
	<h2><?php echo __('Sims'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th>
				<?php echo $this->Paginator->sort('trial_num'); ?>
				<?php echo $this->Paginator->sort('shuffle_name'); ?>
				<?php echo $this->Paginator->sort('shuffle_params'); ?>
			</th>
			<th><?php echo $this->Paginator->sort('shuffle_index'); ?></th>
			<th>Img Png</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shuffleSims as $shuffleSim): ?>
	<tr>
		<td><?php echo h($shuffleSim['ShuffleSim']['id']); ?>&nbsp;</td>
		<td>
			<?php echo h($shuffleSim['ShuffleSim']['trial_num']); ?><br />
			<?php echo h($shuffleSim['ShuffleSim']['shuffle_name']); ?><br />
			<?php echo h($shuffleSim['ShuffleSim']['shuffle_params']); ?>
		</td>
		<td nowrap><?php echo nl2br(h($shuffleSim['ShuffleSim']['shuffle_index'])); ?>&nbsp;</td>
		<td nowrap><?php echo $this->element('img_png', array('shuffleSim' => $shuffleSim)); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shuffleSim['ShuffleSim']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shuffleSim['ShuffleSim']['id']), null, __('Are you sure you want to delete # %s?', $shuffleSim['ShuffleSim']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Sim'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Random Deal'), array('action' => 'add_random_deal')); ?></li>
		<li><?php echo $this->Html->link(__('New Cut')        , array('action' => 'add_cut')); ?></li>
		<li><?php echo $this->Html->link(__('New Hindu')      , array('action' => 'add_hindu')); ?></li>
	</ul>
</div>
