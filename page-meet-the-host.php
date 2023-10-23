<?php
get_header();
?>
<div class="meet-the-host">
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="meet-the-host">
            <div class="wrapper grid grid-2">
                <div class="about-content">
                    <?php the_content(); ?>
                </div>
                <figure class="about-image">
                    <?php the_post_thumbnail('card-tall'); ?>
                </figure>
            </div>
        </section>
        <?php endwhile; else: endif; ?>
    </main>
</div>

<?php
get_footer();
?>
