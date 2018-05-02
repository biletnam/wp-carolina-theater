<?php
// $content = get_sub_field('content_block_type')[0]['panel_content'];
// print_r(get_sub_field('panel_content'));
$content = get_sub_field('panel_content');
?>

<div style='background-color: darkseagreen;'>
    <div class="hero-slider" >
    <?php
    foreach($content as $c) {
        $media_type = $c['media_type'];
        switch ($media_type) {
            case 'image_upload':
                ?>
                <div>
                    <img src="<?php echo $c['image']['url'];?>" alt="poster" />
                </div>
                <?php
                break;
            case 'video_link':
                ?>
                <div style="height: 250px; width: 250px; overflow: hidden">
                    <?php echo $c['iframe_text']; ?>
                </div>
                <?php
                break;
            case 'wysiwyg';
                ?>
                <div>
                    <?php echo $c['wysiwyg_editor']; ?>
                </div>
                <?php
                break;
            case 'default':
                ?>
                <div>
                    <?php echo "No Content Found"; ?>
                </div>
                <?php
                break;
        }
    }
    ?> 
    </div>
</div>
