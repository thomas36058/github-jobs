<?php 
/**
 * Template name: Home Page
 */

$args_jobs = array(
    'post_type' =>  'jobs',
    'posts_per_page'    =>  2,
    'paged' => ( get_query_var('page') ? get_query_var('page') : 1),
);
$jobs = new WP_Query($args_jobs);

$cities = get_terms( [ 'taxonomy' => 'cities' ] );

$times = get_terms( [ 'taxonomy' => 'times' ] );

get_header(); 
?>

<div class="content">
    <div class="container">
        <div class="hero">
            <div class="hero_form">
                <span class="material-icons">work</span>
                <input type="text" id="jobSearch" placeholder="Title, companies, expertise or benefits">
                <button id="jobSearchButton">Search</button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4">
                <?php if( $times ) : ?>
                    <div class="all_times">
                        <div class="time_item">
                            <input class="checkbox_time" id="full-time" type="checkbox" name="time" value="full-time">
                            <label for="full-time">Full Time</label>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="location_search">
                    <h4>Location</h4>

                    <div class="location_form mb-4">
                        <span class="material-icons">public</span>
                        <input type="text" id="citySearch" placeholder="City, state, zip code or country">
                    </div>

                    <?php if( $cities ) : ?>
                        <div class="all_cities">
                            <?php foreach( $cities as $key => $city ) : ?>
                                <div class="city_item">
                                    <input class="radio_city mr-2" type="radio" name="city" value="<?php echo sanitize_title($city->name); ?>" <?php echo ($key == 1) ? 'checked' : '';?>>
                                    <label class="mb-0" for="<?php echo sanitize_title($city->name); ?>"><?php echo $city->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if( $jobs->have_posts() ) : ?>
                <div class="col-12 col-lg-8">
                    <ul id="jobs-list" class="jobs-list">
                        <?php while( $jobs->have_posts()) : $jobs->the_post(); ?>
                            <?php $cities = get_the_terms( $post->ID, 'cities' ); ?>
                            <?php $times = get_the_terms( $post->ID, 'times' ); ?>
                            <li class="job-item searching mb-5">
                                <div class="row">
                                    <div class="col-4 col-sm-2">
                                        <?php $company_image = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>
                                        <img class="img-fluid" src="<?php echo $company_image ?>" alt="<?php echo get_field('company_name') ?>">
                                    </div>
                                    <div class="col">
                                        <div class="job_details h-100">
                                            <p class="company"><?php the_field('company_name') ?></p>
                                            <a href="<?php echo get_permalink() ?>">
                                                <h5 class="title">
                                                    <?php the_title(); ?>
                                                </h5>
                                            </a>
                                            <?php if($times) : ?>
                                                <?php foreach( $times as $time ) : ?>
                                                    <span class="time mb-3" data-time="<?php echo sanitize_title($time->name) ?>"><?php echo $time->name ?></span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div class="location">
                                                <?php foreach( $cities as $key => $city ) : ?>
                                                    <div class="city d-flex">
                                                        <?php if($key == 0) : ?>
                                                            <span class="material-icons mr-1">public</span>
                                                        <?php endif ?>
                                                        <span class="city_name mr-2" data-city="<?php echo sanitize_title($city->name) ?>"><?php echo $city->name ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="date d-flex">
                                                    <span class="material-icons mr-1">schedule</span>
                                                    <span class="date"><?php echo meks_time_ago(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>

                    <div class="pagination">
                        <?php 
                           $total_pages = $jobs->max_num_pages;

                           if ($total_pages > 1){
                       
                               $current_page = max(1, get_query_var('page'));
                       
                               echo paginate_links(array(
                                   'base' => get_pagenum_link(1) . '%_%',
                                   'format' => '/page/%#%',
                                   'current' => $current_page,
                                   'total' => $total_pages,
                                   'prev_text'    => __('prev'),
                                   'next_text'    => __('next'),
                               ));
                           }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata();?>
        </div>
    </div>
</div>

</div>

<?php get_footer(); ?>