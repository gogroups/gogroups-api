<?php 
class Email extends CI_Model {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('ApiModel');

			$this->load->library('email');
            
            $config = $this->config->item('email');

            $this->email->initialize($config);
    }

    public function coupon_code_generate_email($data,$coupon_code)
	{	
		$result=$this->ApiModel->get_single_coupon_details($data,$coupon_code);
		//print_r($result);die;

		$message=$result->buyer_name." generated coupon code ".$result->coupon_code." for advertisement - ".$result->advertisement_name.". Quantity required : ".$result->quantity;
		$subject="Coupon Code Generated";	

//////push notification seller start//////////////////////////////

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'seller',
		                            'notificationType'=>'myOrders',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $data['seller_id']  ,            
		                            'description'   =>$message , 
		                             'title'=> 'Coupon Code Generated'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($data['seller_id']) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);

//////////////////////end///////////////////////////////////


		$this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($result->seller_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();


							//////push notification user start//////////////////////////////

$description="Copun Code".$result->coupon_code. "has been generated for ads".$result->advertisement_name;

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'user',
		                            'notificationType'=>'myPurchase',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $data['user_id']  ,            
		                            'description'   =>$description , 
		                             'title'=> 'Coupon Code Generated'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($data['user_id']);               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);

//////////////////////end///////////////////////////////////

   $message="You Genereate Coupon code for advertisement ".$result->advertisement_name." Coupon Code is - ".$result->coupon_code." created by seller ".$result->seller_name;
		$subject="Go Group(Coupon Code Generated)";					

	 $this->buyer_coupon_generated_email($result->buyer_email,$message,$subject);


		$message=$result->buyer_name." generated coupon code ".$result->coupon_code." for advertisement - ".$result->advertisement_name." created by seller ".$result->seller_name;
		$subject="Seller Coupon Code Generated";					

		return $this->coupon_code_email_superadmin($message,$subject);		
	}


	public function place_order_email($data,$user_id)
	{
		$data['user_id']=$user_id;
		$result=$this->ApiModel->get_single_coupon_details($data,$data['coupon_code']);

		$message=$result->buyer_name." placed order for reference id ".$result->order_ref_id." for advertisement - ".$result->advertisement_name;
		$subject="Order Placed";	

		//////push notification start//////////////////////////////

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'seller',
		                            'notificationType'=>'myOrders',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $result->seller_id  ,            
		                            'description'   =>$message , 
		                             'title'=> 'Order Placed'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($result->seller_id) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);

//////////////////////end///////////////////////////////////


		$this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($result->seller_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();




//////push notification user start//////////////////////////////



$description="You have successfully placed order for". $result->advertisement_name." and order reference number is". $result->order_ref_id;

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'user',
		                            'notificationType'=>'myPurchase',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $result->buyer_id ,            
		                            'description'   =>$description , 
		                             'title'=> 'GoGroup'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($result->buyer_id);               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);

//////////////////////end///////////////////////////////////

      $message="You order will placed for advertisement ".$result->advertisement_name." reference id is - ".$result->order_ref_id." created by seller ".$result->seller_name;
		$subject="Order Purchased";					

	 $this->buyer_order_placed_email($result->buyer_email,$message,$subject);

		$message=$result->buyer_name." placed order for reference id ".$result->order_ref_id." for advertisement - ".$result->advertisement_name." created by seller ".$result->seller_name;
		$subject="Buyer Placed Order  Generated";					

		return $this->coupon_code_email_superadmin($message,$subject);
	}


	public function validate_purchase_email($data,$user_id)
	{
		$data['user_id'] = $data['buyer_id'];
		unset($data['buyer_id']);

		$result=$this->ApiModel->get_single_coupon_details($data,$data['coupon_code']);

		$message="You validate order for reference id ".$result->order_ref_id." for advertisement - ".$result->advertisement_name." for buyer ".$result->buyer_name;
		$subject="Order Purchased";	

		//////push notification user start//////////////////////////////

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'seller',
		                            'notificationType'=>'myOrders',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $result->seller_id  ,            
		                            'description'   =>$message , 
		                             'title'=> 'GoGroup'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($result->seller_id) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);

//////////////////////end///////////////////////////////////


		$this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($result->seller_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();



/////push notification user start//////////////////////////////



$description="You have succesfully purchased". $result->advertisement_name;

                   $msg_body=array(

		                            'advertisement_id'=> $data['advertisement_id'] , 
		                            'type'=>'user',
		                            'notificationType'=>'myPurchase',
		                            'category_id'    => $result->category_id,
		                            'user_id'=>      $result->buyer_id ,            
		                            'description'   =>$description , 
		                             'title'=> 'GoGroup'                           
                              );

                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($result->buyer_id);               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);


		$message="You order confirmed by seller".$result->seller_name." for reference id ".$result->order_ref_id." for advertisement - ".$result->advertisement_name;
		$subject="Order Purchased";					

		return $this->buyer_order_purchased_email($result->buyer_email,$message,$subject);
	}


	public function coupon_code_email_superadmin($message,$subject)
	{	
		return $this->email->from('virframe@zohomail.in', 'GoGroup')
							->to('virframe@zohomail.in')
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();
	}

	public function buyer_order_purchased_email($buyer_email,$message,$subject)
	{	
		return $this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($buyer_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();
	}

	public function buyer_coupon_generated_email($buyer_email,$message,$subject)
	{	
		return $this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($buyer_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();
	}

	public function buyer_order_placed_email($buyer_email,$message,$subject)
	{	
		return $this->email->from('virframe@zohomail.in', 'GoGroup')
							->to($buyer_email)
							->subject($subject)
							->message($message)
							->set_mailtype('html')
							->send();
	}


}

?>
