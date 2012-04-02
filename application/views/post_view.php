<?php foreach ( $results as $results): ?>
<h2><?php echo $results->title; ?></h2>
<p><?php echo $results->username; ?></p>
<p><?php echo $results->first_name . ' ' . $results->last_name; ?></p>
<p><?php echo $results->date; ?></p>
<p><?php echo $results->content; ?></p>
<?php endforeach; ?>



<h3>Comments</h3>
<?php if ($comments): ?>
	<?php foreach ( $comments as $comment): ?>
	<h4><?php echo $comment->title; ?></h4>
	<p><?php echo $comment->username; ?></p>
	<p><?php echo $comment->first_name . ' ' . $results->last_name; ?></p>
	<p><?php echo $comment->date; ?></p>
	<p><?php echo $comment->comment; ?></p>
	<?php endforeach; ?>
<?php else: ?>
	<p>No comments</p>
<?php endif; ?>
