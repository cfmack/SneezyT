<div id="container-<? echo $name;?>" class="content-category-container <? echo ($hide?'hide':'');?>">

	<div class="btn-group button-pane" data-toggle="buttons-radio">
		<?php 
			$keys = array_keys($section);
			$active = 'active';
			foreach($keys as $key)
			{
                $class = '';

                if ($key == 'download')
                {
                    $class = "visible-desktop visible-tablet";
                }

				echo "<button type='button' class='btn btn-mini $active $class category-button' data-role='$key'>$key</button>";
				$active = '';
			}
		?>
	</div>
	<?php 
		$hide = '';
		foreach($section as $key=>$value)
		{
			$html = <<<HTML
			<div class="container-pane-$key content-pane-container $hide">
				$value
			</div>
HTML;
			$hide = 'hide';
			
			echo $html;
		}
	?>
</div>
<script>
    require(["modules/category"], function(category) {
        category.initialize('<?php echo $name; ?>');
    });
</script>
