<!--footer-->
    <div class="footer">
            <p>&copy; 2017 GoGroup Admin Panel. All Rights Reserved </p>
    </div>
<!--//footer-->
    </div>
   <!-- Classie -->
    <script src="<?php echo base_url('public/js/classie.js') ?>"></script>
   
    <script>




        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function () {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };


        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="<?php echo base_url('public/js/jquery.nicescroll.js') ?>"></script>
    <script src="<?php echo base_url('public/js/scripts.js') ?>"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('public/js/bootstrap.js') ?>"> </script>

    
</body>
</html>