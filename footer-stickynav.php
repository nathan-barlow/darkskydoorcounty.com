
    <footer class="darkblue">
        <div class="grid grid-3">
            <div class="footer-main">
                <img src="/wp-content/themes/darkskydoorcounty.com/images/darkskylogo.svg" alt="Dark Sky logo (outline of Europe Lake)">

                <div>
                    <a href="/">
                        &copy; <?php echo date('Y') . " "; bloginfo(' name ');?>
                    </a>
                    
                    <a href="http://www.nathan-barlow.com" target="_blank">
                        Website designed and developed by <u>Nate Barlow</u>
                    </a>

                    <a href="/privacy-policy">
                        Privacy Policy
                    </a>
                </div>
            </div>
            <div class="footer-contact">
                <h3>Contact</h3>

                <ul>
                    <li>
                        <a href="mailto:landinlane920@gmail.com">
                            <i class="bi bi-envelope"></i> landinlane920@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3>Navigate</h3>
                <?php
                            $footer_nav = array(
                                'theme_location' => 'nav-footer',
                                'container' => 'nav',
                                'container_class' => 'nav-footer',
                                'depth' => 2
                            );
                            wp_nav_menu( $footer_nav );
                        ?>
            </div>
        </div>
    </footer>

    <script>
        // When the user scrolls the page, execute myFunction 
        window.onscroll = function() {myFunction()};

        // Get the header
        var header = document.getElementById("nav-posts");

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>

<?php
wp_footer();
?>

</body>

</html>
