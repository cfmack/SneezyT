<div class="alert <?php echo $alert; ?>">
    <a class="close" data-dismiss="alert">×</a>
<?php
    if ($result)
    {
        echo "Thank you";
    }
    else
    {
        echo "Unable to save feedback";
    }

?>
</div>