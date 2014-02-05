<div id="person-add-container" class="content-category-container">
    <div class="category-inner-container">
        <div class="category-inner-left hidden-phone">
            <?php
            $this->view('help/person_about');
            ?>
        </div>
        <h1 class="visible-phone"><i class="fa fa-user"></i> Add Person</h1>
        <div class="category-inner-right">
            <form action="post">
                <fieldset  class="add-inputs">
                    <div class="ui-widget">
                        <label for="person-name">Name: </label>
                        <input id="person-name" />
                    </div>
                    <div class="ui-widget">
                        <label for="person-default">Default: </label>
                        <input id="person-default" type="checkbox"/>
                    </div>
                    <div class="ui-widget">
                        <label for="person-note">Note: </label>
                        <textarea id="person-note"></textarea>
                    </div>
                    <div id='add-person-submit' >
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div id="person-grid"></div>
</div>

<div id="person-response"></div>
<script>
    require(["modules/person"], function(person) {
        person.add();
        person.inventory();
    });
</script>
