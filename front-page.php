<?php 
/**
 * Template name: Home Page
 */

$args_jobs = array(
    'post_type' =>  'jobs',
    'posts_per_page'    =>  -1
);
$jobs = new WP_Query($args_jobs);

$cities = get_terms( [ 'taxonomy' => 'cities' ] );

$times = get_terms( [ 'taxonomy' => 'times' ] );

get_header(); 
?>

<div class="content">
    <div class="content-wrapper">
        <h1>GithubJobs</h1>

        <?php if( $times ) : ?>
            <div class="all_times">
                <div class="time_item">
                    <input class="checkbox_time" id="full-time" type="checkbox" name="time" value="full-time">
                    <label for="full-time">Full Time</label>
                </div>
            </div>
        <?php endif; ?>

        <?php if( $cities ) : ?>
            <div class="all_cities">
                <?php foreach( $cities as $key => $city ) : ?>
                    <div class="city_item">
                        <input class="radio_city" type="radio" name="city" value="<?php echo sanitize_title($city->name); ?>" <?php echo ($key == 1) ? 'checked' : '';?>>
                        <label for="<?php echo sanitize_title($city->name); ?>"><?php echo $city->name; ?></label>
                    </div>
                <?php endforeach; ?>
                </div>
        <?php endif; ?>

        <input type="text" id="jobSearch" placeholder="Title, companies, expertise or benefits">

        <input type="text" id="citySearch" placeholder="City, state, zip code or country">

        <?php if( $jobs->have_posts() ) : ?>
            <ul id="jobs-list">
                <?php while( $jobs->have_posts()) : $jobs->the_post(); ?>
                    <?php $cities = get_the_terms( $post->ID, 'cities' ); ?>
                    <?php $times = get_the_terms( $post->ID, 'times' ); ?>
                    <li class="job-item">
                        <a href="#"><?php the_title(); ?></a>
                        <?php if($times) : ?>
                            <?php foreach( $times as $time ) : ?>
                                <span class="time" data-time="<?php echo sanitize_title($time->name) ?>"><?php echo $time->name ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php foreach( $cities as $city ) : ?>
                            <p class="city" data-city="<?php echo sanitize_title($city->name) ?>"><?php echo $city->name ?></p>
                        <?php endforeach; ?>
                        
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

</div>

<?php get_footer(); ?>