<h2>Viewing <span class='muted'>#<?php echo $tag->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $tag->name; ?></p>

<?php echo Html::anchor('tag/edit/'.$tag->id, 'Edit'); ?> |
<?php echo Html::anchor('tag', 'Back'); ?>