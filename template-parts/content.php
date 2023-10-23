<li class="card">
    <a class="card-link" href="<?php the_permalink(); ?>" title="Read More About:  <?php the_title_attribute(); ?>">
        <figure class="card-figure">
            <?php the_post_thumbnail('card-small'); ?>
        </figure>
        <div class="card-text">
            <h3 class="card-title">
                <?php the_title(); ?>
            </h3>
        </div>
        <div class="card-meta">
            <?php 
                $date = get_field( 'date' );
                $dd = get_field( 'driving distance' );

            if($date) { ?>
                <i class="bi bi-calendar-event"></i>
                <p><? echo $date ?></p>
            <? } elseif($dd) { ?>
                <i class="bi bi-car-front-fill"></i>
                <p><? echo $dd ?></p>
            <? } else { ?>
                <p></p>
            <? } ?>
            <i class="bi bi-arrow-right"></i>
        </div>
    </a>
</li>