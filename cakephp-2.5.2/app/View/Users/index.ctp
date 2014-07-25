<h1>All Users</h1>
<?php echo $this->Html->link('Add user', array('controller' => 'users', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Id</th>
		<th>Username</th>
		<th>GroupName</th>
		<th>Created</th>
		<!-- <th>Action</th> -->
	</tr>
	<?php foreach ($users as $user):?>
	<tr>
		<td><?php echo $user['User']['id']; ?></td>
		<td><?php echo $user['User']['username']; ?></td>
		<td><?php echo $user['User']['group_id']; ?></td>
		<td><?php echo $user['User']['created'];?></td>
		<td><?php //echo $this->Form->postLink('Delete', array('action' => 'delete', $user['User']['id']), array('confirm' => 'Are you sure')); ?></td>
	</tr>
	<?php endforeach; ?>
</table>