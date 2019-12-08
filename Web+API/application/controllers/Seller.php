<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/Api.php';
class Seller extends api { 


	public function createAdvertisement_post(){
		$data = $this->input->post();

        log_message('debug',print_r($data,TRUE));

        $userProfile = $this->BuyerModel->get_user_profile_details($this->user_id);
        if($userProfile->location == "" || $userProfile->name == "" || $userProfile->email == "" || $userProfile->contact_number == "" ){
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Your profile is not completed.Please complete your profile first',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
                return false;
        }

		/* form validation */
        $this->load->library('form_validation');

        $this->form_validation->set_rules('members_count', 'No of members', 'trim|numeric');
        $this->form_validation->set_rules('start_date', 'Start date', 'trim|valid_date');
        $this->form_validation->set_rules('end_date', 'End date', 'trim|valid_date');
        $this->form_validation->set_rules('min_user_count', 'Minimum Users', 'trim|numeric');

        if($this->form_validation->run() == TRUE){
        	$data['user_id'] = $this->user_id;
            $result = array();
            if(count($_FILES) == 0){
                $data['file_name'] = '';
                $result = $this->SellerModel->insert_advertisement_details($data);

                 
            }else{

                $result = $this->SellerModel->insert_advertisement_details($data);

                 log_message('debug',print_r($result,TRUE));

 


                $filecount=count($_FILES['uploaded_file']['name']);

                log_message('debug',print_r($filecount,TRUE));

                for ($i=0; $i <=$filecount-1 ; $i++) { 
                    $ext = pathinfo($_FILES['uploaded_file']['name'][$i], PATHINFO_EXTENSION);



                    $filecount=count($_FILES['uploaded_file']['name']);

                    $target_folder="advertisementImages/";            
                    $file_path = $target_folder;           
                    $file_name =time().$i.'.'.$ext;             
                    $file_tmp_name = $_FILES['uploaded_file']['tmp_name'][$i];


                    log_message('debug',print_r($ext,TRUE));
                     
                                  // move_uploaded_file($file_tmp_name1, $file_path1.$file_name1);
                        move_uploaded_file($file_tmp_name, $file_path.$file_name);

                    $data['advertisement_id'] = $result;
                    $data['file_name'] = $file_name;
                    $data['user_id'] = $this->user_id;

                    log_message('debug',print_r($data,TRUE));
                    $details = $this->SellerModel->insert_advertisement_images($data);
                }
            }
        	

        	if($result){        		
        		$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Advertisement created Successfully"
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        	}else{
        		$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Advertisement not created successfully',
                ];
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

/********** get All Advertisements created by user Api **********/
	public function getAllSellerAdvertisement_post(){

        $data = $this->input->post();
		$user_id = $this->user_id;
		$result = $this->SellerModel->get_all_advertisements($user_id,$data);
        $details = array();
		if($result){
            $imageArray =array();
            foreach($result as $row){
                 $images = $this->SellerModel->get_advertisement_images_by_id($row->advertisement_id);

               if($images){
                        foreach($images as $image){
                            $imageArray[] = array(
                                    'advertisement_id' => $image->advertisement_id,
                                    'image_id' => $image->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$image->image_path
                                );
                        }   
                        } 

                          $result = $this->BuyerModel->getLikedCount($row->advertisement_id);

                     //$isLiked = $this->BuyerModel->isLiked($row->advertisement_id,$user_id);


                 
                    $details[] = array(
                            'advertisement_id' => $row->advertisement_id,
                            'advertisement_name'=> $row->advertisement_name,
                            'activeStatus' => $row->status,
			    'is_approved'=>$row->is_approved,
                            'end_date' => $row->end_date,
                            'views_count' => $row->views_count,
                            'group_count' => $row->group_count,
                            'start_date'=>$row->start_date,
                            'advertisement_details'=>$row->advertisement_details,
                            'min_user_count'=>$row->min_user_count,
                            'rating'=>$this->BuyerModel->getRating($user_id),

                           'category_id'=>$row->category_id,
                            'subcategory_id'=>$row->subcategory_id,
                            'subcategory2_id'=>$row->subcategory2_id,
                            'subcategory3_id'=>$row->subcategory3_id,
                            'subcategory4_id'=>$row->subcategory4_id,
                            'subcategory5_id'=>$row->subcategory5_id,

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
                            //'offerforx'=>$row->offerforx,
                            'purchasedCount'=>$this->SellerModel->get_purchasedCount($row->advertisement_id, $user_id),
                            'pendingCount'=>$this->SellerModel->get_pendiingCount($row->advertisement_id),
                            'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($row->advertisement_id),
                            'likedcount' => $result,
                            'isliked'=>1,

                            'images_details' => $imageArray
                        );
               // }
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

/************ get Advertisement details by Advertisement ID ********/
	public function getSellerAdvertisement_post(){
		$id = $this->input->post('advertisement_id');
		$check_id = $this->SellerModel->check_advertisements($id,$this->user_id);
		if(!$check_id){   
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Invalid ID',
                    
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
                return false;
		}
		if(!$id){
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Invalid ID',

                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
                return false;
		}
        $images_details = array();

		$data = $this->SellerModel->get_advertisement_by_id($id);
		if($data){
            
            $images = $this->SellerModel->get_advertisement_images_by_id($id);

              log_message('debug',print_r($images,TRUE));
            if($images){
                    foreach($images as $row){
                        $image_details[] = array(
                                    'advertisement_id' => $row->advertisement_id,
                                    'image_id' => $row->image_id,
                                    'image_path' => base_url().'advertisementImages/'.$row->image_path
                            );
                    }
            }
 log_message('debug',print_r($data[0],TRUE));
 log_message('debug',print_r('check',TRUE));
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Get Advertisements Details Successfully",
                    'advertisementData' =>array('details'=> $data[0],'images_details'=>$image_details)
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            	$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => '',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
	}

/********** edit advertisement Api ************/
	public function editAdvertisement_post(){
		$data = $this->input->post();


        $this->load->helper('date');

        log_message('debug',print_r($data,TRUE));

		$data['user_id'] = $this->user_id;
		$id = $this->input->post('advertisement_id');
		if(!$id){
			$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Please enter valid advertisement ID',
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
                return false;
		}

		$result = $this->SellerModel->update_Advertisement_details($data);

       // $currentdate=date_format($result,"d-M-Y");

         log_message('debug',print_r($result,TRUE));

        $myDateTime = DateTime::createFromFormat('Y-m-d', $result);
              $formatteddate = $myDateTime->format('d F Y');

		if($result){
			$response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Advertisement Details updated successfully",
                    'data'=> array('end_date' => $formatteddate)

                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
            }else{
            	$response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => "Advertisement Details not updated successfully"
                ];
            	$this->set_response($response, REST_Controller::HTTP_OK);
            }
	}


public function getPendingUser_post(){

        $data = $this->input->post();
        $user_id = $this->user_id;

        $advertisement_id = $this->input->post('advertisement_id');

        $pageOffSet = 10;
       $pageIndex = $this->input->post('pageIndex')* $pageOffSet;


        $result = $this->SellerModel->get_pendingBuyer($advertisement_id,$pageIndex,$pageOffSet);
        $details = array();
        if($result){
          
            foreach($result as $row){              
             
                 
                    $details[] = array(

                            'user_id' => $row->user_id,
                            'profile_image' =>$row->profile_image==''?'':base_url().'userImages/'.$row->profile_image,
                            'name' => $row->name.' '.$row->lastName,
                            'location' => $row->location,
                            'address'=>$row->address,
                            'coupon_code'=>$row->coupon_code,
                            'status'=>$row->status,
                            'contact_number'=>$row->contact_number,
                             'email'=>$row->email,

                            
                        );
               

            }
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Record Get Successfully",
                    'data' => $details
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                    'data' => []
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


public function getPurchasedUser_post(){

        $data = $this->input->post();
        $user_id = $this->user_id;

        $advertisement_id = $this->input->post('advertisement_id');
        $status = $this->input->post('status');

        $pageOffSet = 10;
       $pageIndex = $this->input->post('pageIndex')* $pageOffSet;

       $result;
       if($status=='both')
       {
            $result = $this->SellerModel->get_purchasedBuyer($advertisement_id,$pageIndex,$pageOffSet);
       }
       else
       {
        $result = $this->SellerModel->get_filterpurchasedBuyer($advertisement_id,$pageIndex,$pageOffSet,$status);
       }

        
        $details = array();
        if($result){
          
            foreach($result as $row){              
             
                 
                    $details[] = array(

                            'user_id' => $row->user_id,
                            'profile_image' =>$row->profile_image==''?'':base_url().'userImages/'.$row->profile_image,
                            'name' => $row->name.' '.$row->lastName,
                            'location' => $row->location,
                            'address'=>$row->address,
                            'coupon_code'=>$row->coupon_code,
                            'status'=>$row->status,
                            'order_ref_id'=>$row->order_ref_id,
                             'contact_number'=>$row->contact_number,
                             'email'=>$row->email,
                              'sequence_of_order'=> $row->status=='purchased'?$row->sequence_of_order:$this->SellerModel->get_sequence_number($advertisement_id),
                               'order_placed_date'=>$row->order_placed_date,
                              'purchased_date'=>$row->purchased_date

                            
                        );
               

            }
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Record Get Successfully",
                    'data' => $details
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                    'data' => []
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


public function validateOffer_post()
  {
    $data = $this->input->post();
    $user_id = $this->user_id;
   
    $is_coupon_valid = $this->BuyerModel->check_buyer_coupon_code($data['buyer_id'],$data['advertisement_id']);

    if($is_coupon_valid && $data['coupon_code']==$is_coupon_valid)
    {
        $get_reference_id = $this->SellerModel->update_order_status($data['buyer_id'],$data['advertisement_id'],$data['coupon_code']);

        if($get_reference_id)
        {
            $this->Email->validate_purchase_email($data,$user_id);
            
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
                    $this->config->item('rest_message_field_name') => 'Something Wend Wrong',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        } 

    }
    else
    {
        $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Invalid Coupan',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
    }
   
  }

  public function getSellerFeed_post(){

        $data = $this->input->post();
        $user_id = $this->user_id;

       // $advertisement_id = $this->input->post('advertisement_id');
       // $status = $this->input->post('status');

        $pageOffSet = 10;
       $pageIndex = $this->input->post('pageIndex')* $pageOffSet;

       // $result;
       // if($status=='both')
       // {
            $result = $this->SellerModel->get_seller_feed($user_id,$pageIndex,$pageOffSet,$data);

            log_message('debug',print_r($result,TRUE));

              $this->load->helper('date');

      //}
              
        $details = array();
        if($result){
          
            foreach($result as $row){              
             

             $couponGenerated_date = new DateTime($row->CouponsCreatedAt);              
            $couponGenerated_date= $couponGenerated_date->format('d-m-Y');

             $order_placed_date = new DateTime($row->order_placed_date);              
            $order_placed_date= $order_placed_date->format('d-m-Y');

             $purchased_date = new DateTime($row->purchased_date);              
            $purchased_date= $purchased_date->format('d-m-Y');
                 
                    $details[] = array(
                            'advertisement_id' => $row->advertisement_id,
                            'advertisement_name'=> $row->advertisement_name,
                          // 'advertisement_Status' => $row->AdvertisementStatus,
                           // 'end_date' => $row->end_date,
                           // 'start_date'=>$row->start_date,
                            //'advertisement_details'=>$row->advertisement_details,
                            //'buyer_contact'=>$row->contact_number,
                            //'buyer_email'=>$row->email,
                            'buyer_name'=>$row->name,
                            // 'address'=>$row->address,
                            // 'start_date'=>$row->start_date,                           
                            // 'location'=>$row->location,                            
                            'actual_price'=>$row->actual_price,
                            'offer_price'=>$row->offer_price,

                           // 'coupon_id' =>$row->coupon_id,
                            //'coupon_code'   =>$row->coupon_code,
                            //'buyer_id' =>$row->buyer_id,                           
                            'status' => $row->CouponsStatus,
                          //  'sequence_of_order'=> $result->CouponsStatus=='purchased'?$result->sequence_of_order:$this->SellerModel->get_sequence_number($result->advertisement_id),
                            'order_ref_id'=>$row->order_ref_id,
                           // 'buyer_location' => $row->location,
                           // 'seller_image' => base_url().'userImages/'.$result->profile_image,
                            // 'purchasedCount'=>$this->SellerModel->get_purchasedCount($result->advertisement_id),
                            // 'pendingCount'=>$this->SellerModel->get_pendiingCount($result->advertisement_id),
                            // 'orderPlacedCount'=>$this->SellerModel->get_orderPlacedCount($result->advertisement_id),
                            'order_placed_date'=>$row->order_placed_date==null?null:$order_placed_date,
                              'purchased_date'=>$row->purchased_date==null?null:$purchased_date,
                              'couponGenerated_date'=>$couponGenerated_date
                        );
               

            }
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => "Record Get Successfully",
                    'data' => $details
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
                $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'No data found',
                    'data' => []
                ];
                $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


public function toggleStatus_post()
{
        $data = $this->input->post();
        $result = $this->SellerModel->toggle_status($data);
        if ($result) {
            $response = [
                    $this->config->item('rest_status_field_name') => true,
                    $this->config->item('rest_message_field_name') => 'Status changed successfully',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }else{
            $response = [
                    $this->config->item('rest_status_field_name') => false,
                    $this->config->item('rest_message_field_name') => 'Status change unsuccessful',
                ];
            $this->set_response($response, REST_Controller::HTTP_OK);
        }
    }


}
