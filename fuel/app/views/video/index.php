<h2>Listing <span class='muted'>Videos</span></h2>
<br>
<?php if ($videos): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Filename</th>
			<th>Extension</th>
			<th>Duration</th>
			<th>Width</th>
			<th>Height</th>
			<th>Directory</th>
			<th>Thumbnail</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($videos as $item): ?>		<tr>

			<td><?php echo $item->filename; ?></td>
			<td><?php echo $item->extension; ?></td>
			<td><?php echo $item->duration; ?></td>
			<td><?php echo $item->width; ?></td>
			<td><?php echo $item->height; ?></td>
			<td><?php echo $item->directory; ?></td>
			<td><?php echo $item->thumbnail; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('video/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('video/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('video/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Videos.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('video/create', 'Add new Video', array('class' => 'btn btn-success')); ?>

</p>
