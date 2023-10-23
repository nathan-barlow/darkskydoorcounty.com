
<?php
get_header();
?>
<div class="main-content">
    <main>
        <section class="lightblue center">
            <div class="wrapper">
                <h2>
                    Explore Door County
                </h2>
                <p>
                    There's an abundance of activities, restaurants, and attractions near the Dark Sky Lakehouse in Door County. These are some of the best things to do in northern Door County, so be sure to check as many of these off your list as you can. Plan your trips by sorting this list by location or category. If you are still looking for a place to stay during your visit, check out <a href="https://www.vrbo.com/2891206?noDates=true&unitId=3463246">our availability</a>. Our Ellison Bay vacation rental home provides an optimal location in northern Door County for access to Washington Island, hiking trails, and other activities. To see a list of all events going on in Door County, <a href="https://www.doorcounty.com/events?areaId=3&categoryIds=undefined&page=1" target="_blank">click here</a>.
                </p>

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

                <ol id="content" class="cards grid grid-3">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                        get_template_part( 'template-parts/content-excerpt', get_post_format() );
                    endwhile; ?>
                </ol>
                <?php
                the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __( '<i class="bi bi-arrow-left"></i>', 'textdomain' ),
                    'next_text' => __( '<i class="bi bi-arrow-right"></i>', 'textdomain' ),
                ) );
                else: ?>
                <section style="grid-column: 1 / 4" class="card-section">
                    <p class="card-section-excerpt"><?php _e( 'Sorry, no posts yet!' ); ?></p>
                </section>
                
                <?php endif; ?>
            </div>
        </section>
        <section class="center">
            <div class="wrapper">
                <h2>Search the Map</h2>
                <div id="map">
                    <?php include('template-parts/map-js-archive.php') ?>
                </div>
            </div>
        </section>
    </main>
</div>

<?php
get_footer( 'stickynav' );
?>
