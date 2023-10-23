
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!--favicon-->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/f02135d3e2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.typekit.net/eam5fcg.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"   integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="   crossorigin="anonymous"></script>

    <!-- Splide -->
    <link rel="stylesheet" href="/wp-content/themes/darkskydoorcounty.com/splide/splide.min.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div class="header-content">
            <a class="header-link" href="<?php echo esc_url(home_url()) ?>">
                <img
                    id="custom-header"
                    src="<?php echo get_custom_header()->url; ?>"
                    height="<?php echo get_custom_header()->height; ?>"
                    width="<?php echo get_custom_header()->width; ?>"
                    alt="<?php bloginfo( 'description' ); ?>"
                >
                <h3><?php bloginfo( 'name' ); ?></h3>
            </a>
        </div>

        <input type="checkbox" class="nav-main-menu-toggle" id="nav-main-menu-toggle">
        <label class="nav-main-menu-toggle-icon" for="nav-main-menu-toggle">
            <span></span>
        </label>

        <nav>

            <div class="nav-main-drawer">
                    <!-- Main Menu -->
                    <?php
                    $nav_main_header_top = array(
                        'theme_location' => 'nav-main-header-top',
                        'container_class' => 'nav-main',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 2
                    );
                    wp_nav_menu( $nav_main_header_top );
                ?>
            </div>
        </nav>
    </header>