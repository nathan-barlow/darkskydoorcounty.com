
<?php
get_header();
?>
<div class="main-content dark-sky-guests">
    <main>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="wrapper center">
            <h1 class="card-section-title"><?php the_title(); ?></h1>
        </div>
        
        <div class="page">
            <?php the_content(); ?>
        </div>
        <?php endwhile; else: endif; ?>
    </main>
</div>

<?php
get_footer();
?>
