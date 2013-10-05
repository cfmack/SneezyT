<div id="<?php echo $name; ?>-grid" class="grid" ></div>
<script>
    require(["modules/category"], function(category) {
        category.inventory('<?php echo $name; ?>', <?php echo $json; ?>);
    });
</script>
