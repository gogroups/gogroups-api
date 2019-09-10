<?php $this->load->view('layouts/header'); ?>
<style>
    .stats-right label a
    {
        color:#fff;
    }
  #edit_group_image_btn {
    position: absolute;
    width: 100px;
    height: 100px;
    margin-left: 42%;
    margin-right: 58%;
    z-index: 10;
    opacity: 0;
}
#edit_group_image
    {
        width:100px;
        height:100px;
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
                <div class="row-one">
                    <div class="col-md-4 widget">
                        <div class="stats-left ">
                            <h5>Active</h5>
                            <h4>Sellers</h4>
                        </div>
                        <div class="stats-right">
                            <label><a href="<?php echo base_url('sellerController/home'); ?>"><?php echo $seller_count?></a></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-4 widget states-mdl">
                        <div class="stats-left">
                            <h5>Active</h5>
                            <h4>Users</h4>
                        </div>
                        <div class="stats-right">
                            <label><a href="<?php echo base_url('userController/home'); ?>"><?php echo $users_count;?></a></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-4 widget states-last">
                        <div class="stats-left">
                            <h5>Active</h5>
                            <h4>Ads</h4>
                        </div>
                        <div class="stats-right">
                            <label><a href="<?php echo base_url('advertisement/home'); ?>"><?php echo $ads_count; ?></a></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="row">

                    <div class="col-md-12 stats-atinder widget-shadow" id="seller_div">
                        <div class="stats-title">
                            <div class="seller_messsage"></div>
                            <h4 class="title">Pending Approval - Seller</h4>
                        </div>
                        <table id="sellerTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Full Name</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($sellers)){
                                $i = 1;
                                foreach($sellers as $seller) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $seller->name. ' '. $seller->lastName; ?></td>
                                    <td><?php echo $seller->seller_companyName; ?></td>
                                    <td><?php echo $seller->location; ?></td>
                                    <td><?php echo $seller->contact_number; ?></td>
                                    <td>
                                        <a href="#" id="<?php echo $seller->user_id ?>" class="approve_seller fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="#" id="<?php echo $seller->user_id ?>" title="" data-toggle="tooltip" data-placement="top"  data-original-title="Reject" class="reject_seller reasonReject fa fa-times"></a> | <a href="#" id="<?php echo $seller->user_id ?>"  title="" data-toggle="modal" data-target="#sellerModal" class="seller_profile fa fa-bars"></a>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <script>
                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })</script>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="row">

                    <div class="col-md-12 stats-atinder widget-shadow">
                        <div class="stats-title">
                             <div class="adv_messsage"></di
                            <h4 class="title">Pending Approval - Ads</h4>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php $i = 1;
                            foreach($advertisements as $ads){ ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $ads->advertisement_name; ?></td>
                                    <td><a href="#" id="<?php echo $ads->user_id ?>" data-toggle="modal" data-target="#sellerModal" class="seller_profile"><?php echo $ads->name.' ' . $ads->lastName; ?></a></td>
                                    <td><?php echo $ads->category_title; ?></td>
                                    <td><?php echo $ads->subcategory_title; ?></td>
                                    <td><?php echo $ads->start_date; ?></td>
                                    <td><?php echo $ads->end_date; ?></td>
                                    <td>
                                        <a href="#"  id="<?php echo $ads->advertisement_id ?>" seller="<?php echo $ads->user_id ?>" class="approve_advertise fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="#" title="" id="<?php echo $ads->advertisement_id ?>" seller="<?php echo $ads->user_id ?>" data-toggle="tooltip" data-placement="top" data-original-title="Reject" data-toggle="modal" data-target="#adsModal" class="reject_advertise reasonReject1 fa fa-times"></a> | <a href="#" id ="<?php echo $ads->advertisement_id; ?>" title="" data-toggle="modal" data-target="#adsModal" class="ads_details fa fa-bars"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="row">

                    <div class="col-md-12 stats-atinder widget-shadow">
                        <div class="stats-title">
                            <h4 class="title">Pending Approval - Interests</h4>
                        </div>
                        <table id="groupTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Group Name</th>
                                    <th>Location</th>
                                    <th>Created by</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i =1;
                                foreach($groups as $group) {?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ;?></th>
                                    <td><?php echo $group->group_name; ?></td>
                                    <td><?php echo $group->location;?></td>
                                    <td><a href="#" id="<?php echo $group->user_id ?>" data-toggle="modal" class="user_group_profile" data-target="#userModel"><?php echo $group->name.' '.$group->lastName?></a></td>
                                    <td><?php echo $group->category_title; ?></td>
                                    <td><?php echo $group->subcategory_title; ?></td>
                                    <td><?php echo $group->start_date; ?></td>
                                    <td><?php echo $group->end_date; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" id="<?php echo $group->group_id; ?>" user="<?php echo $group->user_id ?>" class="approve_group fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="javascript:void(0)" id="<?php echo $group->group_id; ?>"  user="<?php echo $group->user_id ?>" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" class="reject_group  reasonReject3 fa fa-times"></a> | <a href="javascript:void(0)" id="<?php echo $group->group_id; ?>" title="" data-toggle="modal" data-target="#groupModal" class="group_details fa fa-bars">| 
                                        <a href="javascript:void(0)" id="<?php echo $group->group_id ?>" title="" class="edit_group_view fa fa-pencil"> </a></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                 <div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="userModel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">User Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" src="/images/a.png" /></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3" id="user_full_name"></div>
                                    <div class="col-md-3">Age:</div>
                                    <div class="col-md-3" id="user_age"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3" id="user_contact"></div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3" id="user_location"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-4" id="user_email"></div>
                                    <div class="col-md-2">Zip Code:</div>
                                    <div class="col-md-3" id="user_zipcode"></div>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


                <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="sellerModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Seller Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png') ?>" /></center>
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

                <div class="modal fade" id="adsModal" tabindex="-1" role="dialog" aria-labelledby="adsModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Ads Details</h4>
                            </div>
                            <div class="modal-body" id="group_model">
                                <div class="row">
                                    <div class="col-md-3">Ad Name:</div>
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
                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3" id="user_count"></div>
                                </div>
                                <div class="row" style="display: none" id="sub_category2">
                                </div>
                                <div class="row" style="display: none" id="sub_category3">
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
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="last_edited"></div>
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
                                    <div class="col-md-3">Ad Detail:</div>
                                    <div class="col-md-9" id="ad_detail"></div>
                                </div>

                                <br />
                                <!--images -->
                                <div class="row " id="append_images">

                                    <!--  --><img class="col-md-3" src="" id="adv_images"/>
                                    <!-- 
                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />
                                    <img class="col-md-3" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />
                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />-->

                                </div>
                                <!-- <div class="row">


                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />
                                    <img class="col-md-3" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />

                                </div> -->

                                <!-- end images -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Interest Details</h4>
                            </div>
                            <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-3">Group Name:</div>
                                    <div class="col-md-3" id="group_name"></div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3" id="group_location"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3" id="group_created_by"></div>
                                    <div class="col-md-3">Category:</div>
                                    <div class="col-md-3" id="group_category"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3" id="group_sub_category"></div>
                                    <div class="col-md-3">Member Count:</div>
                                    <div class="col-md-3" id="member_count"></div>
                                </div>
                                <div class="row" style="display: none" id="group2">
                                </div>
                                <div class="row" style="display: none" id="group3">
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" id="group_start_date"></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" id="group_end_date"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="group_last_editied"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Description:</div>
                                    <div class="col-md-9" id="group_descr"></div>
                                </div>

                                <br />
                                <!--images -->
                                <div class="row">
                                    <div class="col-md-3"></div>
                                        <img class="col-md-4" src="" id="group_image"/>
                                    <div class="col-md-4" style="margin-top: 128px;">
                                          <div id="group_image_btn">
                                            <input type="file" class="group_edit_image_btn" onchange="readURL(this)">
                                        </div>
                                    </div>
                                </div>
                              
                                

                                <!-- end images -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
 
                <div class="modal fade" id="rejectPop" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <form action=""  method="post" id="RejectUser">
                                <input type="hidden" name="seller_id" id="seller_id" value=""/>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Reject Reason</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">Reason:</div>
                                    <div class="col-md-6"><input type="text" name="reason"/></div>
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
                
                <div class="modal fade" id="rejectPop1" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content" >
                            <form action=""  method="post" id="RejectAds">
                                <input type="hidden" name="advertisement_id" id="advertisement_id" value=""/>
                                <input type="hidden" name="seller_id" id="seller_id_adv" value=""/>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Reject Reason</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">Reason:</div>
                                    <div class="col-md-6"><input type="text" name="reason"/></div>
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

                        <div class="modal fade" id="rejectPop2" tabindex="-1" role="dialog" aria-labelledby="rejectPop">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content" >
                            <form action=""  method="post" id="RejectGroup">
                                <input type="hidden" name="group_id" id="group_id" value=""/>
                                <input type="hidden" name="user_id" id="group_user_id" value=""/>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Reject Reason</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">Reason:</div>
                                    <div class="col-md-6"><input type="text" name="reason"/></div>
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

                   <div class="modal fade" id="editgroupModal"  role="dialog" aria-labelledby="EditadsModal">
                    <div class="modal-dialog" role="document">
                    <form id="editGroup" action="<?php echo base_url('Admin/group_update');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit Interest Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="edit_group_image_btn" name="group_image" onchange="readURL(this);" /> 
                                       <img class="img-circle __group_profile_pic" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="edit_group_image" name="group_image_1"/>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Name:</div>
                                    <div class="col-md-9">
                                        <input type="text"  id="edit_group_name" class="col-md-12"  name="group_name"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3"> <select class="col-md-12 select2-single"  id="edit_group_created_by" name="users"><option value="">Select users..</option>
                                        <?php foreach($users as $user){  ?>
                                        <option value="<?php echo $user->user_id ?>" ><?php echo $user->name.' ' .$user->lastName;?></option>
                                        <?php } ?></select></div>

                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3" id="user_count">
                                        <input type="" class="col-md-12" id="edit_member_count" name="user_count"/></div>
                                </div>
                                <!-- </div> -->

                               <!--   <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption subcategories_lvl_1" name="sub_categories" id="edit_subcategories">
                                    <option value="">Select..</option>    
                                    </select>
                                </div>

                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3" id="user_count">
                                        <input type="" class="col-md-12" id="edit_member_count" name="user_count"/></div>
                                </div> -->

                                <!-- <div class="row">
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
                                </div> -->
                              <!--   <div class="row">
                                    <div class="col-md-3">Sub Category4:</div>
                                    <div class="col-md-3"> <select class="col-md-12 __appendOption4 subcategories_lvl_4" name="sub_categories4" id="edit_subcategories4">
                                    <option id="values4">Select..</option>
                                    </select>
                                </div>
                                    <div class="col-md-3">Sub Category5:</div>
                                    <div class="col-md-3" <select class="col-md-12 __appendOption5 subcategories_lvl_5" name="sub_categories5" id="edit_subcategories5">
                                    <option id="values5">Select..</option>
                                    </select>
                                </div>
                               
                                </div>  -->

                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" ><input type="text" id="start_date" class="col-md-12 form-control edit_group_start_date" data-toggle="datepicker2"  name="start_date"/></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" ><input type="text" class="col-md-12 form-control edit_group_end_date" id="end_date" data-toggle="datepicker3" name="end_date"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><!-- Last editied: --></div>
                                    <div class="col-md-9" id="last_editied"><!-- <input type="" class="col-md-12" name="history"/> --></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Detail:</div>
                                    <div class="col-md-9"><input type="" class="col-md-12" id="edit_ad_desc"  name="ads_description"/></div>
                                </div>

                                <input type="hidden" name="group_id" value="" id="__group_id">
                                <input type="hidden" id="__edit_group_image" name="profile_img" value="">


                            
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


 <?php $this->load->view('layouts/footer'); ?>

 <?php $this->load->view('assets/adminDashboard'); ?>