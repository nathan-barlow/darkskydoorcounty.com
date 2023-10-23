
<?php
get_header();
?>
<div>
    <main>
        <nav id="nav-posts" class="center">
            <ul class="categories">
                <li class="cat-item">
                    <a aria-current="page" href="/nearby">View All</a>
                </li>
                <?php
                    // attraction types
                    foreach( get_terms('attraction-type') as $type) {
                        echo "<li><a href='/attraction-type/" . $type->slug . "'>" . $type->name . "</a></li>"; }
                    // locations
                    foreach( get_terms('location') as $location) {
                        echo "<li><a href='/location/" . $location->slug . "'>" . $location->name . "</a></li>"; }
                    // tags
                    foreach( get_terms('post_tag') as $tag) {
                        echo "<li><a href='/tag/" . $tag->slug . "'>" . $tag->name . "</a></li>"; } ?>
                </ul>
        </nav>

        <section class="section-post">
            <div class="wrapper">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                $post_id = get_the_ID();
                $date = get_field( 'date' );
                $tags = get_the_tags();
                $dd = get_field( 'driving_distance' );
                $map = get_field( 'maps_link' );
                $website = get_field( 'external_website' );
                $latlng = get_field( 'latlng' );
                $location_name = get_the_terms(get_the_ID(), 'location')[0]->name;
                $location_slug = get_the_terms(get_the_ID(), 'location')[0]->slug; ?>

                <div class="grid grid-2 post">
                    <?php if (has_post_thumbnail()) { ?>
                        <figure class="post-figure">
                            <? the_post_thumbnail('card-large'); ?>
                            <figcaption>
                                <? the_post_thumbnail_caption(); ?>
                            </figcaption>
                        </figure>
                    <? }; ?>
                    <div class="post-content">
                        <h1><?php the_title(); ?></h1>

                        <?php if ($date) { ?>
                            <h3><? echo $date ?></h3>
                        <? } ?>
                        
                        <?php if( $tags ) { ?>
                        <div class="tags">
                            <?php foreach ($tags as $tag) { ?>
                                <a href="<? echo get_tag_link($tag->term_id); ?>"><? echo $tag->name; ?></a>
                            <?}?>
                        </div>
                        <?php } ?>
                        
                        <div class="post-meta">
                            <?php 
                                if($dd) { ?>
                                    <i class="bi bi-car-front-fill"></i>
                                    <p>
                                        <? echo $dd ?>
                                    </p>
                                    <?php
                                };
                            ?>
                            <?php // SHORTEN WEBSITE
                                $valid_website = true;
                                // if http in link, set position. otherwise position = 0
                                $http = strpos($website, "//");
                                if ($http) {
                                    $http += 2;
                                }
                                // display website link without https://
                                $website_trim = substr($website, $http);
                                // display website without trailing links
                                $website_clean = substr($website_trim, 0, strpos($website_trim, "/"));

                                if ($valid_website && $website_clean && $dd) { ?>
                                    <p> &bull; </p>
                                <? }; ?>
                                <? if ($valid_website && $website_clean) { ?>
                                    <a href="<? echo $website ?>" target="_blank"><? echo $website_clean ?></a>
                                    <?php
                                };
                            ?>
                        </div>
                        <p>
                            <?php the_content(); ?>
                        </p>
                        <?php
                            if ($map) { ?>
                                <a class="button" href="<? echo $map ?>" target="_blank">Get Directions</a>
                                <?php
                            };
                        ?>
                    </div>
                </div>
            <?php endwhile; else: ?>
            <section class="card-section">
                <p class="card-section-excerpt"><?php _e( 'Sorry, no posts matched your criteria!' ); ?></p>
            </section>
            <?php endif; ?>
            </div>
        </section>

        <? if( $latlng ) { ?>
        <section class="center">
            <div class="wrapper">
                <h3>Location</h3>
                <div id="map" class="post-map">
                    <?php include('template-parts/map-js-post.php') ?>
                </div>
            </div>
        </section>
        <? } ?>
        

        <section class="lightblue center other-posts">
            <?php previous_post_link( '%link', '<i class="bi bi-arrow-left"></i> %title' ); ?>
            <?php next_post_link( '%link', '%title <i class="bi bi-arrow-right"></i>' ); ?>
        </section>

        <?php $args = new WP_Query(array(
            'location' => $location_slug,
            'post__not_in' => array($post_id),
        ));
        if( $location_slug ) :
            if ( $args->have_posts() ) : ?>
        <section class="lightblue center">
            <div class="wrapper">
                <h2>Other Attractions in <?php echo $location_name ?></h2>

                <ol class="cards grid grid-3">
                    <?php while ( $args->have_posts() ) : $args->the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile; ?>
                </ol>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>
    </main>
</div>

<?php
get_footer( 'stickynav' );
?>
