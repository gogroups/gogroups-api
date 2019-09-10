<?php $this->load->view('layouts/header'); ?>

<style type="text/css">
    span_error {
        color: red;
    }

    #add_user_image,#edit_user_image
    {
        width:100px;
        height:100px;
    }

    #add_user_image_btn,#edit_user_image_btn
    {
    position:absolute;
    width:100px;
    height:100px;
    margin-left:230px;
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
                            <div class="user_message"> </div>
                            <h4 class="title">User Accounts
                            <span class="pull-right"> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#userAddModal">Add New</a> </span>
                            </h4>
                            
                        </div>
                        <table id="sellerTable" class="display compact">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th style="display:none;">Zip</th>
                                    <th>Contact</th>
                                    <th>No.of groups</th>
                                    <th>Report</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th style="display:none;">Age</th>
                                      
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                    foreach ($users as $user) {    
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $user->name.' ' .$user->lastName; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->location;?></td>
                                    <td style="display:none;"><?php echo $user->zipcode;?></td>
                                    <td><?php echo $user->contact_number;?></td>
                                    <td style="white-space: nowrap;"><a href="<?php echo base_url('group/home?id=').$user->user_id;?>"><?php echo $user->Total; ?></a></td>
                                    <td><?php if($user->comments != ""){?><span class="badge badge-danger" style="color:white;">yes</span><?php } ?></td>
                                    <td><?php 
                                           if($user->Status==1)
                                           {
                                            echo "Approved";
                                           }
                                            else
                                            {
                                                echo  "Rejected";
                                            }
                                     ?></td>
                                    <td style="white-space: nowrap;">
                                        <?php if($user->Status == 0 || $user->Status == 2){ ?>
                                        <a href="#" id="<?php echo $user->user_id; ?>" class="approve_user fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a>|<?php } else { ?><a href="#" id="<?php echo $user->user_id; ?>" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" class="reasonReject fa fa-times"></a> |<?php } ?>   <a href="#" id="<?php echo $user->user_id; ?>" title=""  data-toggle="modal" data-target="#sellerModal" class="user_profile fa fa-bars"> </a> | 
                                        <a href="#" id="<?php echo $user->user_id ?>" title="" class="edit_user_view fa fa-pencil"> </a> | 
                                        <a href="<?php echo base_url('userController/delete/').$user->user_id;?>" onclick="return confirm('Are you sure you want to Remove?');" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="fa fa-trash-o"></a>
                                    </td>
                                    <td style="display:none;"><?php echo $user->age;?></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                             <tfoot>
                                <tr>
                                     <th></th>
                                    <th><input type="text" style="width:100%;" placeholder="Full Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Email"></th>
                                      <th><input type="text" style="width:100%;" placeholder="Location"></th> 
                                    <th style="display:none;"></th>
                                     <th><input type="text" style="width:100%;" placeholder="Contact"></th>
                                      <th><input type="text" style="width:100%;" placeholder="No.of groups"></th>
                                       <th><input type="text" style="width:100%;" placeholder="Report"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Status"></th>
                                    <th></th>
                                    <th style="display:none;"></th>
                                      
                                </tr>
                            </tfoot>
                        </table>
                        <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })</script>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="modal fade" id="rejectPop" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <form action=""  method="post" id="RejectUser">
                                <input type="hidden" name="user_id" id="user_id" value=""/>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Reject Reason</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">Reason:</div>
                                    <div class="col-md-6"s><input type="text" name="reason"/></div>
                                </div>
                                

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                

                <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="sellerModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 128%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">User Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" id="user_image" style="height: 50px;width: 50px; "/></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3" id="full_name"></div>
                                    <div class="col-md-3">Age:</div>
                                    <div class="col-md-3" id="age"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3" id="contact"></div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3" id="location"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3" id="email"></div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3" id="zipcode"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Paytm No:</div>
                                    <div class="col-md-3" id="paytm_no"></div>
                                   
                                </div>

                                <div class="row" style="display: none" id="report_div">
                                    <div class="col-md-3">Report:</div>
                                    <div class="col-md-9">
                                    <ul id="reports">
                                        
                                    </ul>
                                        
                                    
                                    </div>
                                    
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                
                <div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="userAddModal">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('UserController/insert');?>" method="post" id="AddUser" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">User Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="add_user_image_btn" name="user_image" onchange="readURL(this);" /> 
                                       <img class="img-circle __user_image" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="add_user_image" name="user_image_1"/>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="full_name"/></div>
                                    <div class="col-md-3">Age:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="age"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3">
                                    <div>
                                        <input type="text" class="col-md-5 col-sm-2 col-xs-2" name="country_code" value="91">
                                        <input type="text" class="col-md-7 cols-m-8 col-xs-8" name="contact"/></div>
                                    </div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="location"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="email"/></div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="zipcode"/></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Paytm No:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="paytm_no"/></div>
                                </div>
                               

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                 <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userEditModal">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('UserController/update');?>" method="post" id="EditUser" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">User Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="edit_user_image_btn" name="user_image" onchange="readURL(this);" /> 
                                       <img class="img-circle __user_image" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="edit_user_image" name="user_image_1"/>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3"><input type="text" id="edit_user_full_name" class="col-md-12" name="full_name"/></div>
                                    <div class="col-md-3">Age:</div>
                                    <div class="col-md-3"><input type="text" id="edit_user_age" class="col-md-12" name="age"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3"><input type="text" id="edit_user_contact" class="col-md-12" name="contact"/></div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" id="edit_user_location" name="location"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3"><input type="text" id="edit_user_email" class="col-md-12" name="email"/></div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3"><input type="text" id="edit_user_zip_code" class="col-md-12" name="zipcode"/></div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-3">Paytm No:</div>
                                    <div class="col-md-3"><input type="text" class="col-md-12" name="paytm_no" id="edit_user_paytm_no" /></div>
                                </div>

                                <input type="hidden" name="user_id" value="" id="__user_id">
                                <input type="hidden" id="__edit_user_image" name="profile_img" value="">

                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>


                <div class="clearfix"> </div>
            </div>
        </div>

<?php $this->load->view('layouts/footer'); ?>
<?php $this->load->view('assets/userindex'); ?>