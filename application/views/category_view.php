<div id="container-<? echo $name;?>" class="content-category-container <? echo ($hide?'hide':'');?>">
    <div class="category-inner-container">
        <div class="category-inner-left hidden-phone">
        <?php
            $this->view('help/' . strtolower($name) . '_about');
        ?>
        </div>
        <div class="category-inner-right">
            <div class="btn-group button-pane" data-toggle="buttons-radio">
                <?php
                    $keys = array_keys($section);
                    $active = 'active';
                    foreach($keys as $key)
                    {
                        $class = '';

                        $title = $key;
                        if ($key == 'download')
                        {
                            $title = 'export';
                        }
                        $title = ucfirst($title);

                        echo "<button type='button' class='btn btn-mini $active $class category-button' data-role='$key'>$title</button>";
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
    </div>
</div>
<script>
    require(["modules/category"], function(category) {
        category.initialize('<?php echo $name; ?>');
    });
</script>
