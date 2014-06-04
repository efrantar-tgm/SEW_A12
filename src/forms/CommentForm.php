<?php
echo '
	<br />
	<h3>Kommentare</h3>
	<br />';

	$comments = CommentQuery::create()
		->filterByEventid($this->event->getId())
		->orderByPosttime()
		->find();
    		
	foreach($comments as $c){
		echo'
		<div class="panel panel-info">
			<div class="panel-heading">
				<b>'.$c->getUsername().'</b> 

				<span style="float: center;">
					<small>'.$c->getPosttime().'</small>
				</span>';
		if($c->getUsername()== $this->user->getName() || $this->event->getRole($this->user)== Event::ORGANIZER){
			echo'<span style="float: right;">
				<button class="btn btn-link" style="padding: 0;" type="button" onClick="handleRemoveComment('.$c->getId().')">
				<span class="glyphicon glyphicon-remove" style="color: d2322d;"></span>
				</span>';
		}
			echo '	
			</div>
			<div class="panel-body">'.$c->getContent().'</div>
		</div>';
	}


echo'
	<hr>
	<textarea id="content" class="form-control" rows="3" placeholder="Enter your comment"></textarea>
	<br />
	<button type="button" class="btn btn-default" onClick="postComment()">Post</button>';
?>


