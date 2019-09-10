<?php $this->load->view('layouts/header'); ?>
<style>
    
    #add_category_image_btn-error
    {
       position:absolute;
        margin-top:95px;
    }

    #add_category_image
    {
        width:100px;
        height:100px;
    }

    #add_category_image_btn
    {
    position:absolute;
    width:100px;
    height:100px;
    margin-left:230px;
    z-index:10;
    opacity:0;   
    }

     #add_category_image_btn1
    {
    position:absolute;
    width:100px;
    height:100px;
     margin-left:230px;
      z-index:10;
      opacity:0;  

     
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
                                <li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>
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

                    <div class="row">

                        <div class="col-md-3 stats-info widget-shadow">
                            <div class="stats-title">
                                <h4 class="title">
                                    Categories
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addcategory" class="fa fa-plus-square-o" > </a></h4></span>
                                </h4>

                               
                            </div>
                            
                            <div class="stats-body">
                                <ul class="list-unstyled">
                                    <?php foreach($categories as $category){?>
                                    <li class="">
                                        <a href="#" class="showCategory" id="<?php echo $category->category_id?>"><?php echo $category->category_title; ?></a><h5 class="pull-right"><a href="#" id="<?php echo $category->category_id ?>" class="edit_category"> <span class="fa fa-pencil-square-o"></span></a></h5>
                                        
                                    </li>
                                    <?php } ?>
                                   
                                </ul>
                            </div>
                        </div>

                        <span class="col-md-1"></span>

                        <div class="col-md-3 stats-info widget-shadow" style="display: none" id="subcategory1">
                            <div class="stats-title">
                                <h4 class="title">
                                    Sub Categories 1
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addsubcategory" class="fa fa-plus-square-o"> </a></h4></span>
                                </h4>


                            </div>

                            <div class="stats-body">
                                <ul class="list-unstyled __apend_box" >
                                    <li class="">
                                        <a href="#" class="subcategories"></a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                </ul>
                            </div>
                        </div>

                        <span class="col-md-1"></span>

                    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('Category/add');?>"  method="post" id="Addcategory" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Category</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>  <input type='file' id="add_category_image_btn" name="category_image" onchange="readURL(this);" /> 
                                       <img class="img-circle" src="<?php echo base_url('public/images/dummy.jpg') ?>" id="add_category_image" name="category_image_1"/></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Category Title:</div>
                                    <div class="col-md-6"><input type="text" name="category_title" value="" class="col-md-12" required></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="addsubcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="subcategory">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Subcategory</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" disabled="disabled" name="category_id" id="__category_id">

                                            <?php foreach($categories as $category){?>
                                            <option value="<?php echo $category->category_id?>"><?php echo $category->category_title;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title" value="" class="col-md-12" required></div>
                                </div>
                                <input type="hidden" name="category_id" value="" id="__subcategory_title">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>


                <div class="modal fade" id="addsubcategory2" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="subcategory2">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Subcategory 2</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id" id="__subcategory_id">
                                            <?php foreach($subcatgories as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory_id?>"><?php echo $subcategory->subcategory_title;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title 2:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title2" value="" class="col-md-12" required></div>
                                </div>

                                  <input type="hidden" name="subcategory_id" value="" id="__subcategory_title2">


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                 <div class="modal fade" id="addsubcategory3" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="subcategory3">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Subcategory 3</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories2:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id2" id="__subcategory_id2">
                                            <?php foreach($subcatgories2 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory2_id?>"><?php echo $subcategory->subcategory_title2;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title 3:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title3" value="" class="col-md-12" required></div>
                                </div>
                                <input type="hidden" name="subcategory_id2" value="" id="__subcategory_title3">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="addsubcategory4" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="subcategory4">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Subcategory 4</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories3:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id3" id="__subcategory_id3">
                                            <?php foreach($subcatgories3 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory3_id?>"><?php echo $subcategory->subcategory_title3;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title 4:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title4" value="" class="col-md-12" required></div>
                                </div>
                                 <input type="hidden" name="subcategory_id3" value="" id="__subcategory_title4">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="addsubcategory5" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="subcategory5">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Add Subcategory 5</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Sub Categories3:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id4" id="__subcategory_id4">
                                            <?php foreach($subcatgories4 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory4_id?>"><?php echo $subcategory->subcategory_title4;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title 5:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title5" value="" class="col-md-12" required></div>
                                </div>
                                 <input type="hidden" name="subcategory_id4" value="" id="__subcategory_title5">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo base_url('category/updateCategory/')?>"  method="post" id="EditCategory" enctype="multipart/form-data">
                            <input type="hidden" name="category_id" id="categoryId" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit Category</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row-info">
                                    <center>
                                        <input type='file' id="add_category_image_btn1" name="category_image1" onchange="readURL1(this);" /> 
                                       <img class="img-circle" src="" id="category_image" style="width:100px;" /></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Category Title:</div>
                                    <div class="col-md-6"><input type="text" name="category_title" id="category_title" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                  <div class="modal fade" id="editsubcategory" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="EditsubCategory">
                            <input type="hidden" name="subcategory_id" id="subcategoryId" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit SubCategory</h4>
                            </div>
                            <div class="modal-body">
                               <!--  <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="category_id">
                                            <?php foreach($categories as $category){?>
                                            <option value="<?php echo $category->category_id?>" id="subcategory_t"><?php echo $category->category_title;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title" id="subcategory_title" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editsubcategory2" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="EditsubCategory2">
                            <input type="hidden" name="subcategory_id2" id="subcategoryId2" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit SubCategory</h4>
                            </div>
                            <div class="modal-body">
                               <!--  <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id_2">
                                            <?php foreach($subcatgories as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory_id?>" id="subcategory_t2"><?php echo $subcategory->subcategory_title;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title2" id="subcategory_title2" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editsubcategory3" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="EditsubCategory3">
                            <input type="hidden" name="subcategory_id3" id="subcategoryId3" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit SubCategory</h4>
                            </div>
                            <div class="modal-body">
                             <!--    <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id_3">
                                            <?php foreach($subcatgories2 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory2_id?>" id="subcategory_t2"><?php echo $subcategory->subcategory_title2;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title3" id="subcategory_title3" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editsubcategory4" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="EditsubCategory4">
                            <input type="hidden" name="subcategory_id4" id="subcategoryId4" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit SubCategory</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id_4">
                                            <?php foreach($subcatgories3 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory3_id?>" id="subcategory_t3"><?php echo $subcategory->subcategory_title3;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title4" id="subcategory_title4" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="editsubcategory5" tabindex="-1" role="dialog" aria-labelledby="addcategory">
                    <div class="modal-dialog" role="document">
                        <form action=""  method="post" id="EditsubCategory5">
                            <input type="hidden" name="subcategory_id5" id="subcategoryId5" value=""/>
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Edit SubCategory</h4>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="row-info">
                                    <center><img class="img-circle" src="<?php echo base_url('public/images/a.png');?>" /></center>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">Sub Categories:</div>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="subcategory_id_5">
                                            <?php foreach($subcatgories4 as $subcategory){?>
                                            <option value="<?php echo $subcategory->subcategory4_id?>" id="subcategory_t4"><?php echo $subcategory->subcategory_title4;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">SubCategory Title:</div>
                                    <div class="col-md-6"><input type="text" name="subcategory_title5" id="subcategory_title5" value="" class="col-md-12"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                    </div><!-- /.modal-dialog -->
                </div>

                        <div class="col-md-3 stats-info widget-shadow" id="subcategory_2" style="display: none">
                            <div class="stats-title">
                                <h4 class="title">
                                    Sub Categories 2
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addsubcategory2" class="fa fa-plus-square-o"> </a></h4></span>
                                </h4>


                            </div>

                            <div class="stats-body">
                                <ul class="list-unstyled __apend_box2">
                                    <li class="">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                    <li class="last">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                </ul>
                            </div>
                        </div>

                        
                        
                        <div class="clearfix"> </div>

                        
                    </div>

                    <div class="row">

                        <div class="col-md-3 stats-info widget-shadow" style="display: none" id="subcategory_3">
                            <div class="stats-title">
                                <h4 class="title">
                                    Sub Categories 3
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addsubcategory3" class="fa fa-plus-square-o"> </a></h4></span>
                                </h4>


                            </div>

                            <div class="stats-body">
                                <ul class="list-unstyled __apend_box3">
                                    <li class="">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                    <li class="last">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                </ul>
                            </div>
                        </div>

                        <span class="col-md-1"></span>

                        <div class="col-md-3 stats-info widget-shadow" style="display: none" id="subcategory_4">
                            <div class="stats-title">
                                <h4 class="title">
                                    Sub Categories 4
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addsubcategory4" class="fa fa-plus-square-o"> </a></h4></span>
                                </h4>


                            </div>

                            <div class="stats-body">
                                <ul class="list-unstyled __apend_box4">
                                    <li class="">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                    <li class="last">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                </ul>
                            </div>
                        </div>

                        <span class="col-md-1"></span>

                        <div class="col-md-3 stats-info widget-shadow" style="display: none" id="subcategory_5">
                            <div class="stats-title">
                                <h4 class="title">
                                    Sub Categories 5
                                    <span><h4 class="pull-right"><a href="#" data-toggle="modal" data-target="#addsubcategory5" class="fa fa-plus-square-o"> </a></h4></span>
                                </h4>


                            </div>

                            <div class="stats-body">
                                <ul class="list-unstyled __apend_box5">
                                    <li class="">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                    <li class="last">
                                        <a href="#">GoogleChrome</a><h5 class="pull-right"><a href="#"> <span class="fa fa-pencil-square-o"></span></a></h5>

                                    </li>

                                </ul>
                            </div>
                        </div>



                        <div class="clearfix"> </div>


                    </div>
                    

                    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="gridSystemModalLabel">Categories</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-2">Category:</div>
                                        <div class="col-md-4">
                                            
                                           
                                                <select name="selector1" id="selector1" class="col-md-12">
                                                    <option>Lorem ipsum dolor sit amet.</option>
                                                    <option>Dolore, ab unde modi est!</option>
                                                    <option>Illum, fuga minus sit eaque.</option>
                                                    <option>Consequatur ducimus maiores voluptatum minima.</option>
                                                </select>
                                           
                                             
                                        </div>
                                        <div class="col-md-1">OR </div>
                                        <div class="col-md-5">enter new: <input class="col-md-7 pull-right " type="text" /></div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-3">Sub Category 1:</div>
                                        <div class="col-md-3"><input class="col-md-12 pull-left " type="text" /></div>
                                        <div class="col-md-3">Sub Category 2:</div>
                                        <div class="col-md-3"><input class="col-md-12 pull-left " type="text" /></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Sub Category 3:</div>
                                        <div class="col-md-3"><input class="col-md-12 pull-left " type="text" /></div>
                                        <div class="col-md-3">Sub Category 4:</div>
                                        <div class="col-md-3"><input class="col-md-12 pull-left " type="text" /></div>
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

                
                <div class="row stats-atinder widget-shadow" >

 <table id="all_category_data">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Category Title</th>
                                <th>SubCategory Title</th>
                                <th>SubCategory2 Title</th>
                                <th>SubCategory3 Title</th>
                                <th>SubCategory4 Title</th>
                                <th>SubCategory5 Title</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $i=1; foreach($all_category_data as $category) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $category->category_title; ?></td>
                                <td><?php echo $category->subcategory_title; ?></td>
                                <td><?php echo $category->subcategory_title2; ?></td>
                                <td><?php echo $category->subcategory_title3; ?></td>
                                <td><?php echo $category->subcategory_title4; ?></td>
                                <td><?php echo $category->subcategory_title5; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                   
                
                  
        </div>
            </div>
 <?php $this->load->view('layouts/footer'); ?>

 <?php $this->load->view('assets/categoryindex'); ?>

 