<h1>
Blog posts
</h1>

<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Created</th>
	</tr>
	
	<?php
	foreach($posts as $post){
	?>
		<tr>
			<td><?php echo $post['Post']['id']; ?></td>
			<td>
				<?php echo $html->link($post['Post']['title'], "/posts/view/".$post['Post']['id']); ?>
			</td>
			<td>
				<?php echo $html->link('Delete', '/posts/delete/'.$post['Post']['id'], null, 'Are you sure?'); ?>
				<?php echo $html->link('Edit', '/posts/edit/'.$post['Post']['id']); ?>
			</td>
			<td><?php echo $post['Post']['created']; ?></td>
		</tr>
	<?php
	}
	?>

</table>
