<?php 
// print_r(get_sub_field('content_block_type'));
$fc = get_sub_field('content_block_type')[0]['acf_fc_layout'];

switch ($fc) {
    case 'default':
        get_template_part( 'blocks/content-blocks', 'wysiwyg' );
        break;
    case 'slider':
        get_template_part( 'blocks/content-blocks', 'slider' );
        break;
    case 'full_width_image':
        get_template_part( 'blocks/content-blocks', 'full-width-image');
        break;
    case 'popup_overlay':
        echo 'popup overlay lightbox!!!!!!!';
        break;
    case 'link_block':
        echo 'link block';
        break;
    case 'accordion':
        echo 'play the accordion';
        break;
    case 'post_card':
        echo 'send a post card';
        break;
    default:
        echo "default case : no valid content type found";
        break;
}
?>