<h2>Listing <span class='muted'>Tags</span></h2>
<br>
<?php if ($tags): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($tags as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('tag/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('tag/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('tag/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Tags.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('tag/create', 'Add new Tag', array('class' => 'btn btn-success')); ?>

</p>
