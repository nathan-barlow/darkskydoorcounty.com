
<?php
get_header();
?>
<div class="main-content">
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section>
            <div class="wrapper">
                <h1 class="card-section-title"><?php the_title(); ?></h1>

                <div class="page">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php endwhile; else: endif; ?>
    </main>
</div>

<?php
get_footer();
?>
