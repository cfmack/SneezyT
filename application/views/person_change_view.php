<h1>Change Person</h1>
<div id="person-change-container">
    <form id="person-change-form" action="post">
        <ul><?php
            foreach($persons as $person)
            {
                echo '<li><input type="radio" value="'. $person['PersonId'] .'" name="persons" ';

                if ($person['PersonId'] == $active['person_id'])
                {
                    echo " checked='checked' ";
                }


                echo '/><span class="person-name">' . $person['PersonName'] . '</span></li>';
            }
            ?>
        </ul>
    </form>
    <div id='change-person-submit' >
        <button class="btn btn-primary" type="button">Update</button>
    </div>
    <div id="person-change-response"  class="alert_response"></div>
</div>
<script>
require(["modules/person"], function(person) {
    person.change();
});
</script>
