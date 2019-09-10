<?php $this->load->view('layouts/header'); ?>

<style type="text/css">
    span_error {
        color: red;
    }
    #add_seller_image_btn-error
    {
       position:absolute;
        margin-top:95px;
    }

    #add_seller_image,#edit_seller_image_btn
    {
        width:100px;
        height:100px;
    }

    #add_seller_image_btn,#edit_seller_image_btn
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
                            <h4 class="title">Seller Accounts
                            <span class="pull-right"> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#sellerAddModal">Add New</a> </span>
                            </h4>
                            
                        </div>
                        <table id="sellerTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Full Name</th>
                                    <th>Advertisements Posted</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                     <th style="display:none;">Zipcode</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                      <th style="display:none;">Email</th>
                                       <th style="display:none;">Secondary Name</th>
                                        <th style="display:none;">Secondary Contact</th>
                                         <th style="display:none;">Secondary Email</th>
                                          <th style="display:none;">GST</th>
                                           <th style="display:none;">USP</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=1; 
                                foreach($sellerdata as $seller) {?>
                                <tr id= "<?php echo $seller->user_id; ?>"> 
                                   <td scope="row"><?php echo $i++; ?></td>
                                    <td><?php echo $seller->name. ' ' . $seller->lastName?></td>
                                    <td><a href="<?php echo base_url('advertisement/home?id=').$seller->user_id;?>"><?php echo $seller->Total ?></a></td>
                                    <td><?php echo $seller->seller_companyName ?></td>
                                    <td><?php echo $seller->location ?></td>
                                    <td style="display:none;"><?php echo $seller->zipcode ?></td>
                                    <td><?php echo $seller->contact_number; ?></td>
                                    <td><?php 
                                        if($seller->Status==1)
                                        {
                                            echo "Approved";
                                        }
                                        else
                                        {
                                            echo "Rejected";
                                        }
                                     ?></td>
                                    <td style="white-space: nowrap;">
                                        <?php if($seller->Status == 0 || $seller->Status == 2){ ?>
                                        <a href="#" id="<?php echo $seller->user_id; ?>" class="approve_user fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a>|<?php } else { ?><a href="#"  title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" id="<?php echo $seller->user_id;?>" class="reasonReject fa fa-times"></a> |<?php  } ?>   
                                         <a href="#" id="<?php echo $seller->user_id ?>" title=""  data-toggle="modal" data-target="#sellerModal" class="profile_view fa fa-bars"> </a> |
                                            <a href="#" id="<?php echo $seller->user_id ?>" title="" class="edit_view fa fa-pencil"> </a> | 
                                          <a href="<?php echo base_url('sellerController/delete/').$seller->user_id;?>" onclick="return confirm('Are you sure you want to Remove?');" title="" data-placement="top" data-original-title="Delete" class="fa fa-trash-o" ></a>
                                    </td>

                                   
                                      <td style="display:none;"><?php echo $seller->email; ?></td>
                                       <td style="display:none;"><?php echo $seller->seller_secondary_name; ?></td>
                                        <td style="display:none;"><?php echo $seller->seller_secondary_contact; ?></td>
                                         <td style="display:none;"><?php echo $seller->seller_secondary_email; ?></td>
                                          <td style="display:none;"><?php echo $seller->seller_tinNo; ?></td>
                                           <td style="display:none;"><?php echo $seller->seller_usp; ?></td>

                                </tr>
                                <?php } ?>
                                                              
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input type="text" style="width:100%;" placeholder="Full Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Advertisements Posted"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Company"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Location"></th>
                                     <th style="display:none;"></th>
                                     <th><input type="text" style="width:100%;" placeholder="Contact"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Status"></th>
<th></th>
                                                                       
                                      <th style="display:none;"></th> 
                                       <th style="display:none;"></th>
                                       <th style="display:none;"></th> 
                                       <th style="display:none;"></th>
                                       <th style="display:none;"></th> 
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

                        <div class="modal-content" >
                            <form action=""  method="post" id="RejectSeller" enctype="multipart/form-data">
                                <input type="hidden" name="seller_id" id="seller_id" value=""/>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Reject Seller</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">Reason:</div>
                                    <div class="col-md-6"s><input type="text" name="reason"/></div>
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
                

                <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="sellerModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 128%;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Seller Details</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row-info">
                                    <center><img class="img-circle" src="" id="seller_image" style="height: 50px;width: 50px; "></center>
                                </div>
                                 <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3" id="full_name"></div>
                                    <div class="col-md-3">Company:</div>
                                    <div class="col-md-3" id="company_name"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3" id="contact"></div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3" id="zipcode"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">Email:</div>
                                    <div class="col-md-4" id="email"></div>
                                    <div class="col-md-3">Secondary Name:</div>
                                    <div class="col-md-3" id="secondary_name"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3" id="location"></div>
                                    <div class="col-md-3">Address:</div>
                                    <div class="col-md-3" id="address"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Account Number:</div>
                                    <div class="col-md-3" id="account_number"></div>

                                    <div class="col-md-3">Account Holder Name:</div>
                                    <div class="col-md-3" id="ac_holder_name"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Bank Name:</div>
                                    <div class="col-md-3" id="bank_name"></div>

                                    <div class="col-md-3">Ifsc Code:</div>
                                    <div class="col-md-3" id="ifsc"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Paytm No:</div>
                                    <div class="col-md-3" id="paytm_no"></div>

                                    <div class="col-md-3">GST/PAN:</div>
                                    <div class="col-md-3" id="seller_gst"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Secondary Contact:</div>
                                    <div class="col-md-3" id="secondary_contact"></div>
                                   
                                    <div class="col-md-3">Secondary Email:</div>
                                    <div class="col-md-3" id="secondary_email"></div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3">USP of Seller</div>
                                    <div class="col-md-9" id="seller_usp"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


                <div class="modal fade" id="sellerAddModal" tabindex="-1" role="dialog" aria-labelledby="sellerAddModal">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('sellerController/insert');?>"  method="post" id="AddSeller" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Seller Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="add_seller_image_btn" name="seller_image" onchange="readURL(this);" /> 
                                       <img class="img-circle __seller_profile_pic" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="add_seller_image" name="seller_image_1"/>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3"><input type="text" name="full_name" value="" class="col-md-12"></div>
                                    <div class="col-md-3">Company:</div>
                                    <div class="col-md-3"><input type="text" name="company_name" value="" class="col-md-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3">
                                    <div>
                                        <input type="text" class="col-md-5 col-sm-2 col-xs-2" name="country_code" value="91">
                                         <input type="text" name="contact" value="" class="col-md-7"></div>
                                    </div>
                                  
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3"><input type="text" name="zip_code" value="" class="col-md-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3"><input type="text" name="email" value="" class="col-md-12"></div>
                                    <div class="col-md-3">Secondary Name:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_name" value="" class="col-md-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3"><input type="text" name="location" value="" class="col-md-12"></div>

                                    <div class="col-md-3">Address:</div>
                                    <div class="col-md-3"><input type="text" name="address" value="" class="col-md-12"></div>
                                   
                                </div>
                                

                                 <div class="row">
                                    <div class="col-md-3">Account Number:</div>
                                    <div class="col-md-3"><input type="text" name="account_number" value="" class="col-md-12"></div>

                                     <div class="col-md-3">Accout Holder Name:</div>
                                    <div class="col-md-3"><input type="text" name="ac_holder_name" value="" class="col-md-12"></div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-3">Bank Name:</div>
                                    <div class="col-md-3"><input type="text" name="bank_name" value="" class="col-md-12"></div>
                                    
                                    <div class="col-md-3">Ifsc Code:</div>
                                    <div class="col-md-3"><input type="text" name="ifsc" value="" class="col-md-12"></div>

                                   
                                </div>

                                <div class="row">
                                      <div class="col-md-3">Secondary Contact:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_contact" value="" class="col-md-12"></div>

                                    <div class="col-md-3">Secondary Email:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_email" value="" class="col-md-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Paytm No.:</div>
                                    <div class="col-md-3"><input type="number" name="paytm_no" value="" class="col-md-12"></div>

                                    <div class="col-md-3">GST/PAN:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_gst" value="" class="col-md-12"></div>

                                </div>

                                <div class="row">
                                <div class="col-md-3">USP of Seller</div>
                                    <div class="col-md-9"><input type="text" name="seller_usp" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="add_seller_submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                 <div class="modal fade" id="sellerEditModal" tabindex="-1" role="dialog" aria-labelledby="sellerEditModal">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('sellerController/update');?>"  method="post" id="UpdateSeller" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Seller Details11</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="edit_seller_image_btn" name="seller_image" onchange="readURL(this);" /> 
                                       <img class="img-circle edit_seller_image __seller_profile_pic" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="edit_seller_image" name="seller_image_1" height="100px" widht="100px"/>
                                    </center>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3">
                                        <input type="text" name="full_name" value="" class="col-md-12" id="edit_seller_full_name">
                                    </div>
                                    <div class="col-md-3">Company:</div>
                                    <div class="col-md-3"><input type="text" name="company_name" value="" class="col-md-12" id="edit_seller_company_name"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3"><input type="text" name="contact" value="" class="col-md-12" id="edit_seller_contact"></div>

                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3"><input type="text" name="zip_code" value="" class="col-md-12" id="edit_seller_zip_code"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3"><input type="text" name="email" value="" class="col-md-12" id="edit_seller_email" readonly></div>
                                    <div class="col-md-3">Secondary Name:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_name" value="" class="col-md-12" id="edit_seller_secondary_name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3"><input type="text" name="location" value="" class="col-md-12" id="edit_seller_location"></div>

                                    <div class="col-md-3">Address:</div>
                                    <div class="col-md-3"><input type="text" name="address" value="" class="col-md-12" id="edit_seller_address"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Account Number:</div>
                                    <div class="col-md-3"><input type="text" name="account_number" value="" class="col-md-12" id="edit_seller_account_number"></div>

                                    <div class="col-md-3">Accout Holder Name:</div>
                                    <div class="col-md-3"><input type="text" name="ac_holder_name" value="" class="col-md-12" id="edit_seller_ac_holder_name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Bank Name:</div>
                                    <div class="col-md-3"><input type="text" name="bank_name" value="" class="col-md-12" id="edit_seller_bank_name"></div>
                                    
                                    <div class="col-md-3">Ifsc Code:</div>
                                    <div class="col-md-3"><input type="text" name="ifsc" value="" class="col-md-12" id="edit_seller_ifsc"></div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Secondary Contact:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_contact" value="" class="col-md-12" id="edit_seller_secondary_contact"></div>

                                    <div class="col-md-3">Secondary Email:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_email" value="" class="col-md-12" id="edit_seller_secondary_email" readonly></div>
                                </div>

                                <div class="row">

                                    <div class="col-md-3">Paytm No.:</div>
                                    <div class="col-md-3"><input type="number" name="paytm_no" value="" class="col-md-12" id="edit_seller_paytm_no"></div>

                                    <div class="col-md-3">GST/PAN:</div>
                                    <div class="col-md-3"><input type="text" name="secondary_gst" value="" class="col-md-12" id="edit_seller_gst_pan"></div>

                                   
                                </div>





                                <div class="row">
                                    <div class="col-md-3">USP of Seller</div>
                                    <div class="col-md-9"><input type="text" name="seller_usp" value="" class="col-md-12" id="edit_seller_usp"></div>
                                </div>
                                <input type="hidden" name="seller_id" value="" id="__seller_id">
                                <input type="hidden" id="__edit_seller_image" name="profile_img" value="">

                               


                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="add_seller_submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                
                <div class="clearfix"> </div>
            </div>
        </div>


<?php $this->load->view('layouts/footer'); ?>

<?php $this->load->view('assets/sellerindex'); ?>