<?php $this->load->view('layouts/header'); ?>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <div class="sidebar" role="navigation">
            <div class="navbar-collapse">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.html" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
                        </li>

                        <li class="">
                            <a href="#"><i class="fa fa-book nav_icon"></i>All Accounts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="selleraccount.html">Seller Account</a>
                                </li>
                                <li>
                                    <a href="useraccount.html">User Account</a>
                                </li>
                                <li>
                                    <a href="ads.html">Ads</a>
                                </li>
                                <li>
                                    <a href="groups.html">Group</a>
                                </li>
                                <li>
                                    <a href="category.html">Category</a>
                                </li>
                            </ul>
                            <!-- /nav-second-level -->
                        </li>
                        


                    </ul>
                    <!-- //sidebar-collapse -->
                </nav>
            </div>
        </div>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section ">
            <div class="header-left">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <!--logo -->
                <div class="logo">
                    <a href="index.html">
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
                                    <span class="prfil-img"><?php echo $_SESSION['user_name']; ?></span>
                                    <div class="user-name">
                                        <p>Wikolia</p>
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
                            <h5>Total</h5>
                            <h4>Sellers</h4>
                        </div>
                        <div class="stats-right">
                            <label> 45</label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-4 widget states-mdl">
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Users</h4>
                        </div>
                        <div class="stats-right">
                            <label> 80</label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-4 widget states-last">
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Ads</h4>
                        </div>
                        <div class="stats-right">
                            <label>51</label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="row">

                    <div class="col-md-12 stats-atinder widget-shadow">
                        <div class="stats-title">
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Lorem ipsum</td>
                                    <td>XYZ</td>
                                    <td>Ludhiana, Punjab</td>
                                    <td>+91-880685443</td>
                                    <td>
                                        <a href="#" class="fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="#" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" class="fa fa-times"></a> | <a href="#" title="" data-toggle="modal" data-target="#sellerModal" class="fa fa-bars"></a>
                                    </td>
                                </tr>

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
                            <h4 class="title">Pending Approval - Ads</h4>
                        </div>
                        <table id="adsTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Created by</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><a href="#" data-toggle="modal" data-target="#sellerModal">Lorem ipsum</a></td>
                                    <td>Property</td>
                                    <td>Rent</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>
                                        <a href="#" class="fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="#" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" class="fa fa-times"></a> | <a href="#" title="" data-toggle="modal" data-target="#adsModal" class="fa fa-bars"></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="row">

                    <div class="col-md-12 stats-atinder widget-shadow">
                        <div class="stats-title">
                            <h4 class="title">Pending Approval - Groups</h4>
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Lorem ipsum</td>
                                    <td>Ludhiana, Punjab</td>
                                    <td><a href="#" data-toggle="modal" data-target="#sellerModal">Lorem ipsum</a></td>
                                    <td>Category</td>
                                    <td>Sub Category</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>
                                        <a href="#" class="fa fa-check" title="" data-toggle="tooltip" data-placement="top" data-original-title="Approve"></a> | <a href="#" title="" data-toggle="tooltip" data-placement="top" data-original-title="Reject" class="fa fa-times"></a> | <a href="#" title="" data-toggle="modal" data-target="#groupModal" class="fa fa-bars"></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"> </div>
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
                                    <center><img class="img-circle" src="/images/a.png" /></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Full Name:</div>
                                    <div class="col-md-3">ag sdfh fgh</div>
                                    <div class="col-md-3">Company:</div>
                                    <div class="col-md-3">zfg ghdg</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Contact:</div>
                                    <div class="col-md-3">sdfg dgfh</div>
                                    <div class="col-md-3">Zip Code:</div>
                                    <div class="col-md-3">gdh jhfh</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Email:</div>
                                    <div class="col-md-3">ag dfgs</div>
                                    <div class="col-md-3">Secondary Name:</div>
                                    <div class="col-md-3">grg fghdfjf</div>
                                </div>
                                <div class="row">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-3">USP of Seller</div>
                                    <div class="col-md-9">hdfg fhjfghjf hj</div>
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
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3">ag sdfh fgh</div>
                                    <div class="col-md-3">Category:</div>
                                    <div class="col-md-3">zfg ghdg</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3">sdfg dgfh</div>
                                    <div class="col-md-3">User Count:</div>
                                    <div class="col-md-3">gdh jhfh</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3">ag dfgs</div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3">grg fghdfjf</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9">hdfg fhjfghjf hj</div>
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
                                    <div class="col-md-9">hdfg fhjfghjf hj</div>
                                </div>

                                <br />
                                <!--images -->
                                <div class="row">

                                    <img class="col-md-3" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />
                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />
                                    <img class="col-md-3" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />
                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />
                                </div>
                                <div class="row">


                                    <img class="col-md-3" src="http://creative-ads.org/wp-content/uploads/2013/04/what_a_whopper_ad.jpg" />
                                    <img class="col-md-3" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />

                                </div>

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
                                <h4 class="modal-title" id="gridSystemModalLabel">Group Details</h4>
                            </div>
                            <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-3">Group Name:</div>
                                    <div class="col-md-3">g xghghd gfh</div>
                                    <div class="col-md-3">Location:</div>
                                    <div class="col-md-3">xzgsdf dgh</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Created by:</div>
                                    <div class="col-md-3">ag sdfh fgh</div>
                                    <div class="col-md-3">Category:</div>
                                    <div class="col-md-3">zfg ghdg</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Sub Category:</div>
                                    <div class="col-md-3">sdfg dgfh</div>
                                    <div class="col-md-3">Member Count:</div>
                                    <div class="col-md-3">gdh jhfh</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Start Date:</div>
                                    <div class="col-md-3">ag dfgs</div>
                                    <div class="col-md-3">End Date:</div>
                                    <div class="col-md-3">grg fghdfjf</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Last editied:</div>
                                    <div class="col-md-9">hdfg fhjfghjf hj</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Group Description:</div>
                                    <div class="col-md-9">hdfg fhjfghjf hj</div>
                                </div>

                                <br />
                                <!--images -->
                                <div class="row">
                                    <div class="col-md-4"></div>
                                        <img class="col-md-4" src="http://www.designyourway.net/blog/wp-content/uploads/2010/11/Nike-Print-Ads-12.jpg" />
                                    <div class="col-md-4"></div>
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
  
  <?php $this->load->view('layouts/footer'); ?>
 
