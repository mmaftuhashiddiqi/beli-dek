        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->

    <?php
    require ('library/body.php');
    ?>

    <!-- Custom Javascript -->
    <script src="script.js"></script>
    
    <!-- Custom Javascript for sidebar -->
    <script id="rendered-js">
        $(".sidebar-dropdown > a").click(function() {
            $(".sidebar-submenu").slideUp(200);
            if (
                $(this).parent().hasClass("active")) {
                $(".sidebar-dropdown").removeClass("active");
                $(this).
                parent().
                removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this).
                next(".sidebar-submenu").
                slideDown(200);
                $(this).
                parent().
                addClass("active");
            }
        });

        $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
        });
        //# sourceURL=pen.js
    </script>
</body>

</html>