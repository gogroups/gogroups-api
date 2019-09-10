

<?php $this->load->view('layouts/header'); ?>

<body class="cbp-spmenu-push">
    <div class="main-content">

        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="main-page login-page ">
                    <h3 class="title1">SignIn Page</h3>
                    <?php  if($this->session->flashdata('message'))
                    { ?>
                         <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                    <?php  } ?>
                    <div class="widget-shadow">

                        <div class="login-top">
                            <h4>Welcome back to GoGroup AdminPanel. </h4>
                        </div>
                        <div class="login-body">
                            <form action="<?php echo base_url('admin/admin_login_check')?>" id="admin_login" method="post">
                                <input type="text" class="user" name="email" placeholder="Enter your email" required="">
                                <input type="password" name="password" class="lock" placeholder="password">
                                <input type="submit" name="Sign In" id="admin_login_submit" value="Sign In">
                                <div class="forgot-grid">

                                    <div class="forgot">
                                        <a href="#">forgot password?</a>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-2"></div>


    </div>

    <!-- Classie -->
    <script src="<?php echo base_url('public/js/classie.js') ?>"></script>

    <!--scrolling js-->
    <script src="<?php echo base_url('public/js/jquery.nicescroll.js') ?>"></script>
    <script src="<?php echo base_url('public/js/scripts.js') ?>"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('public/js/bootstrap.js') ?>"> </script>
</body>
</html>