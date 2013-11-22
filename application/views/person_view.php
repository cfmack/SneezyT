<h1>Add Person</h1>
<div id="person-add-container">
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
<div id="person-grid"></div>
<div id="person-response"></div>
<script>
    require(["modules/person"], function(person) {
        person.add();
        person.inventory();
    });
</script>
