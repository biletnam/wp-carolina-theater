<?php
$link = get_sub_field('content_block_type')[0];

$href = "";
if ($link['link_type'] == 'external_link') {
    $href = $link['external_link'];
} else if ($link['link_type'] == 'internal_link') {
    $href = $link['internal_link'];
}
?>

<div>
    <a href=<?php echo $href;?> style="border: none" target="_blank">
    <?php echo $link['icon']; echo $link['title']; ?>
    </a>
    <p><?php echo $link['description']; ?></p>
</div>