<div id="feedback-container" class="content-category-container">
<div class="category-inner-container">
        <div class="category-inner-left hidden-phone">
            <h1><i class="fa fa-comment-o"></i> Feedback</h1>
            We value your feedback as we are doing this for the community at large.   If you have suggests or feed back, you can file a <a href="https://github.com/cfmack/SneezyT/wiki/FAQ#when-reporting-a-bug" target="_blank">bug report</a> or submit add a comment on this form.
        </div>
        <h1 class="visible-phone feedback-phone-header"><i class="fa fa-comment-o"></i> Feedback</h1>
        <div class="category-inner-right">
            <form action="post">
                <fieldset  class="add-inputs">
                    <div class="ui-widget">
                        <textarea id="feedback-comment"></textarea>
                    </div>
                    <div id='feedback-submit' >
                        <button class="btn btn-primary" type="button">Submit</button>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="alert-container">
        <div id="feedback-response" class="alert_response"></div>
</div>
<script>
    require(["modules/feedback"], function(feedback) {
        feedback.initialize();
    });
</script>
