<div class="alert <?php echo $alert; ?>">
	<a class="close" data-dismiss="alert">×</a>
	<span>
<?php 
if ($result) 
{ 
	echo 'Inserted ' . $name . '(id: ' . $result . ')';
}
else
{
	echo 'Unable to save this type. Try another type';
}
?>
	</span>
</div>