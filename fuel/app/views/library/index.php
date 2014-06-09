<?php if($videos): ?>
 <div class="container">
  <ul class="row">
  <?php foreach ($videos as $video): ?>
	<li class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
	  <?php echo Html::anchor('library/play/' . $video->id, Asset::img("thumbs/" . $video->id . ".png", array('id' => 'logo')) ); ?>
    </li>
  <?php endforeach; ?>
  </ul>
 </div>	
 <br>
 
 <?php echo html_entity_decode($pagination); ?>
 
<?php else: ?>
 
  <p>No Videos in Library</p>

<?php endif; ?>


