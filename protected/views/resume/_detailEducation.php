<blockquote style="margin-left:20px;">
	<button type='button' class='close noSummary' name="deleteItem" idEducation=<?php echo $data->idEducation;?>>×</button>

	<span class='label label-default pull-left'><?php echo $data->startYear." - ".$data->endYear; ?></span>
	<br/>
	<h4 class='list-group-item-heading'><?php echo $data->title; ?></h4>
	<p class='list-group-item-text'><?php echo $data->place; ?></p>
	<footer><?php echo $data->description; ?></footer>
</blockquote>