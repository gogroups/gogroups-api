<?php $this->load->view('layouts/header'); ?>

<style type="text/css">

    span_error {
        color: red;
    }

    #add_group_image_btn-error
    {
       position:absolute;
        margin-top:95px;
    }

    #add_group_image,#edit_group_image
    {
        width:100px;
        height:100px;
    }

    #add_group_image_btn,#edit_group_image_btn
    {
    position:absolute;
    width:100px;
    height:100px;
    margin-left:42%;
    margin-right:58%;
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

   
</script>

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
                            <h4 class="title">Interests
                                <span class="pull-right"> <a href="#" data-toggle="modal" data-target="#addgroupModal" class="btn btn-danger">Add New</a> </span></h4>
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
<br/>


                        
                        <table id="groupTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Group Name</th>
                                    <th>Location</th>
                                    <th>Created by</th>
                                    <th>Category</th>                                   
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Report</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                    <th style="display:none;">Group Detials</th>
                                    <th style="display:none;">Sub Category</th>
                                    <th style="display:none;">Member Count</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <?php $i = 1;
                                    foreach($groups as $group){
                                ?>
                                <tr>
                                    <td scope="row"><?php echo $i++; ?></td>
                                    <td><?php echo $group->group_name; ?></td>
                                    <td ><?php echo $group->location; ?></td>
                                    <td><a href="#" id="<?php echo $group->user_id ?>" data-toggle="modal" data-target="#userModal" class="user_profile"><?php echo $group->name.' '. $group->lastName; ?></a></td>
                                    <td><?php echo $group->category_title; ?></td>                                   
                                    <td><?php echo $group->start_date; ?></td>
                                    <td><?php echo $group->end_date; ?></td>
                                    <td>
                                    <?php if($group->comments != ""){?><span class="badge badge-danger" style="color:white;">yes</span><?php } ?>
                                        </td>
                                       <td><?php 
                                            if($group->status=="approved")
                                            {
                                                echo "Enabled";
                                            }  
                                            else
                                            {
                                                echo "Disabled";
                                            }
                                        ?></td>
                                    <td style="white-space: nowrap;">
                                        <?php if($group->status == 'unapproved' || $group->status == 'rejected'){ ?>
                                        <a href="#" id="<?php echo $group->group_id ?>" user_id="<?php echo $group->user_id ?>" class="approve_advertise fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Enable"></a> |<?php } if($group->status == 'approved' || $group->status == 'unapproved'){?> <a href="#" id="<?php echo $group->group_id ?>" user_id="<?php echo $group->user_id ?>" title="" data-toggle="tooltip" data-placement="top" data-original-title="Disable" class="reasonReject fa fa-times"></a> | <?php } ?> 
                                        <a href="#" id="<?php echo $group->group_id; ?>" title="" data-toggle="modal" data-target="#groupModal" class="group_details fa fa-bars"> </a> | 
                                        <a href="#" id="<?php echo $group->group_id ?>" title="" class="edit_group_view fa fa-pencil"> </a> | 
                                        <a href="<?php echo base_url('group/delete/').$group->group_id;?>" onclick="return confirm('Are you sure you want to Remove?');" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="fa fa-trash-o"></a>
                                    </td>

                                   <td style="display:none;"><?php echo $group->description; ?></td>
                                   <td style="display:none;"><?php echo $group->subcategory_title; ?></td> 
                                    <td style="display:none;"><?php echo $group->members_count; ?></td> 
                                </tr>
                                <?php } ?>
                            </tbody>
                              <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input type="text" style="width:100%;" placeholder="Group Name"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Location"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Created by"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Category"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Start Date"></th>
                                    <th><input type="text" style="width:100%;" placeholder="End Date"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Report"></th>
                                    <th><input type="text" style="width:100%;" placeholder="Status"></th>
                                    
                                    <th></th>
                                    
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    
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
                            <form action=""  method="post" id="RejectGroup">
                                <input type="hidden" name="group_id" id="group_id" value=""/>
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

                <div class="modal fade" id="addgroupModal"  role="dialog" aria-labelledby="AddadsModal">
                    <div class="modal-dialog" role="document">
                    <form id="addGroup" action="<?php echo base_url('Group/insert');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Interest Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="add_group_image_btn" name="group_image" onchange="readURL(this);" /> 
                                       <img class="img-circle __group_profile_pic" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="add_group_image" name="group_image_1"/>
                                    </center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Name:</div>
                                    <div class="col-md-9" id="ad_detail"><input type="text" class="col-md-12"  name="group_name"/></div>
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
                                    <div class="col-md-3" id="user_count"><input type="" class="col-md-12" id="add_user_count" name="user_count"/></div>
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
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" ><input type="text" id="start_date" class="col-md-12 form-control" data-toggle="datepicker"  name="start_date"/></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" ><input type="text" class="col-md-12 form-control" id="end_date" data-toggle="datepicker1" name="end_date"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9" id="last_editied"><input type="" class="col-md-12" name="history"/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Ad Detail:</div>
                                    <div class="col-md-9" id="ad_detail"><input type="" class="col-md-12"  name="ads_description"/></div>
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

                 <div class="modal fade" id="editgroupModal"  role="dialog" aria-labelledby="EditadsModal">
                    <div class="modal-dialog" role="document">
                    <form id="editGroup" action="<?php echo base_url('Group/update');?>" method="post" enctype="multipart/form-data">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit Group Details</h4>
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


                  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">User Details</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" id="user_image" height="100px" width="100px" /></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3" id="full_name"></div>
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3" id="email"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3" id="contact"></div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3" id="zipcode"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3" id="location"></div>
                                    <div class="col-md-3">Age:</div>
                                    <div class="col-md-3" id="age"></div>
                                </div>
                                

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width:128%">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Group Details</h4>
                            </div>
                            <div class="modal-body">
                                <!--images -->
                                <div class="row">
                                    <div class="col-md-4"></div>
                                      <center>  <img class="col-md-4" src="" id="group_image" style="width:115px;margin-left: 67px;"/></center>
                                    <div class="col-md-4"></div>
                                </div>
                                <!-- end images -->
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
                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3" id="group_start_date"></div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3" id="group_end_date"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-3" id="group_last_editied"></div>
                                    <div class="col-md-3">Joined Users:</div>
                                    <div class="col-md-3" id="total_joined_users_count"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Description:</div>
                                    <div class="col-md-9" id="group_descr"></div>
                                </div>
                                
                                <div class="row" style="display: none" id="report_div">
                                    <div class="col-md-3">Report:</div>
                                    <div class="col-md-9">
                                    <ul id="reports">
                                        
                                    </ul>
                                        
                                    
                                    </div>
                                    
                                </div>

                                <br />
                                
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

 <?php $this->load->view('layouts/footer'); ?>

 <?php $this->load->view('assets/groupindex'); ?>