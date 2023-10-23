
<?php
get_header();
?>
<div class="home">
    <main>
        <section class="section1 dark center">
            <h2><?php bloginfo( 'description' ); ?></h2>
            <span>
                <a class="button" target="_blank" href="https://www.vrbo.com/2891206?noDates=true&unitId=3463246">Book on Vrbo</a>
            </span>
        </section>

        <section class="section2 darkblue center">
            <div class="wrapper">
                <h2>The Property</h2>
                <p>Nestled in the woods and on the shores of Europe Lake, one of Door County's most secluded and pristine inland lakes, your vacation home provides unobstructed views of the lake, Newport State Park, and the Dark Skies of the "Tip of the Thumb."</p>

                <div class="grid grid-4 grid-amenities">
                    <div>
                        <i class="fa-solid fa-bed"></i>
                        <p>4 bedrooms</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-shower"></i>
                        <p>3 bathrooms</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-compass"></i>
                        <p>Private, secluded location</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-water"></i>
                        <p>Private dock and lake access</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-fire"></i>
                        <p>Outdoor fire pit</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-house-chimney-window"></i>
                        <p>Open-concept living space</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-soap"></i>
                        <p>Washer and dryer</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-fire-burner"></i>
                        <p>Fireplace and wood stove</p>
                    </div>
                </div>

                <a class="button" href="the-property/">More About the Property</a>
            </div>
        </section>

        <section class="section3 nopadding map">
            <div id="map">
                <?php include('template-parts/map-js.php') ?>
            </div>
        </section>

        <section class="section4">
            <div class="wrapper">
                <h2>Beautiful</h2>
                <div class="textbox">
                    <h1>Door County, WI</h1>
                    <p>
                        Dubbed "the Cape Cod of the Midwest" by the Wall Street Journal, Door County lives up to its name as the all-American Great Lakes getaway. With over 300 miles of Lake Michigan shorefront, the peninsula is the perfect vacation destination for water sport enthusiasts and those looking to explore the five sprawling state parks, 19 county parks, dozens of beaches, and thousands of acres of wilderness. The peninsula also boasts waterfront dining, locally grown wineries and breweries, and a vibrant arts and culture scene that rivals any in the Midwest. Welcome to Door County, where you are miles away from anything stressful.
                    </p>
                    <a class="button" href="/nearby">Explore Door County</a>
                </div>
            </div>
        </section>
        
        <section class="section5 lightblue center">
            <div class="wrapper">
                <h2>Nearby Attractions</h2>

                <?php $nearby = new WP_Query(array(
                        'post_type' => 'nearby',
                        'post_status' => 'publish',
                        'posts_per_page' => 3,
                        'post__in' => array( 26, 37, 96 ),
                        'ignore_sticky_posts' => 1,
                    )); ?>
                <ol class="cards grid grid-3">
                    <?php if ( $nearby->have_posts() ) : while ( $nearby->have_posts() ) : $nearby->the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile; ?>
                </ol>
                <?php else: ?>
                <section style="grid-column: 1 / 4" class="card-section">
                    <p class="card-section-excerpt"><?php _e( 'Sorry, no posts yet!' ); ?></p>
                </section>
                <?php endif; ?>

                <a class="button" href="/attraction-type/attractions/">View More Attractions</a>
            </div>
        </section>
        
        <section class="section6 reviews">
            <div class="wrapper">
                
                <h2>Reviews</h2>

                <?php $reviews = new WP_Query(array(
                        'post_type' => 'reviews',
                        'post_status' => 'publish',
                    )); ?>
                <div class="splide" aria-label="Reviews slider">
                    <div class="splide__track">
                        <ul class="splide__list">
                        <?php if ( $reviews->have_posts() ) : while ( $reviews->have_posts() ) : $reviews->the_post(); ?>
                            <li class="splide__slide reviews-slide">
                                <div class="stars stars-<? the_field('stars')?>"></div>
                                <h3><?php echo the_title() ?></h3>
                                <?php the_content() ?>
                                <b><?php echo get_the_date('F Y') ?></b>
                            </li>
                        <?php endwhile; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<script src="/wp-content/themes/darkskydoorcounty.com/splide/splide.min.js"></script>

<script defer>
    var splide = new Splide( '.splide' );
    splide.mount();
</script>

<?php
get_footer();
?>
