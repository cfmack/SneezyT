<div id="doc3" class="yui-t7">
   <div id="bd" role="main">
	   <div class="yui-g">
	     <div id='tl'></div>
	   </div>
	 </div>
</div>

<script>
    require(["modules/timeline"], function(timeline) {
        timeline.initialize('<?php echo date("D F d Y "); ?>');
    });
</script>
