                        </main>
                        <!-- !start #main-site -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</section>


<?php
require('library/body.php');
?>

<!-- Custom Javascript -->
<script src="script.js"></script>

<!-- Custom Javascript for sidebar -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $("#menu-toggle-2").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled-2");
        $('#menu ul').hide();
    });

    function initMenu() {
        $('#menu ul').hide();
        $('#menu ul').children('.current').parent().show();
        //$('#menu ul:first').show();
        $('#menu li a').click(
            function() {
                var checkElement = $(this).next();
                if (checkElement.is('ul') && checkElement.is(':visible')) {
                    return false;
                }
                if (checkElement.is('ul') && !checkElement.is(':visible')) {
                    $('#menu ul:visible').slideUp('normal');
                    checkElement.slideDown('normal');
                    return false;
                }
            }
        );
    }

    $(document).ready(function() {
        initMenu();
    });
    //# sourceURL=pen.js
</script>
</body>

</html>