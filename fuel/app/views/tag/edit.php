<h2>Editing <span class='muted'>Tag</span></h2>
<br>

<?php echo render('tag/_form'); ?>
<p>
	<?php echo Html::anchor('tag/view/'.$tag->id, 'View'); ?> |
	<?php echo Html::anchor('tag', 'Back'); ?></p>
