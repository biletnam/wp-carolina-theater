<?php
$popup = get_sub_field('popup_overlay');

for($i = 0; $i < count($popup); $i++) {
    $pop = $popup[$i];
    $media = $pop['media_type'];

    if ($media == 'image_upload') {
    ?>
        <a href="<?php echo $pop['image']['url'];?>" data-featherlight>
            <img src="<?php echo $pop['image']['sizes']['medium']; ?>" alt="anime poster" />
        </a>
    <?php
    } else if ($media == 'video_link') {
    ?>   
        <a href=".inline" data-featherlight>
            <img src="<?php echo $pop['video']['preview_image']['sizes']['medium'];?>" alt='anime preview' />
        </a>
        <div style="overflow: hidden;" class="inline"><?php echo $pop['video']['iframe_text']; ?></div>
    <?php
    }
}
// if ( have_rows($popup) ) {
//     while ( have_rows($popup) ) {
//         the_row();

//         print_r(get_sub_field('popup_overlay'));
//     }
// }
?>


<!-- <a href="http://farm5.staticflickr.com/4069/4563624740_93430bb907_b.jpg" data-featherlight>Nice image</a> -->

<!-- <hr> 

<a href=".inline" data-featherlight>Inline</a>

<div class="inline">Hello, world</div>

<hr> -->

<!-- <h3>Gallery</h3>
<div data-featherlight-gallery data-featherlight-filter="a">
  <a href="http://farm8.staticflickr.com/7070/6874560581_dc2b407cc0_b.jpg"><img src="http://farm8.staticflickr.com/7070/6874560581_dc2b407cc0_q.jpg" /></a>
  <a href="http://farm5.staticflickr.com/4005/4400559493_3403152632_o.jpg"><img src="http://farm5.staticflickr.com/4005/4400559493_f652202d1b_q.jpg" /></a>
  <a href="http://farm1.staticflickr.com/174/396673914_be9d1312b1_o.jpg"><img src="http://farm1.staticflickr.com/174/396673914_be9d1312b1_q.jpg" /></a>
</div>  -->