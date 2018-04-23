<?php
get_header();

$id = get_the_id();

$events_query_args = array(
    'post_id' => $id,
);

$events_query = new WP_Query($events_query_args);
// print_r($events_query);
// echo "<br><br>";
$content = get_post($id);
// print_r($content);
// echo $content->post_content;

// get all dates and showtimes
$date_range = get_field('showtimes');

// convert date strings to integers for sorting
$event_dates = array();
for ($i = 0; $i < count($date_range); $i++) {
    $event_date = strtotime($date_range[$i]["dates"]);
    array_push($event_dates, $event_date);
}
// covert to string and pick the min/max
$start_date = date("F d, Y", min($event_dates));
$end_date = date("F d, Y", max($event_dates));
?>
<div class="clearfix">
    <div class="single-event__container">
        <div class="single-event__left-col">
            <section class="single-event__header">
                <p class="single-event__category"><?php echo get_post_type() ?></p>
                <div class="single-event__image">
                    <img src="<?php echo get_field('event_image')["url"]; ?>" alt="the poster for the film">
                    <div class="single-event__image--date"><?php echo $start_date . ' - ' . $end_date ?></div>
                </div>
                <p>The Carolina Theatre Presents...
                <h2 class="single-event__title"><?php echo the_title() ?></h2>
                <p class="single-event__subtitle"><?php echo get_field('event_subtitle') ?></p>
                <br/>
                <div class="single-event__event-info">
                    <ul>
                        <li>
                            <?php 
                            echo '<i class="fa fa-calendar" aria-hidden="true"></i>' . $start_date . ' - ' . $end_date;
                            ?>
                        </li>
                        <li>
                            <?php
                            $locations = get_field('location');
                            echo '<i class="fa fa-map-marker" aria-hidden="true"></i>' . join($locations, ', ');    
                            ?>                    
                        </li>
                    </ul>
                </div>
                <div class="single-event__description"><?php echo $content->post_content; ?></div>
                <div class="single-event__read-more">
                    <hr />
                    <p>Read More</p>
                </div>
                <div class="single-event__videos">
                    <div class="single-event__videos--one">
                        <?php the_field('video_1_link'); ?>
                        <p><?php the_field('video_1_caption') ?></p>
                    </div>
                    <div class="single-event__videos--two">
                        <?php the_field('video_2_link'); ?>
                        <p><?php the_field('video_2_caption') ?></p>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="single-event__sidebar">
        <div class="single-event__sidebar--container">
            <div class="single-event__sidebar--show-info">
                <br>
                <div class="single-event__button"><button>On Sale</button></div>
                <div class="single-event__button"><button>Member Tickets</button></div>
                <?php 
                    $dates = get_field('showtimes'); 
                    for($i = 0; $i < count($dates); $i++) { ?>
                        <ul>
                            <li><?php echo '<i class="fa fa-calendar" aria-hidden="true"></i>' . $dates[$i]["dates"]; ?></li>

                                <?php
                                for($j = 0; $j < count($dates[$i]["times"]); $j++) {
                                    $doors_open = $dates[$i]["times"][$j]["doors_open"];
                                ?>
                                    <li><?php echo '<i class="fa fa-clock-o" aria-hidden="true"></i>Doors Open ' . $doors_open . ' | Showtime ' . $dates[$i]["times"][$j]["time"]; ?>&nbsp;<i class="fas fa-ticket-alt"></i></li>

                                <?php
                                } 
                    }?>
                            <li>
                                <?php 
                                    $prices = get_field('ticket_prices');
                                    $price_vals = array();
                                        foreach($prices as $price=>$cost) {
                                            foreach($cost as $c) {
                                                array_push($price_vals, $c);
                                            }
                                        }
                                    echo '<i class="fa fa-ticket" aria-hidden="true"></i> $' . join($price_vals, ' | ');
                                ?>
                            </li>
                            <li>
                                <?php
                                    echo '<i class="fa fa-map-marker" aria-hidden="true"></i>' . join($locations, ', ');
                                ?>
                            </li>
                        </ul>
            </div>
            
            <div class="single-event__sidebar--social-media">
                <?php
                    $links = get_field("social_media_link");
                    foreach($links as $link) { 
                        ?>
                        <p><?php echo $link["icon"]; ?><a href="<?php echo $link["link_url"]; ?>"><?php echo $link["link_description"]; ?></a></p>
                    <?php    
                    }
                ?>
            </div>
            <div class="single-event__sidebar--ctas">
                <div class="single-event__sidebar--cta-card">
                    <h2>Seating Chart >></h2>
                    <p>See the stage from all angles. There's not a bad seat in the house.
                    </p>
                </div>
                <div class="single-event__sidebar--cta-card">
                    <h2>Plan Your Visit >></h2>
                    <p>What to bring, where to eat, where to stay, where to park and more...
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>