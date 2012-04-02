<?php foreach ($posts as $post): ?>
<div id="main_page">
	<h3><?php echo $post->title; ?></h3>
	<p>On <?php echo unix_to_human($post->date); ?> by <?php echo $post->username; ?></p>
	<p><?php echo $post->content;?></p>
	<p><?php echo anchor('main/singlePost/'.$post->tocomments.$post->postid, 
						 'comments('.$post->numberComments.')'); //->num_rows() ?> </p> 
</div>
<hr />
<?php endforeach; ?>

<p><?php echo $this->pagination->create_links(); ?></p>