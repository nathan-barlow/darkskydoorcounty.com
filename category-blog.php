
<?php
get_header();
?>
<div class="main-content">
    <main>
        <section class="lightblue center">
            <div class="wrapper">
                <h2>
                    <?php
                    if( is_day() ) _e( 'You are viewing posts from ' .  get_the_date());
                    elseif ( is_month() ) _e( 'You are viewing archives for the month of ' . get_the_date( 'F Y' ));
                    elseif ( is_year() ) _e( 'You are viewing the ' . get_the_date( 'Y' ) . ' yearly archives' );
                    elseif ( is_author() ) _e( 'You are viewing ' . get_the_author() . '\'s archives' );
                    else _e( single_cat_title( '', false ) );
                    ?>
                </h2>
                <p>
                    <?php echo category_description() ?>
                </p>

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
    </main>
</div>

<?php
get_footer( 'stickynav' );
?>
