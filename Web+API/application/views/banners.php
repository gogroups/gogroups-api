<?php $this->load->view('layouts/header'); ?>

<style type="text/css">
   
     .gallery_btn
    {
        margin: 5px;
        height: 40PX;
        float: right;
        width: 40px;
       
        /*background-color: grey;*/
        background-image: url('../public/images/add_adv.jpg');
        background-size: 40px 40px;
         
    }
    .gallery_btn_text
    {
        position:absolute;
        padding-left:250px;
        margin-top:60px;
    }

    #add_banner_image_btn
    {
        position:absolute;
        width:50px;
        height:50px;
        margin-left:513px;
        margin-top:3px;
        z-index:10;
        opacity:0;
    }

     .session_message
    {
     border: 1px solid;
    margin: 10px 0px; 
    padding:15px 10px 15px 50px; 
    color: #00529B; 
    background-repeat: no-repeat;
    background-position: 10px center; font-size:1.3em;
     background-color: #BDE5F8;
    background-image: url('../public/images/info.png'); 
    background-size: 30px 30px;   
    }


</style>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
            <?php $this->load->view('layouts/sidebar'); ?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section ">
            <div class="header-left">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <!--logo -->
                <div class="logo">
                    <a href="<?php echo base_url('admin/home');?>">
                        <h1>GoGroup</h1>
                        <span>AdminPanel</span>
                    </a>
                </div>
                <!--//logo-->
                <!--search-box-->
                <!--//end-search-box-->
                <div class="clearfix"> </div>
            </div>
            <div class="header-right">
                <div class="profile_details_left">
                    <!--notifications of menu start -->

                    <div class="clearfix"> </div>
                </div>
                <!--notification menu end -->
                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="<?php echo base_url('public/images/a.png') ?>" alt=""> </span>
                                    <div class="user-name">
                                        <p><?php echo $_SESSION['user_name']; ?></p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                <li> <a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //header-ends -->
        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                
                
                <div class="row">
                           <?php  if($this->session->flashdata('message'))
                    { ?>
                         <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                <?php  } ?>
                   
                    <div class="col-md-12 stats-atinder widget-shadow">
                        <div class="stats-title">
                            <h4 class="title">Banners
                            <span class="pull-right"> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#bannerAddModal">Add New</a> </span>
                            </h4>
                            
                        </div>
                        <table id="bannerTable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Banner</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=1; 
                                foreach($banners as $banner) {?>
                                <tr id= "<?php echo $banner->ID; ?>"> 
                                    <td scope="row"><?php echo $i++; ?></td>
                                    <td scope="row"><img src="<?php echo  base_url('bannerImage/'.$banner->image_name); ?>"></td>
                                    <td scope="row"><a href="<?php echo base_url('admin/delete_banner/').$banner->ID;?>" onclick="return confirm('Are you sure you want to Remove?');" title="" data-placement="top" data-original-title="Delete" class="fa fa-trash-o" ></a></td>
                                  

                                </tr>
                                <?php } ?>
                                                              
                            </tbody>

                          
                        </table>
                        <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })</script>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                 <div class="modal fade" id="bannerAddModal" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content" >
                            <form action="<?php echo base_url('Admin/banner_insert');?>"  method="post" id="RejectSeller" enctype="multipart/form-data">
                                
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Banner</h4>
                            </div>
                            <div class="modal-body">

                                 <div class="row">
                                    <center>
                                       <input type="file" multiple id="add_banner_image_btn" name="banner_image" required>
                                       <div class="gallery_btn"></div><span class="gallery_btn_text">Add Image</span>
                                        <div class="gallery">
                                           
                                        </div>
                                    </center>
                                </div>
                                

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" id="reject_seller">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                

              


                
                <div class="clearfix"> </div>
            </div>
        </div>


<?php $this->load->view('layouts/footer'); ?>

<?php $this->load->view('assets/bannersIndex'); ?>