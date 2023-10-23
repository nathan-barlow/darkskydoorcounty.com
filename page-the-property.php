
<?php
get_header();
?>
<div class="the-property">
    <main>
        <form class="need-content nc7" action="https://www.vrbo.com/2891206/" method="get" target="_blank" hidden>

            <label for="adultsCount">adults</label>
            <select name="adultsCount" id="adultsCount">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label for="arrival">arrival</label>
            <input type="date" name="arrival" id="arrival">

            <label for="adultsCount">children</label>
            <select name="adultsCount" id="adultsCount">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>

            <label for="departure">departure</label>
            <input type="date" name="departure" id="departure">

            <input type="hidden" name="unitId" id="unitId" value="3463246">

            <input type="submit">
        </form>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div>
            <div class="page">
                <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; else: endif; ?>

        <script>
            // add map to loading section
            const locationSection = document.getElementById('location');

            locationSection.innerHTML += "<?php include('template-parts/map.php') ?>";
        </script>
    </main>
</div>
<?php
get_footer();
?>
