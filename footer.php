
    <footer class="darkblue">
        <div class="grid grid-3">
            <div class="footer-main">
                <img src="/wp-content/themes/darkskydoorcounty.com/images/darkskylogo.svg" alt="Dark Sky logo (outline of Europe Lake)">

                <div>
                    <a href="/">
                        &copy; <?php echo date('Y') . " "; bloginfo(' name ');?>
                    </a>
                    
                    <a href="http://www.natebarlow.me" target="_blank">
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

<?php
wp_footer();
?>

</body>

</html>
