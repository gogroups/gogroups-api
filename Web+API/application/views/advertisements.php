
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
<div class="col-md-4">Start Date (From):</div>
<div class="col-md-2"><input type="text" id="start_date_starts"  name="min"></div>
</div>

<div class="row">
<div class="col-md-4">Start Date (To):</div>
<div class="col-md-2"><input type="text" id="start_date_ends"  name="max"></div>
</div>               
</div>


<div class="col-md-6">
<div class="row">
<div class="col-md-4">End Date (From):</div>
<div class="col-md-2"><input type="text" id="end_date_starts" name="min"></div>
</div>

<div class="row">
<div class="col-md-4">End Date (To):</div>
<div class="col-md-2"><input type="text" id="end_date_ends" name="max"></div>
</div>                
</div>

</div>

<a href="#" id="clear" class="pull-right">Clear Filters</a>

</div>


                        <table id="adsTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Ad. Name</th>
                                    <th>Created by</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Report</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                     <th style="display:none;">Ad Detial</th>
                                </tr>
                            </thead>
                         
                            <tbody>
                                <?php $i = 1;
                                    foreach($advertisements as $ads){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                     <td><?php echo $ads->advertisement_name; ?></td>
                                    <td><a href="#" id="<?php echo $ads->user_id ?>" data-toggle="modal" data-target="#sellerModal" class="seller_profile"><?php echo $ads->name. ' '. $ads->lastName; ?></a></td>
                                    <td><?php echo $ads->category_title; ?></td>
                                    <td><?php echo $ads->subcategory_title; ?></td>
                                    <td><?php echo $ads->start_date; ?></td>
                                    <td><?php echo $ads->end_date; ?></td>
                                    <td><?php if($ads->comments != ""){?><span class="badge badge-danger" style="color:white;">yes</span><?php } ?></td>
                                    <td><?php 
                                            if($ads->status=="approved")
                                            {
                                                echo "Enabled";
                                            }  
                                            else
                                            {
                                                echo "Disabled";
                                            }
                                        ?></td>
                                    <td style="white-space: nowrap;">
                                        <?php if($ads->status == 'unapproved' || $ads->status == 'rejected'){ ?>
                                        <a href="#" id="<?php echo $ads->advertisement_id ?>" seller_id="<?php echo $ads->user_id ?>" class="approve_advertise fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Enable"></a> |<?php } if($ads->status == 'approved' || $ads->status == 'unapproved'){?> <a href="#" id="<?php echo $ads->advertisement_id ?>" seller_id ="<?php echo $ads->user_id ?>" title="" data-toggle="tooltip" data-placement="top" data-original-title="Disable" class="reasonReject fa fa-times"></a> | <?php } ?> <a href="#" id="<?php echo $ads->advertisement_id; ?>" title="" data-toggle="modal" data-target="#adsModal" class="ads_details fa fa-bars"> </a> |
                                        <a href="#" id="<?php echo $ads->advertisement_id ?>" title="" class="edit_ads_view fa fa-pencil"> </a> | 
                                         <a href="<?php echo base_url('advertisement/delete/').$ads->advertisement_id;?>" onclick="return confirm('Are you sure you want to Remove?');" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="fa fa-trash-o"></a>
                                    </td>
                                     <td style="display:none;"><?php echo $ads->advertisement_details; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>

                              <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input type="text" style="width:100%;" placeholder="Ad. Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Created by"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Category"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Sub Category"></th>
                                    <th><input type="text" style="width:100%;" id="start_date_filter_row" placeholder="Start Date"></th>
                                    <th><input type="text" style="width:100%;" id="end_date_filter_row" placeholder="End Date"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Report"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Status"></th>
                                    <th></th>
                                     <th style="display:none;">Ad Detial</th>
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
                                    <div class="col-md-9" id="advertisement_name"></div>
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
                                    <div class="col-md-9" id="offerfortwo"></div>
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

                <div class="modal fade" id="addadsModal"  role="dialog" aria-labelledby="AddadsModal">
                    <div class="modal-dialog" role="document">
                    <form id="addAds" action="<?php echo base_url('advertisement/insert');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Create Ads</h4>
                            </div>
                            <div class="modal-body">
                                
                                <div class="row">
                                    <div class="col-md-3">Ad Name:</div>
                                    <div class="col-md-9" id="ad_name"><input type="" class="col-md-12"  name="ads_name"/></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3"> <select class="col-md-12 select2-single"  name="users"><option value="">Select users..</option>
                                        <?php foreach($users as $user){  ?>
                                        <option value="<?php echo $user->user_id ?>"><?php echo $user->name.' ' .$user->lastName;?></option>
                                        <?php } ?></select></div>
                                    <div class="col-md-3">Category:</div>
                                    <div class="col-md-3" > <select  class="col-md-12 select2-categories form-control" name="categories"><option value="">Select Category..</option>
                                        <?php foreach($categories as $category){ ?>
                                        <option value="<?php echo $category->category_id;?>"><?php echo $category->category_title; ?></option>
                                        <?php } ?>
                                    </select></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption subcategories_lvl_1" name="sub_categories" id="subcategories">
                                    <option value="">Select..</option>
                                    
                                    </select>
                                </div>
                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3" id="user_count"><input type="" class="col-md-12" id="add_user_count" name="min_user_count"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category2:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption2 subcategories_lvl_2" name="sub_categories2" id="subcategories2">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                    <div class="col-md-3">Sub Category3:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption3 subcategories_lvl_3" name="sub_categories3" id="subcategories3">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category4:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption4 subcategories_lvl_4" name="sub_categories4" id="subcategories4">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                    <div class="col-md-3">Sub Category5:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption5 subcategories_lvl_5" name="sub_categories5" id="subcategories5">
                                    <option id="values5">Select..</option>
                                    </select>
                                </div>
                                </div> 

                                 <div class="row">
                                    <div class="col-md-3">Actual Price:</div>
                                    <div class="col-md-3" ><input type="number" id="actual_price" class="col-md-12 form-control"  name="actual_price"/></div>
                                    <div class="col-md-3">Offer Price:</div>
                                    <div class="col-md-3" ><input type="number" class="col-md-12 form-control end_date" id="offser_price" name="offer_price"/></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" ><input type="text" id="start_date" class="col-md-12 form-control" data-toggle="datepicker"  name="start_date"/></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" ><input type="text" class="col-md-12 form-control end_date" id="end_date" data-toggle="datepicker1" name="end_date"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="last_editied"><input type="" class="col-md-12" name="history"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Ad Detail:</div>
                                    <div class="col-md-9" id="ad_detail"><input type="" class="col-md-12"  name="ads_description"/></div>
                                </div>

                                <div class="row">
                                    <center>
                                       <input type="file" multiple id="add_ads_image_btn" name="ads_image[]" required>
                                       <div class="gallery_btn"></div><span class="gallery_btn_text">Add Image</span>
                                        <div class="gallery">
                                           
                                        </div>
                                    </center>
                                </div>

                                <br />
                                <!--images -->
                                <div class="row">

                                    <img class="col-md-3" src="" id="images"/>
                                </div>
                               

                                <!-- end images -->
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                        </form>
                    </div><!-- /.modal-dialog -->
                </div>

                   <div class="modal fade" id="editadsModal"  role="dialog" aria-labelledby="EditadsModal">
                    <div class="modal-dialog" role="document">
                    <form id="editAds" action="<?php echo base_url('advertisement/update');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit Ads Details</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                     <input type="hidden" name="ads_id" value="" id="__ads_id">
                                    
                                    <div class="row">
                                    <div class="col-md-3">Ad Name:</div>
                                    <div class="col-md-9"><input type="text" class="col-md-12" id="edit_ad_name" name="ads_name"/></div>
                                    </div><br/>

                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3"> <select class="col-md-12 select2-single"  name="users" id="edit_ads_created_by"><option value="">Select users..</option>
                                        <?php foreach($users as $user){  ?>
                                        <option value="<?php echo $user->user_id ?>"><?php echo $user->name.' ' .$user->lastName;?></option>
                                        <?php } ?></select></div>
                                    <div class="col-md-3"><!-- Category: --></div>
                                    <div class="col-md-3" ><!--  <select  class="col-md-12 select2-categories form-control" name="categories"><option value="">Select Category..</option>
                                        <?php foreach($categories as $category){ ?>
                                        <option value="<?php echo $category->category_id;?>"><?php echo $category->category_title; ?></option>
                                        <?php } ?>
                                    </select>--></div> 
                               <!--  --></div> 

                               <!--  <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption subcategories_lvl_1" name="sub_categories" id="edit_subcategories">
                                    <option value="">Select..</option>
                                    
                                    </select>
                                </div>
                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3" id="user_count"><input type="" class="col-md-12" id="add_user_count" name="user_count"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category2:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption2 subcategories_lvl_2" name="sub_categories2" id="edit_subcategories2">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                    <div class="col-md-3">Sub Category3:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption3 subcategories_lvl_3" name="sub_categories3" id="edit_subcategories3">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category4:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption4 subcategories_lvl_4" name="sub_categories4" id="edit_subcategories4">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                    <div class="col-md-3">Sub Category5:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption5  subcategories_lvl_5" name="sub_categories5" id="edit_subcategories5">
                                    <option id="values5">Select..</option>
                                    </select>
                                </div> -->
                                <!-- </div>  -->
                                 <div class="row">
                                    <div class="col-md-3">Actual Price:</div>
                                    <div class="col-md-3" ><input type="number" id="edit_actual_price" class="col-md-12 form-control" name="actual_price"/></div>
                                    <div class="col-md-3">Offe Price:</div>
                                    <div class="col-md-3" ><input type="number" class="col-md-12 form-control" id="edit_offer_price" name="offer_price"/></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" ><input type="text" id="edit_start_date" class="col-md-12 form-control" data-toggle="datepicker2"  name="start_date"/></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" ><input type="text" class="col-md-12 form-control" id="edit_end_date" data-toggle="datepicker3" name="end_date"/></div>
                                </div>
                               <!--  <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="last_editied"><input type="" class="col-md-12" name="history"/></div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-3">Ad Detail:</div>
                                    <div class="col-md-9"><input type="" class="col-md-12" id="edit_ad_detail" name="ads_description"/></div>
                                </div>

                               <!--  <div class="row">
                                    <center>
                                       <input type="file" multiple id="edit_ads_image_btn" name="ads_image[]">
                                       <div class="gallery_btn"></div><span class="gallery_btn_text">Add Image</span>
                                        <div class="edit_gallery" id="edit_images">
                                           
                                        </div>
                                    </center>
                                </div> -->

                              
                                <br />
                                <!--images -->
                                <div class="row">

                                    <img class="col-md-3" src="" id="images"/>
                                </div>
                               

                                <!-- end images -->
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

 <?php $this->load->view('assets/Advertisementindex'); ?>