<?php 
// print_r(get_sub_field('content_block_type'));
if (have_rows('content_block_type')) {
    while (have_rows('content_block_type')) {
        the_row();
        // print_r(get_sub_field('single_post_item'));
       
        $fc = get_row_layout();

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
                get_template_part( 'blocks/content-blocks', 'link-block' );
                break;
            case 'accordion':
                echo 'play the accordion';
                break;
            case 'layout_post_card':
                get_template_part( 'blocks/content-blocks', 'post-card' ); 
                break;
            default:
                echo "default case : No Content Found";
                break;
        }
        
    }
}

wp_reset_postdata();
// update content block files to use have_rows()
?>