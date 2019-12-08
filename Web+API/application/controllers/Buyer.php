<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';
class Buyer extends api {

 

/***************** create User Group Api **********/
    public function createGroup_post(){
        $data = $this->input->post();

        $userProfile = $this->BuyerModel->get_user_profile_details($this->user_id);
        if($userProfile->location == "" || $userProfile->name == "" || $userProfile->email == "" || $userProfile->contact_number == "" || $userProfile->age == ""){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Your profile is not completed.Please complete your profile first',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
                return false;
        }
        /* form validation */
        $this->load->library('form_validation');

        $this->form_validation->set_rules('group_name', 'Group Name', 'required');
        $this->form_validation->set_rules('members_count', 'No of members', 'trim|numeric');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|valid_date');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|valid_date');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|numeric');
        if($this->form_validation->run() == TRUE){
            $data['user_id'] = $this->user_id;
            $result = array();
            if(count($_FILES) == 0){
                $data['file_name'] = null;
                    $result = $this->BuyerModel->create_group($data);

                    log_message('debug',print_r($result,TRUE));

                    $this->BuyerModel->join_group($this->user_id,$result['group_id']);
            }else{
                $ext = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);           
                $target_folder="groupImages/";        
                $file_path = $target_folder;           
                $file_name =time().'.'.$ext; 
                $file_tmp_name = $_FILES['uploaded_file']['tmp_name'];
                move_uploaded_file($file_tmp_name, $file_path.$file_name);
                $data['file_name'] = $file_name;
                $result = $this->BuyerModel->create_group($data);
                  log_message('debug',print_r($result,TRUE));
                $this->BuyerModel->join_group($this->user_id,$result['group_id']);

            }
            if($result){

                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Group is created & successfully submitted for approval,we will take just few minutes.Check your MY Interest section',
                    'data' => $result
                    ];
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }else{
                    $response[$this->config->item('rest_status_field_name')] = false;
                    $response[$this->config->item('rest_message_field_name')] =  "Group not created Successfully";
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
        }
        else
        {
            $response[$this->config->item('rest_status_field_name')] = false;
            $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }



      public function editGroup_post(){
        $data = $this->input->post();

      
        $this->load->library('form_validation');
       
       // $this->form_validation->set_rules('end_date', 'End date1', 'trim|valid_date');
       // $this->form_validation->set_rules('category_id', 'Category', 'trim|numeric');
       // if($this->form_validation->run() == TRUE){
            $data['user_id'] = $this->user_id;
            $result = array();
                           
                $result = $this->BuyerModel->update_group($data);

                        
            if($result){

                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Your interest is re-submitted, stay tuned for getting offers in this Interest'
                   
                    ];
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }else{
                    $response[$this->config->item('rest_status_field_name')] = false;
                    $response[$this->config->item('rest_message_field_name')] =  "Group not update Successfully";
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
        //}
        
    }




    //Update Channel Key


public function updateChannelKey_post(){
        $data = $this->input->post();

      //  $userProfile = $this->BuyerModel->get_user_profile_details($this->user_id);
       
        /* form validation */
      
      //  if($this->form_validation->run() == TRUE){
           // ['user_id'] = $this->user_id;
            // $data['group_id'] = $this->user_id;
           // $result = array();

            $result= $this->BuyerModel->UpdateGroup($data);
           
            if($result){

                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'update'
                    
                    ];
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }else{
                    $response[$this->config->item('rest_status_field_name')] = false;
                    $response[$this->config->item('rest_message_field_name')] =  "something Wrong";
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
       // }
        // else
        // {
        //     $response[$this->config->item('rest_status_field_name')] = false;
        //     $response[$this->config->item('rest_message_field_name')] =  $this->form_validation->error_array();
        //     $this->set_response($response, REST_Controller::HTTP_OK);
        // }
    }






/**************** Get Create Group details Api ****************/
    public function getCreateGroups_get(){
        $details = $this->BuyerModel->get_owncreate_group_details($this->user_id);

        if(!empty($details)){
            $array = array();
            foreach($details as $row){
                $array[] = array(
                        'group_id' => $row->group_id,
                         'channelKey' => $row->channelkey,
                        'group_name' => $row->group_name,
                        'group_image' => base_url().'groupImages/'.$row->group_image,
                        'category_id' => $row->category_id,
                        'category_title' => $row->category_title,
                        'subcategory_id' => $row->subcategory_id,
                        'subcategory_title' => $row->subcategory_title,
                        'subcategory_title2' => $row->subcategory_title2,
                        'subcategory_title3' => $row->subcategory_title3,
                        'subcategory_title4' => $row->subcategory_title4,
                        'subcategory_title5' => $row->subcategory_title5,
                        'cost_range' => $row->cost_range,
                        'members_count' => $row->members_count,
                         'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
                        'start_date' => $row->start_date,
                        'end_date' => $row->end_date,
                        'description' => $row->description,
                        'groupstatus' => $row->status
                    );
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting User Created group's Details Successfully",
                    'data' => $array
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }





     public function getGroupsByID_post(){

         $group_id = $this->input->post('group_id');
        $details = $this->BuyerModel->get_group_detailBy_ID($group_id);

        if(!empty($details)){
           // $array = array();
            foreach($details as $row){
                $array = array(
                        'group_id' => $row->group_id,
                        // 'channelKey' => $row->channelkey,
                        'group_name' => $row->group_name,
                        'location' => $row->location,
                        'group_image' => base_url().'groupImages/'.$row->group_image,
                        'category_id' => $row->category_id,
                        'category_title' => $row->category_title,

                        'subcategory_title' => $row->subcategory_title,
                        'subcategory_title2' => $row->subcategory_title2,
                        'subcategory_title3' => $row->subcategory_title3,
                        'subcategory_title4' => $row->subcategory_title4,
                        'subcategory_title5' => $row->subcategory_title5,
                        'subcategory1_id' => $row->subcategory_id,
                        'subcategory2_id' => $row->subcategory2_id,
                        'subcategory3_id' => $row->subcategory3_id,
                        'subcategory4_id' => $row->subcategory4_id,
                        'subcategory5_id' => $row->subcategory5_id,
                       
                        'cost_range' => $row->cost_range,
                        'members_count' => $row->members_count,
                       //  'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
                        'start_date' => $row->start_date,
                        'end_date' => $row->end_date,
                        'description' => $row->description
                        //'groupstatus' => $row->status
                    );
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting  group's Details Successfully",
                    'group_details' => $array
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/**************** Get Create Group details Api ****************/
    public function getUserList_get(){

        $groupIds = $this->BuyerModel->get_groupByUserID($this->user_id);

        if(!empty($groupIds)){

                $grouplist=[];
                $f=-1;
                    
                 foreach($groupIds as $groupID){
                    $f++;
                   // log_message('debug',print_r($checkindate->dated,TRUE));
                    $grouplist[$f] = $groupID->group_id;
                }
                $grouplists = $grouplist;

             $userDetails = $this->BuyerModel->get_UserListByGroup($grouplists,$this->user_id);
            $array = array();
            foreach($userDetails as $row){
                $array[] = array(
                        'user_id' => $row->user_id,
                        'name' => $row->name.' '.$row->lastName,
                      //  'lastName' => $row->lastName,
                        'profile_image' =>$row->profile_image==''?'':base_url().'userImages/'.$row->profile_image,
                        'location' => $row->location,
                        'email' => $row->email
                      
                    );
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting User Details Successfully",
                    'data' => $array
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }





/************** get All Advertisement details api ************/
    public function getAllAdvertisements_post(){
        $data = $this->input->post();
        $id = $this->input->post('category_id');
        $user_id = $this->user_id;
       $result = $this->BuyerModel->get_all_advertisements($id,$data);
        $details = array();
        if($result){
            $imageArray =array();
            foreach($result as $row){
                 $imagesDetails = $this->BuyerModel->get_advertisement_images_by_id($row->advertisement_id);
                 if($imagesDetails){
                        foreach($imagesDetails as $images){
                            $imageArray[] = array(
                                    'advertisement_id' => $images->advertisement_id,
                                    'image_id' => $images->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$images->image_path
                                );
                        }

                 }
                    $coupon_code_details=$this->BuyerModel->check_buyer_coupon_code($user_id,$row->advertisement_id);
                    $seller_contact=$this->BuyerModel->getSellerContact($row->advertisement_id);

                    $email=$seller_contact->email;
                    $contact_number=$seller_contact->contact_number;
                     $address=$seller_contact->address;
                    $name=$seller_contact->name.' '.$seller_contact->lastName;
                     $seller_id=$seller_contact->createdby_userid;

                       $result = $this->BuyerModel->getLikedCount($row->advertisement_id);

                     $isLiked = $this->BuyerModel->isLiked($row->advertisement_id,$user_id);


           //print_r($imagesDetails);
                    $details[] = array(
                            'advertisement_id' => $row->advertisement_id,
                            'advertisement_name'=> $row->advertisement_name,
                            'activeStatus' => $row->status,
                            'end_date' => $row->end_date,
                            'views_count' => $row->views_count,
                            'group_count' => $row->group_count,
                            'start_date'=>$row->start_date,
                            'advertisement_details'=>$row->advertisement_details,
                            'Favourite'=> $this->BuyerModel->get_favAdsStatus($user_id,$row->advertisement_id),
                            'seller_contact'=>$contact_number,
                            'seller_email'=>$email,
                            'seller_name'=>$name,
                            'seller_id' =>$seller_id,
                            'rating'=>$this->BuyerModel->getRating($seller_id),
                             'selfRating'=>$this->BuyerModel->getselfRating($user_id,$seller_id)==null?0:$this->BuyerModel->getselfRating($user_id,$seller_id),
                            'address'=>$address,
                            'start_date'=>$row->start_date,
                            'category_title'=>$row->category_title,
                            'subcategory_title'=>$row->subcategory_title,
                            'subcategory_title2'=>$row->subcategory_title2,
                            'subcategory_title3'=>$row->subcategory_title3,
                            'subcategory_title4'=>$row->subcategory_title4,
                            'subcategory_title5'=>$row->subcategory_title5,
                            'location'=>$row->location,
                             'min_user_count'=>$row->min_user_count,
                              'actual_price'=>$row->actual_price,
                            'offer_price'=>$row->offer_price,
                            'cashback_per_user'=>$row->cashback_per_user,
                            'coupon_code' => $coupon_code_details,
                            'purchasedCount'=>$this->SellerModel->get_purchasedCount($row->advertisement_id),
                            'pendingCount'=>$this->SellerModel->get_pendiingCount($row->advertisement_id),
                            'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($row->advertisement_id),
                             'likedcount' => $result,
                            'isliked'=>$isLiked==null?0:$isLiked,
                            'isRatingOption'=>$this->BuyerModel->isratingoption($user_id,$row->advertisement_id),

                            'images_details' => $imageArray
                        );
                    $imageArray =array();

            }
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Get All Advertisements Successfully",
                    'data' => $details
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


     public function getAllFavAdvertisements_post(){
        $data = $this->input->post();
        
        $user_id = $this->user_id;
       $result = $this->BuyerModel->get_all_favadvertisements($user_id);
        $details = array();
        if($result){
            $imageArray =array();
            foreach($result as $row){
                 $imagesDetails = $this->BuyerModel->get_advertisement_images_by_id($row->advertisement_id);
                 if($imagesDetails){
                        foreach($imagesDetails as $images){
                            $imageArray[] = array(
                                    'advertisement_id' => $images->advertisement_id,
                                    'image_id' => $images->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$images->image_path
                                );
                        }

                 }
                   $coupon_code_details=$this->BuyerModel->check_buyer_coupon_code($user_id,$row->advertisement_id);
                   $seller_contact=$this->BuyerModel->getSellerContact($row->advertisement_id);

                    $email=$seller_contact->email;
                    $contact_number=$seller_contact->contact_number;
                     $address=$seller_contact->address;
                    $name=$seller_contact->name.' '.$seller_contact->lastName;
                    $seller_id = $seller_contact->createdby_userid;

                      $result = $this->BuyerModel->getLikedCount($row->advertisement_id);

                     $isLiked = $this->BuyerModel->isLiked($row->advertisement_id,$user_id);
           //print_r($imagesDetails);
                    $details[] = array(
                            'advertisement_id' => $row->advertisement_id,
                            'advertisement_name'=> $row->advertisement_name,
                            'activeStatus' => $row->status,
                            'end_date' => $row->end_date,
                            'views_count' => $row->views_count,
                            'group_count' => $row->group_count,
                            'start_date'=>$row->start_date,
                            'advertisement_details'=>$row->advertisement_details,
                            'Favourite'=> $this->BuyerModel->get_favAdsStatus($user_id,$row->advertisement_id),
                            'seller_contact'=>$contact_number,
                            'seller_email'=>$email,
                            'seller_name'=>$name,
                            'seller_id' =>$seller_id,
                            'address'=>$address,
                            'start_date'=>$row->start_date,
                            'category_title'=>$row->category_title,
                            'subcategory_title'=>$row->subcategory_title,
                            'subcategory_title2'=>$row->subcategory_title2,
                            'subcategory_title3'=>$row->subcategory_title3,
                            'subcategory_title4'=>$row->subcategory_title4,
                            'subcategory_title5'=>$row->subcategory_title5,
                            'location'=>$row->location,
                             'actual_price'=>$row->actual_price,
                            'offer_price'=>$row->offer_price,
                            'cashback_per_user'=>$row->cashback_per_user,
                            'coupon_code'=>$coupon_code_details,
                            'purchasedCount'=>$this->SellerModel->get_purchasedCount($row->advertisement_id),
                            'pendingCount'=>$this->SellerModel->get_pendiingCount($row->advertisement_id),
                            'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($row->advertisement_id),
                             'likedcount' => $result,
                            'isliked'=>$isLiked==null?0:$isLiked,
                            'isRatingOption'=>$this->BuyerModel->isratingoption($user_id,$row->advertisement_id),

                            'images_details' => $imageArray
                        );
                    $imageArray =array();

            }
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Get All  Favourite Advertisements Successfully",
                    'data' => $details
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/*************** get a particuler Advertisement by ad_id  **********/
    public function getAdvertisement_post(){
        $id = $this->input->post('advertisement_id');
        $user_id = $this->user_id;
        if(!is_numeric($id)){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Advertisement ID is not valid',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }


        $data = $this->BuyerModel->get_advertisement_by_id($id);

        $coupon_code_details=$this->BuyerModel->check_buyer_coupon_code($user_id,$id);

        $image_details = array();

        if($data){
            $image_details = array();
             foreach($data as $row){
            $result = $this->BuyerModel->insert_view_details($user_id,$id);
            if($result){
                $getviewcount = $this->BuyerModel->get_view_user_count($id);
                $this->BuyerModel->insert_total_view_count($getviewcount,$id,$user_id,'');
            }
            $images = $this->BuyerModel->get_advertisement_images_by_id($id);
            if($images){
                    foreach($images as $row1){
                        $image_details[] = array(
                                    'advertisement_id' => $row1->advertisement_id,
                                    'image_id' => $row1->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$row1->image_path
                            );
                    }
            }
  $seller_contact=$this->BuyerModel->getSellerContact($id);

                    $email=$seller_contact->email;
                    $contact_number=$seller_contact->contact_number;
                     $address=$seller_contact->address;
                    $name=$seller_contact->name.' '.$seller_contact->lastName;
                    $seller_id = $seller_contact->createdby_userid;
                      $result = $this->BuyerModel->getLikedCount($id);

                     $isLiked = $this->BuyerModel->isLiked($id,$user_id);

$details[] = array(
                            'advertisement_id' => $row->advertisement_id,
                            'advertisement_name'=> $row->advertisement_name,
                            'activeStatus' => $row->status,
                            'end_date' => $row->end_date,
                            'views_count' => $row->views_count,
                            'group_count' => $row->group_count,
                            'start_date'=>$row->start_date,
                            'advertisement_details'=>$row->advertisement_details,
                             'selfRating'=>$this->BuyerModel->getselfRating($user_id,$seller_id)==null?0:$this->BuyerModel->getselfRating($user_id,$seller_id),
                            'seller_contact'=>$contact_number,
                            'seller_email'=>$email,
                            'seller_name'=>$name,
                            'seller_id'=>$seller_id,
                            'rating'=>$this->BuyerModel->getRating($seller_id),
                            'address'=>$address,
                            'start_date'=>$row->start_date,
                            'category_title'=>$row->category_title,
                            'subcategory_title'=>$row->subcategory_title,
                            'subcategory_title2'=>$row->subcategory_title2,
                            'subcategory_title3'=>$row->subcategory_title3,
                            'subcategory_title4'=>$row->subcategory_title4,
                            'subcategory_title5'=>$row->subcategory_title5,
                            'location'=>$row->location,
                            'min_user_count'=>$row->min_user_count,
                             'actual_price'=>$row->actual_price,
                            'offer_price'=>$row->offer_price,
                            'cashback_per_user'=>$row->cashback_per_user,
			    'offerforx'=>$row->offerforx,
			    'quantity_per_user'=>$row->quantity_per_user,
                            'coupon_code' => $coupon_code_details,
                            'purchasedCount'=>$this->SellerModel->get_purchasedCount($row->advertisement_id),
                            'pendingCount'=>$this->SellerModel->get_pendiingCount($row->advertisement_id),
                            'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($row->advertisement_id),
                             'likedcount' => $result,
                            'isliked'=>$isLiked==null?0:$isLiked,
                            'isRatingOption'=>$this->BuyerModel->isratingoption($user_id,$row->advertisement_id),

                            'images_details' => $image_details
                        );
                    $image_details =array();
                }


            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Advertisement Details Successfully",
                    'data' => $details
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
        
    }

/*********** Get All categories for user ************/
    public function getAllCategories_get(){
        $data = $this->BuyerModel->get_all_categories_details();

        $banner = $this->BuyerModel->getbanner();

        $mostLikedAds=[];

        if($data){
            $group_count = '';
            foreach($data as $row){
                $category_id = $row->category_id;

                	$groups=$this->BuyerModel->get_all_groupIds($category_id);


				$grouplist=[];
                $f=-1;
                    
                 foreach($groups as $groupID){
                    $f++;
                   // log_message('debug',print_r($checkindate->dated,TRUE));
                    $grouplist[$f] = $groupID->group_id;
                }
                $grouplists = $grouplist;

 				$row->groupIDs = $grouplists;




                $group_count = $this->BuyerModel->get_group_count($category_id);
                $advertisement_count = $this->BuyerModel->get_advertisement_count($category_id);
             
                $row->group_count = $group_count;
               // $row->posts = '+'. $advertisement_count. ' posts';

                  $row->posts =  $advertisement_count;

                $images = $this->BuyerModel->get_group_images($category_id);

              
                $row->images =$row->category_image==''?'':base_url().'CategoryImages/'.$row->category_image;


            }

           $advertisement=$this->BuyerModel->getmostlikedads();

             foreach($advertisement as $ads){

             	$imageArray =array();
             	$image_path='';
            
                 $imagesDetails = $this->BuyerModel->get_advertisement_images_by_id($ads->advertisement_id);
                 if($imagesDetails){

                 	$image_path=base_url().'advertisementImages/'.$imagesDetails[0]->image_path;
                 }




                $mostLikedAds[] = array(
                        'advertisement_id' => $ads->advertisement_id,
                        'end_date' => $ads->end_date,
                        'advertisement_name'=>$ads->advertisement_name,
                        'actual_price'=>$ads->actual_price,
                        'offer_price'=>$ads->offer_price,
                        'name'=>$ads->name.' '.$ads->lastName,
                        'image'=>$image_path
                       
                    ); 
            }

            $resultArray=[];

            foreach($banner as $ban){
                $resultArray[] = array(
                        'ID' => $ban->ID,
                        'image_name' => base_url().'bannerImage/'.$ban->image_name,
                        'order_number'=>$ban->order_number
                       
                    ); 
            }
            $result['categories']=$data;

            $result['banner']=$resultArray;
            $result['advertisement']=$mostLikedAds;

  log_message('debug',print_r($result,TRUE));

            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Categories Details Successfully",
                    'detail' => $result
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/********** Get category By group's details Api *********/
    public function getCategoryWisedGroups_post(){
        $id = $this->input->post('category_id');
         $search_text = $this->input->post('search_text');
         $user_id = $this->user_id;
          $data = $this->input->post();

         // $start_date = $this->input->post('start_date');

        if(!is_numeric($id)){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Category ID is not valid',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }

        $details = $this->BuyerModel->get_category_by_groups($id,$search_text,$data);
        $resultArray = array();
        if($details){
            foreach($details as $row){
                $resultArray[] = array(
                        'group_id' => $row->group_id,
                        'channelKey' => $row->channelkey,
                        'created_by'=>$row->created_by,
                        'profile_image' => base_url().'userImages/'.$row->profile_image,
                        'name' => $row->name,
                        'location' => $row->location,
                        'groupLocation'=>$row->groupLocation,
                        'category_id' => $row->category_id,
                        'category_title' => $row->category_title,
                        'subcategory_id' => $row->subcategory_id,
                        'subcategory_title' => $row->subcategory_title,
                        'subcategory_title2' => $row->subcategory_title2,
                        'subcategory_title3' => $row->subcategory_title3,
                        'subcategory_title4' => $row->subcategory_title4,
                        'subcategory_title5' => $row->subcategory_title5,
                        'rating' => $row->rating,
                        'Favourite'=> $this->BuyerModel->get_favStatus($user_id,$row->group_id),
                         
                         'group_name' => $row->group_name,
                        'group_image' => base_url().'groupImages/'.$row->group_image,
                        'cost_range' => $row->cost_range,
                        'start_date' => $row->start_date,
                        'end_date' => $row->end_date,
                        'members_count' => $row->members_count,
                        'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
                        'description' => $row->description,
                        'join_status' => $this->BuyerModel->get_joinStatus($user_id,$row->group_id)==''?0:$this->BuyerModel->get_joinStatus($user_id,$row->group_id)
                    ); 
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting all Categorie's related Group Details Successfully",
                    'data' => $resultArray
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/*********** Get Groups details by group Id Api *************/
    public function getGroupDetails_post(){
        $id = $this->input->post('group_id');
        $category_id = $this->input->post('category_id');
         $user_id = $this->user_id;

        if(!is_numeric($id)){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Group ID is not valid',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }
        $member_details = array();
        $groupArray = array();
        $imageArray = array();
        $memberArray = array();
        $mostLikedAds=array();
        $details = $this->BuyerModel->get_group_details($id);
        if($details){
            foreach($details as $row){
                $groupArray = array(
                        'group_id' => $row->group_id,
                        'channelKey' => $row->channelkey,
                        'created_by'=>$row->created_by,
                         'group_name' => $row->group_name,
                          'groupLocation'=>$row->groupLocation,
                        'profile_image' =>$row->profile_image==''?'': base_url().'userImages/'.$row->profile_image,
                        'name' => $row->name,
                        'location' => $row->location,
                        'category_title' => $row->category_title,
                        'subcategory_id' => $row->subcategory_id,
                        'subcategory_title' => $row->subcategory_title,
                        'subcategory_title2' => $row->subcategory_title2,
                        'subcategory_title3' => $row->subcategory_title3,
                        'subcategory_title4' => $row->subcategory_title4,
                        'subcategory_title5' => $row->subcategory_title5,
                        'rating' => $row->rating,
                        'group_image' => base_url().'groupImages/'.$row->group_image,
                        'cost_range' => $row->cost_range,
                        'start_date'=>$row->start_date,
                        'end_date' => $row->end_date,
                        'members_count' => $row->members_count,
                        'join_Member'=>$this->BuyerModel->getJoinMember($id),
                        'description' => $row->description,
                        'join_status' => $this->BuyerModel->get_joinStatus($user_id,$row->group_id)==''?0:$this->BuyerModel->get_joinStatus($user_id,$row->group_id)
                    ); 
            }
            $member_details = $this->BuyerModel->get_group_members($id);
                foreach($member_details as $member){
                    $memberArray[] = array(
                            'user_id' => $member->user_id,
                            'profile_image' =>$member->profile_image==''?'':base_url().'userImages/'.$member->profile_image,
                            'name' => $member->name,
                            'location' => $member->location
                        );
                }

            $getAdvertisements = $this->BuyerModel->get_advertisement_details($category_id);
            foreach($getAdvertisements as $row){
                    $advertisement_id = $row->advertisement_id;
                    $adv_id[] = $advertisement_id;
                    $user_id = $this->user_id;
                    $result = $this->BuyerModel->insert_groups($advertisement_id,$id,$user_id);

                    $groupcount = $this->BuyerModel->advertisement_count($advertisement_id);
                    $this->BuyerModel->insert_total_group_view_count($groupcount,$advertisement_id,$user_id);

}

 $advertisement=$this->BuyerModel->get_advertisement_images_for_group($id);

             foreach($advertisement as $ads){

             	$imageArray =array();
             	$image_path='';
            
                 $imagesDetails = $this->BuyerModel->get_advertisement_images_by_id($ads->advertisement_id);
                 if($imagesDetails){

                 	$image_path=base_url().'advertisementImages/'.$imagesDetails[0]->image_path;


                        // foreach($imagesDetails as $images){
                        //     $imageArray[] = array(
                        //             'advertisement_id' => $images->advertisement_id,
                        //             'image_id' => $images->image_id,
                        //             'image_path' => base_url().'advertisementImages/'.$images->image_path
                        //         );
                        // }

                 }




                $mostLikedAds[] = array(
                        'advertisement_id' => $ads->advertisement_id,
                        'end_date' => $ads->end_date,
                        'advertisement_name'=>$ads->advertisement_name,
                        'actual_price'=>$ads->actual_price,
                        'offer_price'=>$ads->offer_price,
                        'name'=>$ads->name.' '.$ads->lastName,
                        'image'=>$image_path
                       
                    ); 
            }






                // $images = $this->BuyerModel->get_advertisement_images_for_group($id);

                // if($images){
                //         foreach($images as $image){
                //             $imageArray[] = array(
                //                     'advertisement_id' => $image->advertisement_id,
                //                     'image_id' => $image->image_id,
                //                     'image_path' => base_url().'advertisementImages/'.$image->image_path
                //                 );
                //         }

                // }
                    
          //  }

            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Group Details Successfully",
                    'data' => array('group_details'=> $groupArray,'member_details'=> $memberArray,'advertisement' => $mostLikedAds)
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }

    }

/**************** user's group mark as join api ***********/
    public function joinGroup_post(){
        $group_id = $this->input->post('group_id');
        $user_id = $this->user_id;

        $groups = $this->BuyerModel->get_group_details_by_id($group_id);

        if(!$groups){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Invalid ID',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }

        
        // if($groups->members_count == $groups->check_join_count){
        //     $response = [
        //             $this->config->item('rest_status_field_name') => false,
        //             $this->config->item('rest_message_field_name') => 'You can not join this group',
        //         ];
        //     $this->set_response($response, REST_Controller::HTTP_OK);
        // }else{
            $check_details = $this->BuyerModel->check_user_details($user_id,$group_id);

             log_message('debug',print_r($check_details,TRUE));
            if($check_details){
                if($check_details->join_status == 1){
                     $response = [
                            $this->config->item('rest_status_field_name') => false,
                            $this->config->item('rest_message_field_name') => 'Already Join this group',
                        ];
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }

            }
                    $result = $this->BuyerModel->join_group($user_id,$group_id);
                    if($result){                       

                        $details = $this->BuyerModel->get_user_count($group_id);
                        if($details){
                            $update_join_count = $this->BuyerModel->update_join_count($group_id,$details);

                         $username= $this->BuyerModel->getUserName($user_id);
                            $msg_body=array(

                            'group_id'=> $group_id , 
                            'type'=>'user',
                             'notificationType'=>'dashboard',
                            'category_id'    =>   $groups->category_id,
                            'user_id'=>      $groups->createdby_userid  ,            
                            'title'   =>'GoGroup' , 
                             'description'=> 'New member '. $username .'has joined the group ' .$groups->group_name. 'There are '. $details .'members in the group now.'
                             );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($groups->createdby_userid) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);



                        }
                        $response = [
                                $this->config->item('rest_status_field_name') => true,
                                $this->config->item('rest_message_field_name') => "join group Successfully",
                                
                            ];
                        $this->set_response($response, REST_Controller::HTTP_OK);
                    }else{
                        $response = [
                                $this->config->item('rest_status_field_name') => false,
                                $this->config->item('rest_message_field_name') =>'join group not successfully',
                            ];
                            $this->set_response($response, REST_Controller::HTTP_OK);
                    }
        
        //}
        
    }




     public function exitGroup_post(){
        $group_id = $this->input->post('group_id');
        $user_id = $this->user_id;

        $groups = $this->BuyerModel->get_group_details_by_id($group_id);

                 $details = $this->BuyerModel->get_user_count($group_id);
       
                    $result = $this->BuyerModel->exit_group($user_id,$group_id);

                    if($result){

                         $username= $this->BuyerModel->getUserName($user_id);
                            $msg_body=array(
                            'group_id'=> $group_id , 
                            'type'=>'user',
                             'notificationType'=>'dashboard',
                            'category_id'    =>   $groups->category_id,
                            'user_id'=>      $groups->createdby_userid  ,            
                            'title'   =>'GoGroup' , 
                             'description'=> $username.' has left the group '.  $groups->group_name.' There are'. $details.' members in the group now.'

                           
                                         );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($groups->createdby_userid) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                                     log_message('debug',print_r($deviceTokens,TRUE));

                                     log_message('debug',print_r($msg_body,TRUE));

                                     log_message('debug',print_r('joinGroup22',TRUE));

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);





                        $response = [
                                $this->config->item('rest_status_field_name') => true,
                                $this->config->item('rest_message_field_name') => "Exit Group Successfully",
                                
                            ];
                        $this->set_response($response, REST_Controller::HTTP_OK);
                    }else{
                        $response = [
                                $this->config->item('rest_status_field_name') => false,
                                $this->config->item('rest_message_field_name') =>'exit group not successfully',
                            ];
                            $this->set_response($response, REST_Controller::HTTP_OK);
                    }
        
        //}
        
    }

/********** get user's joined group's details ***********/
    public function getJoinedGroups_get(){
        $user_id = $this->user_id;

        $result = $this->BuyerModel->get_joined_group_details($user_id);
        $resultArray = array();
        if($result){
            foreach($result as $row){
                    $resultArray[] = array(
                                'group_id' => $row->group_id,
                                'channelKey' => $row->channelkey,
                                'group_name' => $row->group_name,
                                'group_image' => base_url().'groupImages/'.$row->group_image,
                                'category_id' => $row->category_id,
                                'category_title' => $row->category_title,
                                'subcategory_id' => $row->subcategory_id,
                                'subcategory_title' => $row->subcategory_title,
                                'subcategory_title2' => $row->subcategory_title2,
                                'subcategory_title3' => $row->subcategory_title3,
                                'subcategory_title4' => $row->subcategory_title4,
                                'subcategory_title5' => $row->subcategory_title5,
                                'cost_range' => $row->cost_range,
                                'members_count' => $row->members_count,
                                 'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
                                'start_date' => $row->start_date,
                                'end_date' => $row->end_date,
                                'description' => $row->description,
                                'groupstatus' => $row->status,
                                'join_status' => $row->join_status
                        );
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Joined Group Details Successfully",
                    'data' => $resultArray
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/******** get group member's details api ***********/
    public function groupMemberDetail_post(){
        $member_id = $this->input->post('member_id');
      
       
        $memberDetails = array();
        $createdGroups  = array();
        $joinedGroups = array();
        $details = $this->BuyerModel->get_member_detail_by_id($member_id);
        if($details){
            foreach($details as $row){
                    $memberDetails = array(
                            'name' => $row->name,
                            'location' => $row->location,
                            'email' => $row->email,
                            'contact_number' => $row->contact_number,
                            'profile_image' =>$row->profile_image==''?'':base_url().'userImages/'.$row->profile_image
                        );
            }
            $createdGroupDetails = $this->BuyerModel->get_create_group_details($member_id);
            if($createdGroupDetails){
                foreach($createdGroupDetails as $created){
                        $createdGroups[] = array(
                                'group_id' => $created->group_id,
                                'channelKey' => $created->channelkey,
                                'group_name' => $created->group_name,
                                'group_image' =>$created->group_image==''?'':base_url().'groupImages/'.$created->group_image,
                                'category_id' => $created->category_id,
                                'category_title' => $created->category_title,
                                'subcategory_id' => $created->subcategory_id,
                                'subcategory_title' => $created->subcategory_title,
                                'subcategory_title2' => $created->subcategory_title2,
                                'subcategory_title3' => $created->subcategory_title3,
                                'subcategory_title4' => $created->subcategory_title4,
                                'subcategory_title5' => $created->subcategory_title5,
                                'cost_range' => $created->cost_range,
                                'join_Member'=>$this->BuyerModel->getJoinMember($created->group_id),
                                'members_count' => $created->members_count,
                                'start_date' => $created->start_date,
                                'end_date' => $created->end_date,
                                'description' => $created->description,
                                'groupstatus' => $created->status,
                                 'join_status' =>$this->BuyerModel->get_joinStatus($this->user_id,$created->group_id)==''?0:$this->BuyerModel->get_joinStatus($this->user_id,$created->group_id)
                            );
                }
            }
            $joinedGroupDetails = $this->BuyerModel->get_joined_group_details($member_id);
            if($joinedGroupDetails){
                foreach($joinedGroupDetails as $joined){
                    $joinedGroups[] = array(
                            'group_id' => $joined->group_id,
                            'channelKey' => $joined->channelkey,
                            'group_name' => $joined->group_name,
                            'group_image' =>$joined->group_image==''?'':base_url().'groupImages/'.$joined->group_image,
                            'category_id' => $joined->category_id,
                            'category_title' => $joined->category_title,
                            'subcategory_id' => $joined->subcategory_id,
                            'subcategory_title' => $joined->subcategory_title,
                            'subcategory_title' => $joined->subcategory_title2,
                            'subcategory_title' => $joined->subcategory_title3,
                            'subcategory_title' => $joined->subcategory_title4,
                            'subcategory_title' => $joined->subcategory_title5,
                            'cost_range' => $joined->cost_range,
                            'members_count' => $joined->members_count,
                             'join_Member'=>$this->BuyerModel->getJoinMember($joined->group_id),
                            'start_date' => $joined->start_date,
                            'end_date' => $joined->end_date,
                            'description' => $joined->description,
                            'groupstatus' => $joined->status,
                            'join_status' =>$this->BuyerModel->get_joinStatus($this->user_id,$joined->group_id)==''?0:$this->BuyerModel->get_joinStatus($this->user_id,$joined->group_id)
                        );
                }
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Members details Successfully",
                    'data' => array('member_details'=> $memberDetails , 'created_groups'=> $createdGroups,'joined_groups'=> $joinedGroups)
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No Data Found',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/*********** Get View User's details of particular Advertisement Api ********/
    public function getViewUsersDetails_post(){
        $id = $this->input->post('advertisement_id');

        if(!$id){
             $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => array('Advertisement ID is not valid'),
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }

        $result = $this->BuyerModel->get_view_user_details($id);
        $detailsArray = array();
        if($result){
            foreach($result as $row){
                $detailsArray = array(
                        'name' => $row->name,
                        'location' => $row->location,
                        'profile_image' => base_url().'userImages/'.$row->profile_image,
                        'category_title' => $row->category_title
                    ); 
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => array("Getting Members details Successfully"),
                    'data' => $detailsArray
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => array('No data found'),
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }

/************ Mark group as Favourite api ************/
    public function MarkFavouriteGroup_post(){
        $group_id = $this->input->post('group_id');
         $status = $this->input->post('status');
        $user_id = $this->user_id;

        $groups = $this->BuyerModel->get_group_details_by_id($group_id);
        if(!$groups){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Invalid GroupID',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
            return false;
        }

        $result = $this->BuyerModel->mark_favourite_group($group_id,$user_id,$status);

        $msg=$status=='1'?"Added in Shortlisted section":"Removed from Shortlisted section";

        if($result){
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => $msg,
                     'data'=> array('Status' => $status)

                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No Group marked as favourite successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }

    }

  public function MarkFavouriteAds_post(){
        $advertisement_id = $this->input->post('advertisement_id');
         $status = $this->input->post('status');
        $user_id = $this->user_id;

       
        $result = $this->BuyerModel->mark_favourite_Ads($advertisement_id,$user_id,$status);

        $msg=$status=='1'?" Added in Shortlisted section":"Removed from Shortlisted section";

        if($result){
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => $msg,
                     'data'=> array('Status' => $status)

                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'No  marked as favourite successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }

    }




/*********** Get All favourite groups Api ***********/
    public function getFavouriteGroups_get(){
        $user_id = $this->user_id;

        $result = $this->BuyerModel->get_favourite_groups_by_user($user_id);
        $resultArray = array();
        if($result){
            foreach($result as $row){
                    $resultArray[] = array(
                            'group_id' => $row->group_id,
                            'profile_image' => base_url().'userImages/'.$row->profile_image,
                            'name' => $row->name,
                            'created_by'=>$row->created_by,
                            'channelKey' => $row->channelkey,
                            'location' => $row->location,
                            'groupLocation'=>$row->location,                           
                            'category_title' => $row->category_title,
                            'subcategory_id' => $row->subcategory_id,
                            'subcategory_title' => $row->subcategory_title,
                            'subcategory_title2' => $row->subcategory_title2,
                            'subcategory_title3' => $row->subcategory_title3,
                            'subcategory_title4' => $row->subcategory_title4,
                            'subcategory_title5' => $row->subcategory_title5,
                            'category_id'=> $row->category_id,
                            'rating' => $row->rating,
                            'Favourite'=> $this->BuyerModel->get_favStatus($user_id,$row->group_id),
                             'group_name' => $row->group_name,
                            'group_image' => base_url().'groupImages/'.$row->group_image,
                            'cost_range' => $row->cost_range,
                            'start_date' => $row->start_date,
                            'end_date' => $row->end_date,
                            'members_count' => $row->members_count,
                            'join_Member'=>$this->BuyerModel->getJoinMember($row->group_id),
                           'description' => $row->description,
                            'join_status' => $this->BuyerModel->get_joinStatus($user_id,$row->group_id)==''?0:$this->BuyerModel->get_joinStatus($user_id,$row->group_id)



                        );
            }
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting favourite groups successfully",
                    'data' => $resultArray
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }

    }

/******** Report Advertisement Api ********/
    public function report_post(){
        $data = $this->input->post();
        $data['user_id'] = $this->user_id;
        $result = $this->BuyerModel->insert_report_advertisement($data);
        if ($result) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Reported successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => ' Reported not successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


 public function pushSeller_post(){
        $data = $this->input->post();
        $data['user_id'] = $this->user_id;
        $result = $this->BuyerModel->insert_report_advertisement($data);
        if ($result) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Reported successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => ' Reported not successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }
/******** Report Advertisement Api ********/


/******** Coupon Advertisement Api Starts********/
  public function generateCouponCode_post()
  {
    $data = $this->input->post();
    $data['user_id'] = $this->user_id;
   

    $is_coupon_earlier_generated = $this->BuyerModel->check_buyer_coupon_code($data['user_id'],$data['advertisement_id']);

    if(!$is_coupon_earlier_generated)
    {
        $result = $this->BuyerModel->insert_coupon_code($data);
        $get_coupon_code = $this->BuyerModel->check_buyer_coupon_code($data['user_id'],$data['advertisement_id']);
        if ($result) {

            $this->Email->coupon_code_generate_email($data,$get_coupon_code);

            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'This'.$get_coupon_code.' is your purchase code and to be shown to seller for purchase after order placing. You can see this in "MY PURCHASE"',
                    'couponCode'=>$get_coupon_code
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => ' Reported not successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }
    else
    {
         $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Coupon Code already generated for this advertisement',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);   
    }
    

  }

  public function getPurchaseList_post()
  {
    $user_id=$this->user_id;
    
    $pageOffSet = 10;
    $pageIndex = $this->input->post('pageIndex')* $pageOffSet;

    $data = $this->BuyerModel->get_purchase_list($user_id,$pageIndex,$pageOffSet);
    $details=array();
    foreach($data as $result)
    {   
        $imageArray = [];
         foreach($result->AdvertisementImages as $images){
                            $imageArray[] = array(
                                    'advertisement_id' => $images->advertisement_id,
                                    'image_id' => $images->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$images->image_path
                                );
                        }

      $details[] = array(
                            'advertisement_id' => $result->advertisement_id,
                            'advertisement_name'=> $result->advertisement_name,
                            'advertisement_Status' => $result->AdvertisementStatus,
                            'end_date' => $result->end_date,
                            'start_date'=>$result->start_date,
                            'advertisement_details'=>$result->advertisement_details,
                            'seller_contact'=>$result->contact_number,
                            'seller_email'=>$result->email,
                            'seller_name'=>$result->name,
                            'address'=>$result->address,
                            'start_date'=>$result->start_date,
                            'category_title'=>$result->category_title,
                            'subcategory_title'=>$result->subcategory_title,
                            'subcategory_title2'=>$result->subcategory_title2,
                            'subcategory_title3'=>$result->subcategory_title3,
                            'subcategory_title4'=>$result->subcategory_title4,
                            'subcategory_title5'=>$result->subcategory_title5,
                            'location'=>$result->location,
                            'min_user_count'=>$result->min_user_count,
                            'actual_price'=>$result->actual_price,
                            'offer_price'=>$result->offer_price,
                            'cashback_per_user'=>$result->cashback_per_user,
                            'coupon_id'	=>$result->coupon_id,
                            'coupon_code'	=>$result->coupon_code,
                            'seller_id'	=>$result->seller_id,
                            'images_details' => $imageArray,
                            'coupon_status' => $result->CouponsStatus,
                            'sequence_of_order'=> $result->CouponsStatus=='purchased'?$result->sequence_of_order:$this->SellerModel->get_sequence_number($result->advertisement_id),
                            'order_ref_id'=>$result->order_ref_id,
                            'seller_location' => $result->location,
                            'seller_image' => base_url().'userImages/'.$result->profile_image,
                            'purchasedCount'=>$this->SellerModel->get_purchasedCount($result->advertisement_id),
                            'pendingCount'=>$this->SellerModel->get_pendiingCount($result->advertisement_id),
                            'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($result->advertisement_id),
                            'order_placed_date'=>$result->order_placed_date,
                            'isRatingOption'=>$this->BuyerModel->isratingoption($user_id,$result->advertisement_id),
                              'purchased_date'=>$result->purchased_date,
	      		'is_approved' => $result->is_approved,
	      		'offerforx' => $result->offerforx,
	      		'quantity'=>$result->quantity
                        );
    }

     if ($details) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Reported successfully',
                    'data' => $details
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                     'data' => $details
                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
  
  }  

  public function purchaseAdvertisement_post()
  {
    $data = $this->input->post();
    $user_id = $this->user_id;
   
    $is_coupon_valid = $this->BuyerModel->check_buyer_coupon_code($user_id,$data['advertisement_id']);

    if($is_coupon_valid && $data['coupon_code']==$is_coupon_valid)
    {
        $get_reference_id = $this->BuyerModel->update_coupon_status($user_id,$data['advertisement_id'],$data['coupon_code'],$data['address'],$data['location'],$data['quantity']);

        if($get_reference_id)
        {
            $this->Email->place_order_email($data,$user_id);

             $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Purchased successfully',
                    'data'=>$get_reference_id
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }  
        else
        {
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Wrong Coupon Entered',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        } 

    }
    else
    {
        $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Purchased not successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
    }
   
  }

/******** Report Advertisement Api Ends********/

/*****************Liked***********************/
public function get_liked_post(){
        $user_id = $this->user_id;

        $advertisement_id = $this->input->post('advertisement_id');

        $result = $this->BuyerModel->getLikedCount($advertisement_id);

        $isLiked = $this->BuyerModel->isLiked($advertisement_id,$user_id);

         $coupon_details = array(
                  
                  'count' => $result,
                  'isliked'=>$isLiked==null?0:$isLiked
                  //'sequence_of_order'=>$this->get_sequence_number($advertisement_id)
                  
                  ); 
      
    
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Getting Joined Group Details Successfully",
                    'data' => $coupon_details
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    



 public function insert_like_post()
  {
    $user_id=$this->user_id;

    $advertisement_id = $this->input->post('advertisement_id');

      $status = $this->input->post('status');    
    $data = $this->BuyerModel->insert_like($advertisement_id,$user_id,$status);

     $result = $this->BuyerModel->getLikedCount($advertisement_id);  
    

     if ($data) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Liked',
                    'likedcount' => $result

                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Liked',
                     'data' => $details
                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
  


  }  


public function insert_rating_post()
  {
    $user_id=$this->user_id;

    $seller_id = $this->input->post('seller_id');

      $rating = $this->input->post('rating');    
    $data = $this->BuyerModel->insert_rating($seller_id,$user_id,$rating);

     $result = $this->BuyerModel->getRating($seller_id);
    

     if ($data) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Rating',
                    'rating' => $result

                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No Liked',
                     'data' => $details
                    
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
  

  
  }  














/********************end**************************/




}
