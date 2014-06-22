<?php
    $this->view('metadata');
?>
<div id="new-to-sneezy-container">
    <div class="navbar" style="">
        <div class="navbar-inner">
            <div class="container" >
                <a class="brand" href="<?php echo base_url();?>">Sneezy T</a>
            </div>
        </div>
    </div>
    <div class="new-to-sneezy-inner-container">
        <div id="new-to-sneezy-about">
            <?php
                $this->view('help/logon_about');
            ?>
        </div>
        <div class="outer-center">
            <div class="inner-center">
                <button id="new-to-sneezy-enroll" class="btn btn-success" type="button">Join our community</button>
            </div>
        </div>
    </div>
</div>
<script>
    // kicking it old school as require.js settings are screwed up prior to log in
    var b = document.getElementById("new-to-sneezy-enroll");
    b.onclick = function () {
        window.location.replace(base_url + 'index.php/auth/create_user');
    };
</script>