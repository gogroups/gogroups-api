<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailModel extends CI_Model {

	// public function send_email_change_adv_approve_status($seller_id)
	// {

	// 	$this->load->library('email');        
 //          $query = $this -> db
 //           -> select('*')
 //           -> where('user_id', $seller_id)
 //           -> get('users')->row();    
         
 //        $from_email = "virframe@zohomail.in"; 
 //         //$to_email = $this->input->post('email'); 

 //   		$to_email = $query->email; 
   
 //         $this->email->set_newline("\r\n");
 //         $this->email->from($from_email, 'Pawan Gulati'); 
 //         $this->email->to($to_email);
 //         $this->email->subject('Regarding Approved Advertisements '); 
 //         $this->email->message('Testing the email class.');
 //         $this->email->send();
   
      
 //         return true;
	// }

  // public function send_email_change_adv_reject_status($seller_id)
  // {
 


  //   $this->load->library('email');        
  //         $query = $this -> db
  //          -> select('*')
  //          -> where('user_id', $seller_id)
  //          -> get('users')->row();    
         
       
  //        //$to_email = $this->input->post('email'); 
  //    // $to_email = $query->email;
     
  //      $from_email = "virframe@zohomail.in"; 
  //     //$to_email = "virframe@zohomail.in"; 
   
  //        $this->email->set_newline("\r\n");
  //        $this->email->from($from_email, 'Pawan Gulati'); 
  //        $this->email->to($to_email);
  //        $this->email->subject('Regarding Rejected Advertisements '); 
  //        $this->email->message('Testing the email class.');
  //        $this->email->send();
   
      
  //        return true;
  // }

  // public function send_email_change_group_approve_status($user_id)
  // {

  //   $this->load->library('email');        
  //         $query = $this -> db
  //          -> select('*')
  //          -> where('user_id', $user_id)
  //          -> get('users')->row();  
  //       $from_email = "virframe@zohomail.in"; 
  //        //$to_email = $this->input->post('email'); 
  //     $to_email = $query->email; 
   
  //        $this->email->set_newline("\r\n");
  //        $this->email->from($from_email, 'Pawan Gulati'); 
  //        $this->email->to($to_email);
  //        $this->email->subject('Regarding Approved Groups '); 
  //        $this->email->message('Testing the email class.');
  //        $this->email->send();
   
      
  //        return true;
  // }

  // public function send_email_change_group_reject_status($user_id)
  // {
     
  //         $query = $this -> db
  //          -> select('*')
  //          -> where('user_id', $user_id)
  //          -> get('users')->row();    
         
  //       $from_email = "virframe@zohomail.in"; 
  //        //$to_email = $this->input->post('email'); 
  //     $to_email = $query->email; 
   
  //        $this->email->set_newline("\r\n");
  //        $this->email->from($from_email, 'Pawan Gulati'); 
  //        $this->email->to($to_email);
  //        $this->email->subject('Regarding Rejected Groups '); 
  //        $this->email->message('Testing the email class.');
  //        $this->email->send();
   
      
  //        return true;
  // }

  public function send_email_change_seller_approv_status($seller_id){    

        $query = $this->db->select('*')->where('user_id', $seller_id)->get('users')->row();    
         
        $from_email = "virframe@zohomail.in"; 
         //$to_email = $this->input->post('email'); 
        $to_email = $query->email; 

         //$this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Account Approved'); 
         $this->email->message('Congratulations! Your account has been successfully approved.');
         $this->email->send();
   
      
         return true;
  }

  public function send_email_change_seller_reject_status($data){    

        $query = $this->db->select('*')->where('user_id', $data['seller_id'])->get('users')->row();    
         
        $from_email = "virframe@zohomail.in"; 
         //$to_email = $this->input->post('email'); 
        $to_email = $query->email; 

         //$this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Seller Account Rejected'); 
         $this->email->message($data['reason']);
         $this->email->send();
   
      
         return true;
  }


   public function send_email_change_user_reject_status($user_id,$data){    

        $query = $this->db->select('*')->where('user_id', $user_id)->get('users')->row();    
         
        $from_email = "virframe@zohomail.in"; 
         //$to_email = $this->input->post('email'); 
        $to_email = $query->email; 

         $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('User Account Rejected'); 
         $this->email->message($data['reason']);
         $this->email->send();
   
      
         return true;
  }


  public function send_email_change_adv_reject_status($seller_id,$data=null)
  {
   
 $query = $this->db->select('*')->where('user_id', $seller_id)->get('users')->row();  

     
       $from_email = "virframe@zohomail.in"; 
      $to_email = $query->email; 

   
         $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Regarding Rejected Advertisement'); 
         $this->email->message($data['reason']);
         $this->email->send();
   
      
         return true;
  }


  public function send_email_change_adv_approv_status($seller_id)
  {
 
 $query = $this->db->select('*')->where('user_id', $seller_id)->get('users')->row();  

  
     
       $from_email = "virframe@zohomail.in"; 
      $to_email = $query->email; 

   
         $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Advertisement Approved'); 
         $this->email->message('Congratulations! Your Advertisement has been successfully approved.');
         $this->email->send();
   
      
         return true;
  }


 public function send_email_change_group_reject_status($seller_id,$data=null)
  {
 
 $query = $this->db->select('*')->where('user_id', $seller_id)->get('users')->row();  

 
       $from_email = "virframe@zohomail.in"; 
      $to_email = $query->email; 

   
         $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Regarding Rejected Group '); 
         $this->email->message($data['reason']);
         $this->email->send();
   
      
         return true;
  }


  public function send_email_change_group_approv_status($seller_id,$group_name)
  {
 
 $query = $this->db->select('*')->where('user_id', $seller_id)->get('users')->row();  

  
     
       $from_email = "virframe@zohomail.in"; 
      $to_email = $query->email; 

   
         $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'Pawan Gulati'); 
         $this->email->to($to_email);
         $this->email->subject('Group Approved'); 
         $this->email->message('Your'. $group_name.' has been approved by Go groups admin and should be available in your app MY interest section. For any issue, please contact administration on given email ID and phone numbers');
         $this->email->send();
   
      
         return true;
  }

  public function send_push_notification($user_id,$msg_body)
  {
    $this->load->model('BuyerModel');
   
       
                            $deviceTokens=[];
                              $k=-1;               
                            $device=$this->BuyerModel->getdeviceToken($user_id) ;               
                                   
                                    foreach($device as $value){
                                        $k++;
                                   $deviceTokens[$k]=$value->device_token;
                 
                                    }

                               

        $pushNotification=$this->BuyerModel->pushNotification($deviceTokens,$msg_body);
  }
           


 

}

?>