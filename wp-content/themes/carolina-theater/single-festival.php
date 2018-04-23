<?php
get_header();
$content = get_post();
$image_slider = get_field('image_slider');
$hero_images = $image_slider['hero_images'];

?>
<div class="hero-container">
    <div style='background-color: darkseagreen;'>
        <div class="hero-slider">
            <?php
            foreach ($hero_images as $hi) { ?>
                <div>
                    <img src="<?php echo $hi['image']['url']; ?>" alt="" class="hero-slider__image">
                </div>
            <?php
            } ?>
        </div>
    </div>

    <div class="festival-main">
        <section class="festival-content">
            <p class="festival-content__date">
                <i class="fa fa-calendar" aria-hidden="true"></i> 
                <?php echo get_field('start_date') . ' - ' . get_field('end_date'); ?>
            </p>
            <h1><?php the_title(); ?></h1>
            <div class='festival-content__tabs'>
                    <a id="overview" class='tab-link' href="#overview">
                            Overview
                    </a>
                    <a id='films' class='tab-link' href="#films">
                        Films
                    </a>
                    <?php
                        if( have_rows('tabs') ) {
                            while ( have_rows('tabs') ) { 
                                the_row();
                                $tab_name = get_sub_field('tab_name');
                                $id_name = str_replace(' ', '-', $tab_name);
                                $id_name = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $id_name));
                    ?>          
                                <a id="<?php echo $id_name; ?>" class='tab-link' href="#<?php echo $id_name;?>">
                                    <?php echo $tab_name; ?>
                                </a>
                    <?php
                            }
                        }
                    ?>
            </div>

            <div class="festival-content__wrapper">
                <div class='tab-content hide-tab-content overview'>
                    <?php print_r($content->post_content); ?>
                </div>
                <div class='films tab-content hide-tab-content'>
                <?php
                $meta_query_args = array(
                    'post_type' => 'film',
                    array(
                        'key'     => 'associated_events',
                        'value'   => get_the_id(),
                        'compare' => '='
                    )
                );
                $meta_query = new WP_Query( $meta_query_args );
                if ($meta_query->have_posts()) {
                    while ($meta_query->have_posts()) {
                        $meta_query->the_post();
                        echo 'here i am ' . get_the_title();
                    }

                }
                wp_reset_postdata();
                ?>
                </div>
                <?php
                    if( have_rows('tabs') ) {
                        while ( have_rows('tabs') ) { 
                            the_row();
                            $tab_name = get_sub_field('tab_name');
                            $id_name = str_replace(' ', '-', $tab_name);
                            $id_name = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $id_name));
                            $tab_content = get_sub_field('tab_content'); ?>  

                            <div class='<?php echo $id_name ?> tab-content hide-tab-content'><?php echo $tab_content[0]['text_editor']; ?></div>
                <?php
                        }
                    } ?>
            </div>

            <div class="single-film__videos">
                <div class="single-film__videos--one">
                    <?php the_field('video_link_1');?>
                    <p><?php the_field('video_caption_1')?></p>
                </div>
                <div class="single-film__videos--two">
                    <?php the_field('video_link_2');?>
                    <p><?php the_field('video_caption_2')?></p>
                </div>
            </div>
        </section>
        <section class="festival-sidebar">
            <div class='festival-sidebar__btn'>
                <button>Buy Tickets</button>
            </div>
            <div class="festival-sidebar__ticket-info">
                <ul>
                    <li>
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?php echo get_field('start_date') . ' - ' . get_field('end_date'); ?>
                    </li>
                    <li>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php
                            $locations = get_field('location');
                            echo join(', ', $locations);
                        ?>
                    </li>
                    <li>
                        <i class="fa fa-ticket" aria-hidden="true"></i>
                        $12
                    </li>
                </ul>
                <div class="festival-sidebar__links">
                    <h3>Get Involved</h3>
                    <ul>
                        <li>Become a Volunteer >></li>
                        <li>Support the Festival >></li>
                        <li>Contact &amp; Media Kit >></li>
                    </ul>
                </div>
                <div class="upcoming-events__cta-card">
                    <h2>Plan Your Visit >></h2>
                    <p>What to Bring, Where to Eat, Where to Stay, Parking and more...</p>
                </div>
            </div>
            <div class="festival-sidebar__additional-links">
                <ul>
                    <?php
                        $files = get_field('additional_resources');
                        
                        for($i = 0; $i < count($files); $i++) {
                            $file_obj = $files[$i]['file_link'];
                            if ($file_obj['add_file_by'] == "File URL") {
                                $href = $file_obj['file_url'];
                            } else if ($file_obj['add_file_by'] == "Upload a File") {
                                $href = $file_obj['upload_file'];
                            }
                    ?>
                        <li>
                            <a target="_blank" href="<?php echo $href ?>">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <?php echo $files[$i]['file_link']['link_text']; ?>
                            </a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
?>