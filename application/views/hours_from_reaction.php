<div id="hours-from-reaction-controls">
	<h1><i class="fa fa-search"></i> Food Analyzer</h1>
    <h3></h3>
    <div class="panel panel-default">
        <div class="panel-heading">Reaction to Food by Hour</div>
        <div class="panel-body">
        <p>
            This application allows a user to explore relationships between food, reaction, and time.  You need to pick any Reaction (“Vomit”) and hit enter.  The rest of the options are for additional filtering, which I invite you to play with.

            You will be presented with a list of:
            <ol>
                <li>The food consumed</li>
                <li>The times consumed</li>
                <li>The number of times the person had a reaction within the time frame from consuming the food</li>
                <li>The percentage of times the person had a reaction within the time frame from consuming the food</li>
            </ol>
        </p>
        <p>
            Using a view like this, I personally discovered that 90% of the time my son was vomiting within several hours of consuming coconut.   Data can say anything you want it to, so be careful.   This is not meant to be a diagnose but a tool to help pivot the data in ways you might not expect.
        </p>
        </div>
    </div>
	<form action="post">
        <fieldset class="long-inputs">
            <div class="float-left">
                <div class="ui-widget">
                        <label for="hours-from-reaction-type">Reaction Type: </label>
                        <input id="hours-from-reaction-type" value="Vomit" />
                </div>
                <div class="ui-widget">
                    <label for="hours-from-reaction-gap">Time Samples: </label>
                    <input id="hours-from-reaction-gap" value="3"/>
                </div>
                <div class="ui-widget">
                    <label for="hours-from-reaction-initial-hour">Initial Hour: </label>
                    <input id="hours-from-reaction-initial-hour" value="1"/>
                </div>
            </div>
            <div class="float-left">
                <div class="ui-widget">
                    <label for="hours-from-reaction-start-date">Start Date: </label>
                    <input id="hours-from-reaction-start-date" value=""/>
                </div>
                <div class="ui-widget">
                    <label for="hours-from-reaction-end-date">End Date: </label>
                    <input id="hours-from-reaction-end-date" value="<?php echo date("m/d/Y"); ?>"/>
                </div>
                <div class="ui-widget">
                    <label for="hours-from-reaction-food-filter">Filter Food: </label>
                    <input id="hours-from-reaction-food-filter" value=""/>
                </div>
            </div>
            <div class="float-left">
                <div class="ui-widget">
                    <label for="">Min total times eaten: </label>
                    <input id="hours-from-reaction-min-eaten" value="1"/>
                </div>
                <div class="ui-widget">
                    <label for="hours-from-reaction-scale">Sample Rate: </label>
                    <select id = "hours-from-reaction-scale">
                        <option value = "linear" selected>Linear</option>
                        <option value = "quadratic">Quadratic</option>
                        <option value = "exponential">Exponential</option>
                    </select>
                </div>
            </div>
        </fieldset>
		<div id='retrieve-hours-from-reaction-submit'  class="clear">
			<button class="btn btn-primary send" type="button">Submit</button>
            <button class="btn btn-primary download" type="button">Download</button>
		</div>
	</form>
</div>
<div id="hours-from-reaction-grid"></div>
<script>
  	require(["modules/hour-reaction"], function(reaction) {
        reaction.initialize();
    });
</script>
