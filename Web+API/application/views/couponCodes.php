
<?php $this->load->view('layouts/header'); ?>
<style type="text/css">
    span_error{
        color: red;
    }

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

    #add_ads_image_btn
    {
        position:absolute;
        width:50px;
        height:50px;
        margin-left:513px;
        margin-top:3px;
        z-index:10;
        opacity:0;
    }

         #edit_ads_image_btn
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

    .no_remarks
    {
        color: #aab7b6;
    }
    #coupons_remarks
    {
        cursor:pointer;
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
                            <h4 class="title">Ads
                                <span class="pull-right"> <a href="#" data-toggle="modal" data-target="#addadsModal" class="btn btn-danger">Add New</a> </span></h4>
                        </div>

                        <div class="row">
                            <div class="col-md-12"> 

                            <div class="col-md-6">
                            <div class="row">
                            <div class="col-md-4">Created Date (From):</div>
                            <div class="col-md-2"><input type="text" id="start_date_starts"  name="min"></div>
                            </div>

                            <div class="row">
                            <div class="col-md-4">Created Date (To):</div>
                            <div class="col-md-2"><input type="text" id="start_date_ends"  name="max"></div>
                            </div>               
                            </div>


                            <div class="col-md-6">
                            <div class="row">
                            <div class="col-md-4">Updated Date (From):</div>
                            <div class="col-md-2"><input type="text" id="end_date_starts" name="min"></div>
                            </div>

                            <div class="row">
                            <div class="col-md-4">Updated Date (To):</div>
                            <div class="col-md-2"><input type="text" id="end_date_ends" name="max"></div>
                            </div>                
                            </div>

                            </div>

                            <a href="#" id="clear" class="pull-right">Clear Filters</a>

                            </div>


                        <table id="couponCodeTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Coupon Code</th>
                                    <th>Advertisement Name</th>
                                    <th>Seller Name</th>
                                    <th>Buyer Name</th>
                                    <th>Order Ref. Id</th>
                                    <th>Seq. of Order</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                </tr>
                            </thead>
                         
                            <tbody>
                                <?php $i = 1;
                                    foreach($coupon_codes as $coupon_code):
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $coupon_code->coupon_code; ?></td>
                                    <td> <a href="#" id="<?php echo $coupon_code->advertisement_id; ?>" title="" data-toggle="modal" data-target="#adsModal" class="ads_details"><?php echo $coupon_code->advertisement_name; ?> </a> </a></td>
                                    <td><a href="#" id="<?php echo $coupon_code->seller_id; ?>" data-toggle="modal" data-target="#sellerModal" class="profile_view"><?php echo $coupon_code->seller_name; ?></a></td>
                                    <td><a href="#" id="<?php echo $coupon_code->buyer_id; ?>" data-toggle="modal" data-target="#userModal" class="user_profile"><?php echo $coupon_code->buyer_name; ?></td>
                                    <td><?php echo $coupon_code->order_ref_id; ?></td>
                                     <td><?php echo $coupon_code->sequence_of_order; ?></td>
                                    <td id="coupons_remarks" data-coupon-id="<?php echo $coupon_code->coupon_id; ?>" data-remarks="<?php echo $coupon_code->remarks; ?>">
                                        <?php echo $coupon_code->remarks?'<span class="remarks">'.substr($coupon_code->remarks, 0, 30).'...</span>':'<span class="remarks no_remarks">enter remarks...</span>'; ?></td>
                                    <td><?php echo $coupon_code->status; ?></td>
                                    <td><?php echo date('Y-m-d',strtotime($coupon_code->created_at)); ?></td>
                                    <td><?php echo date('Y-m-d',strtotime($coupon_code->updated_at)); ?></td>
                                </tr>   

                                <?php $i++; endforeach; ?>
                            </tbody>

                             <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input type="text" style="width:100%;" placeholder="Coupon Code"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Adv. Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Seller Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Buyer Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Order Ref. Id"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Seq. of Order"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Remarks"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Status"></th>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })</script>
                    <div class="clearfix"> </div>
                </div>

                <div class="modal fade" id="rejectPop" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content" >
                            <form action=""  method="post" id="RejectAds">
                                <input type="hidden" name="advertisement_id" id="advertisement_id" value=""/>
                                <input type="hidden" name="seller_id" id="seller_id" value=""/>
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
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Seller Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" src="" id="seller_image_display" style="height: 50px;width: 50px; " /></center>
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


                                 <div class="row" style="display: none;" id="report_div">
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
                

                <div class="modal fade" id="adsModal" tabindex="-1" role="dialog" aria-labelledby="adsModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Ads Details</h4>
                            </div>
                            <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-3">Advertisement Name:</div>
                                    <div class="col-md-9" id="ad_name"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3" id="created_by"></div>
                                    <div class="col-md-3">Category:</div>
                                    <div class="col-md-3" id="category"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3" id="sub_category"></div>
                                    <div class="col-md-3">Total_views:</div>
                                    <div class="col-md-3" id="total_views_adv"></div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-3">Actual Price:</div>
                                    <div class="col-md-3" id="actual_price"></div>
                                    <div class="col-md-3">Offer Price:</div>
                                    <div class="col-md-3" id="offer_price"></div>
                                </div>
<div class="row">
                                    <div class="col-md-3">Price for 2:</div>
                                    <div class="col-md-9" id="cashback_per_user"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" id="start_date"></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" id="end_date"></div>
                                </div>
                                <!--<div class="row">
                        <div class="col-md-3">Location:</div>
                        <div class="col-md-3">g xghghd gfh</div>
                        <div class="col-md-3">Secondary Contact:</div>
                        <div class="col-md-3">xzgsdf dgh</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">GST/PAN:</div>
                        <div class="col-md-3">dssgdf sfd</div>
                        <div class="col-md-3">Secondary Email:</div>
                        <div class="col-md-3">wetwe wtrhet</div>
                    </div>-->
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="last_editied"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Ad Detail:</div>
                                    <div class="col-md-9" id="ad_detail"></div>
                                </div>

                                  <div class="row" style="display: none;" id="ads_report_div">
                                    <div class="col-md-3">Report:</div>
                                    <div class="col-md-9">
                                        <ul id="ads_reports">
                                         
                                        </ul>


                                    </div>

                                </div>

                               
                                <br />


                                <!--images -->
                                <div class="row" id="append_images">
                                </div>
                                <!-- end images -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

             
                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal">
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
                                    <div class="col-md-3">Paytm_no:</div>
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
             






<div class="modal fade" id="remarks_modal" tabindex="-1" role="dialog" aria-labelledby="remarks_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Enter Remarks</h4>
                            </div>
                            <div class="modal-body">
                            <textarea style="width: 100%;" name="recordId" id="recordId" data-coupon-id=""></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                <button type="button" id="btn-remarks-submit" class="btn btn-success">Save</button>
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>



                
                <div class="clearfix"> </div>
            </div>
        </div>
 <?php $this->load->view('layouts/footer'); ?>


 
 
 <?php $this->load->view('assets/couponCodesIndex'); ?>