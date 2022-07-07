<?php

get_header(); ?>

<div id="main-content" class="main-content">

    <div id="single-page" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="container">

                <div class="row">
                    <aside class="col-12 col-lg-3">
                        <div class="back-button">
                            <span class="material-icons mr-1">keyboard_backspace</span>
                            <a href="/">Back to search</a>
                        </div>
                    </aside>

                    <div class="col-12 col-lg-9">
                        <div class="content">
                            <?php while ( have_posts() ) : the_post(); ?>

                                <div class="header">
                                    <div class="title">
                                        <div class="d-flex mb-2">
                                            <h1><?php the_title(); ?></h1>

                                            <?php $times = get_the_terms( $post->ID, 'times' ); ?>
                                            <?php if($times) : ?>
                                                <?php foreach( $times as $time ) : ?>
                                                    <span class="time" data-time="<?php echo sanitize_title($time->name) ?>"><?php echo $time->name ?></span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="date">
                                            <span class="material-icons mr-1">schedule</span>
                                            <span><?php echo meks_time_ago(); ?></span>
                                        </div>
                                    </div>                                   
                                </div>

                                <div class="company d-flex">
                                    <?php $company_image = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>
                                    <img class="img-fluid" src="<?php echo $company_image ?>" alt="<?php echo get_field('company_name') ?>">

                                    <div>
                                        <div class="name"><?php the_field('company_name') ?></div>

                                        <?php $cities = get_the_terms( $post->ID, 'cities' ); ?>
                                        <div class="cities d-flex">
                                            <?php foreach( $cities as $key => $city ) : ?>
                                                <div class="city d-flex">
                                                    <?php if($key == 0) : ?>
                                                        <span class="material-icons mr-1">public</span>
                                                    <?php endif ?>
                                                    <span class="<?php echo (count($key) > 0) ? 'mr-2' : '' ?>" data-city="<?php echo sanitize_title($city->name) ?>"><?php echo $city->name ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-text">
                                    <?php the_content(); ?>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();