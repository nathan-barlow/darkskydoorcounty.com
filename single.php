
<?php
get_header();
?>
<div>
    <main>
        <section>
            <div class="wrapper blog-post">
            <?php the_post_thumbnail( 'card-large' );

            $tags = get_the_tags();
            if( $tags ) { ?>
                <div class="tags">
                    <?php foreach ($tags as $tag) { ?>
                        <a href="<? echo get_tag_link($tag->term_id); ?>"><? echo $tag->name; ?></a>
                    <?}?>
                </div>
            <?php }

            echo '<p>Published on: ' . get_the_date() . '</p>';

            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article>
                    <h1><?php the_title() ?></h1>
                    <p><?php the_content() ?></p>
                </article>
            <?php endwhile; else: ?>
            <section class="card-section">
                <p class="card-section-excerpt"><?php _e( 'Sorry, no posts matched your criteria!' ); ?></p>
            </section>
            <?php endif; ?>
            </div>
        </section>

        <section class="lightblue center other-posts">
            <?php previous_post_link( '%link', '<i class="bi bi-arrow-left"></i> %title' ); ?>
            <?php next_post_link( '%link', '%title <i class="bi bi-arrow-right"></i>' ); ?>
        </section>
    </main>
</div>

<?php
get_footer();
?>
