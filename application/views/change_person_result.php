<div class="alert <?php echo $alert; ?>">
    <a class="close" data-dismiss="alert">×</a>
<?php
    if ($result)
    {
        echo "Changed";
    }
    else
    {
        echo "Unable to change";
    }

?>
</div>