<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);

class ApiModel extends CI_Model{


/************ insert user's all details in users table **********/
      public function insert($data){
            /********** insert seller details in users table ***********/

            $user_data = '';
            if($data['user_type'] == 'Seller'){
        	     $user_data = array(
        				'name' => $data['name'],
                'lastName' => $data['lastName'],
                'profile_image' => $data['file_name'],
        				'contact_number' => $data['contact_number'],
        				'email' => $data['email'],
        				'seller_tinNo' => $data['tin_number'],
        				'seller_companyName' => $data['company_name'],
        				'location' => $data['location'],
                'zipcode' => $data['zipCode'],
        				'seller_usp' => $data['seller_usp'],
        				'seller_secondary_name' => $data['secondary_name'],
        				'seller_secondary_contact' => $data['secondary_contact'],
        				'seller_secondary_email' => $data['secondary_email'],
        				'user_type' => $data['user_type'],

                'account_number' => $data['account_number'],
                'ac_holder_name' => $data['ac_holder_name'],
                'ifsc' => $data['ifsc'],
                'bank_name' => $data['bank_name'],
                'paytm_no' => $data['paytm_no'],
                'address'=>$data['address'],
        			 );

               $this->db->insert('users',$user_data);

            }else{
                  $user_data = array(
                              'name' => $data['name'],
                              'lastName' => $data['lastName'],
                              'profile_image' => $data['file_name'],
                              'email' => $data['email'],
                              'contact_number' => $data['contact_number'],
                              'location' => $data['location'],
                              'zipcode' => $data['zipCode'],
                              'user_type' => $data['user_type'],
                              'paytm_no' => $data['paytm_no'],
                               'address'=>$data['address'],

                              'account_number' => $data['account_number'],
                              'ac_holder_name' => $data['ac_holder_name'],
                              'ifsc' => $data['ifsc'],
                              'bank_name' => $data['bank_name'],
                              'paytm_no' => $data['paytm_no'],
                        );
                  $this->db->insert('users',$user_data);
            }   

      	
            /******* return last inserted id from user's table *******/
      	 $user_id = $this->db->insert_id();

        /********* insert profile imae of user if image_path field is not empty ***********/
         if(!empty($data['age'])){
             $this->db->where('user_id',$user_id)->update('users',array('age'=>$data['age']));
         }

         return $user_id;

      }

/******** insert user's login details in login table **************/
public function insert_token($user_id,$user_type,$device_token)
{
              $query=   $this->db->select('*')
                        // ->where('user_id',$user_id)
                         ->where('device_token',$device_token)
                         ->get('push_notification')
                         ->row();

                if(count($query)!=0)
                {
                    $is_del = $this->db->where('device_token', $device_token)             
                   ->delete('push_notification'); 

                }

                 $user_data = array(
                              'user_id' => $user_id,
                              'user_type' => $user_type,
                              'device_token' => $device_token                            
                              
                        );
                  $this->db->insert('push_notification',$user_data);
  
}





 public function sendOtp($message,$to){


$config['protocol']    = 'smtp';
                    $config['smtp_host']    = 'ssl://smtp.zoho.com';
                    $config['smtp_port']    = '465';
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user']    = 'atinderpal@email.engineerbabu.com';
                    $config['smtp_pass']    = 'atinderpal123';
                    $config['newline']    = "\r\n";
                    $config['mailtype'] = 'text'; // or html


                         // $message = $details['opt']; 
                         // $to=$user_details->email;

                $this->load->library('email');    
              $this->email->initialize($config);
                // Load email library and passing configured values to email library
              //$this->load->library('email', $config);
              $this->email->set_newline("\r\n");

              // Sender email address
              $this->email->from('atinderpal@email.engineerbabu.com', 'GoGroup');
              // Receiver email address
              $this->email->to($to);
              
              // Subject of email
              $this->email->subject('OTP');
              // Message in email
              $this->email->message($message);

              $this->email->send();



 }





      public function login_insert($data){
            $i = 0; //counter
            $opt = ""; //our default opt is blank.
            while($i < 4){
                  //generate a random number between 0 and 9.
                  $opt .= mt_rand(0, 9);
                  $i++;
            }
         /********* insert seller username or other details in login table  *********/
            $login_data = array(
                         'user_id' => $data->user_id,
                         'user_name' => $data->email,
                         'password' => $data->password,
                         'user_type' => $data->user_type,
                         'opt_text'  => $opt,
                         'Status'     =>$data->user_type=='User'?1:0,
                         'created_by' => $data->user_id,
                         'device_token' => $data->token
                  );
            $this->db->insert('login',$login_data);

            $result = array(
                  'user_id' => $data->user_id,
                  'opt' => $opt,
                  'token' => $data->token,
                  'email'=>$data->email,
                   'contact'=>$data->contact_number,

                  );
            return $result;
      }

/******* fetching user_details by user_id from the user's table *******/
      public function get_user_details($user_id){
          return $this->db->select('*')
                         ->where('user_id',$user_id)
                         ->get('users')
                         ->row();
      }

/******** Verify OPT function *******/
      public function verify_otp($data){
            $details = $this->db->where('opt_text',$data['otp_text'])->where('device_token',$data['token'])->get('login')->row();
            if($details){
                  return $this->db->where('opt_text',$data['otp_text'])
                                  ->where('device_token',$data['token'])
                                  ->where('user_id',$details->user_id)
                                  ->update('login',array('opt_verify_status' => 1));
            }else{
                  return false;
            }
      }

/********* check the login details of user *********/
      public function login($data){
            $getpassword = $this->db->select('password')->where('user_name',$data['username'])->get('login')->row();
            if($getpassword){
                  $decryptedPassword = $this->encryption->decrypt($getpassword->password);
                  
                  if($decryptedPassword == $data['password']){
                        $user = $this->db->where('user_name',$data['username'])
                              ->where('password',$getpassword->password)
                              ->where('user_type',$data['userType'])
                              ->get('login')
                              ->row();
                        return $user;

                  }else{
                        return false;
                  }
            }else{
                  return false;
            }
      }

/******* check user is exit or not ********/
      public function is_user($data){
          if(!empty($data['user_id'])){
                $record = $this->db->from('login')->where(array('user_id' => $data['user_id']))->get()->row();
                if($record){
                  return true;
                }
            }
          return false;
      }

/********* check token is exits or not ********/
      public function is_token($token){
          $record = $this->db->from('login')->where(array('device_token' => $token))->get()->row();

          if($record){
            return true;
          }
          return false;
      }

/********** Get buyer details from the user's table by user_id ************/
      public function get_buyer_details($user_id){
            $result = $this->db->select('user_id,name,age,email,contact_number,location,profile_image,created_date,zipcode,seller_tinNo,seller_companyName,seller_usp,account_number,ac_holder_name,ifsc,bank_name,paytm_no,address')
                               ->where('user_id',$user_id)
                               ->get('users')
                               ->row();
            return $result;
      }

       public function getotpdetails($ID){

          $i = 0; //counter
            $opt = ""; //our default opt is blank.
            while($i < 4){
                  //generate a random number between 0 and 9.
                  $opt .= mt_rand(0, 9);
                  $i++;
            }

            $optarray = array(
                  'opt_text' => $opt                 
                  );
                  
               $query =  $this->db->where('user_id',$ID)->update('login',$optarray);
               log_message('debug',print_r($query,TRUE));  
              $response = array(
                  'user_id' => $ID,                  
                  'opt' => $optarray['opt_text']
                 
                  );

              return $response;


            
      }

/******** Update User's Profile by user_id ***********/
      public function updateProfile($data){
            $user_details = array(
                  'name' => $data['name'],
                  'contact_number' => $data['contact_number'],
                  'profile_image' => $data['file_name'],  
                  'location' => $data['location'],
                  'zipcode' => $data['zipCode'],
                  'account_number' => $data['account_number'],
                  'ac_holder_name' => $data['ac_holder_name'],
                  'ifsc' => $data['ifsc'],
                  'bank_name' => $data['bank_name'],
                  'paytm_no' => $data['paytm_no'],
                  'address'=>$data['address']
                  );

            $query =  $this->db->where('user_id',$data['user_id'])->update('users',$user_details);

            if(!empty($data['age'])){
                  $query = $this->db->where('user_id',$data['user_id'])->update('users',array('age'=>$data['age']));
            }
             if(!empty($data['seller_usp'])){
                  $query = $this->db->where('user_id',$data['user_id'])->update('users',array('seller_usp'=>$data['seller_usp']));
            }
            return $query;
      }
 

  public function updateContact($data){
            $user_details = array(                 
                  'contact_number' => $data['contact_number'],                 
                  'email' => $data['email']
                  );
             $login_details = array( 
                  'user_name' => $data['email']
                  );

            $query =  $this->db->where('user_id',$data['user_id'])->update('users',$user_details);
             $query1 =  $this->db->where('user_id',$data['user_id'])->update('login',$login_details);
           
            return $query1;
      }
 
/*********** Get categories from categories table *********/
      public function get_categories(){
            return $this->db->select('category_id as category_id ,category_title as category_title')
                            ->from('categories')
                            ->get()
                            ->result();
      }



  public function isemail($email,$user_id){
           $query= $this->db->select('*')
                          ->where('email',$email)
                          ->where('user_id != ',$user_id)
                          ->from('users')
                          ->get()
                          ->result();

                            return count($query);
      }

      public function iscontact($contact,$user_id){
            $query =$this->db->select('*')
                            ->where('contact_number',$contact)
                            ->where('user_id != ',$user_id)
                            ->from('users')
                            ->get()
                            ->result();

                            return count($query);
      }

/*********** Get sub categories from subcategories table *********/
      public function get_subcategories($category_id){
            return $this->db->select('subcategory_id as category_id,subcategory_title as category_title ')
                            ->where('category_id',$category_id)
                            ->from('subcategories')
                            ->get()
                            ->result();
      }

       public function get_groupbyID($category_id){
            return $this->db->select('group_id,category_id,subcategory_id,subcategory2_id,subcategory3_id,subcategory4_id,subcategory5_id')
                            ->where('category_id',$category_id)                           
                            ->from('groups')
                            ->get()
                            ->result();
      }

       public function get_groupbyAdsID($category_id){
            return $this->db->select('advertisement_id,category_id,subcategory_id,subcategory2_id,subcategory3_id,subcategory4_id,subcategory5_id')
                            ->where('category_id',$category_id)                           
                            ->from('advertisements')
                            ->get()
                            ->result();
      }

/********* get sub categories 2 from the subcategories2 table *********/
      public function get_subcategories2($subcategory_id){
            return $this->db->select('subcategory2_id as category_id,subcategory_title2 as category_title')
                            ->where('subcategory_id',$subcategory_id)
                            ->from('subcategories2')
                            ->get()
                            ->result();
      }

/************* get all subcategories3 from the subcategories3 table ***********/
      public function get_subcategories3($subcategory_id2){
          return $this->db->select('subcategory3_id as category_id,subcategory_title3 as category_title')
                          ->where('subcategory2_id',$subcategory_id2)
                          ->from('subcategories3')
                          ->get()
                          ->result();

      }


/*********** get all the subcategories4 details from subcategories4 table *************/
      public function get_subcategories4($subcategory_id3){
          return $this->db->select('subcategory4_id as category_id,subcategory_title4 as category_title')
                          ->where('subcategory3_id',$subcategory_id3)
                          ->get('subcategories4')
                          ->result();
                          
      }


/**************** get all the subcategories5 detail from the subcategories5 table *************/
      public function get_subcategories5($subcategory_id4){
          return $this->db->select('subcategory5_id as category_id,subcategory_title5 as category_title')
                          ->where('subcategory4_id',$subcategory_id4)
                          ->get('subcategories5')
                          ->result();
      }

/******* update user's notification setting ***********/
      public function change_notification_settings($user_id,$notify_status){
          $query = $this->db->where('user_id',$user_id)->update('users',array('notify_status'=> $notify_status));
          if($query){
            return true;
          }else{
            return false;
          }
      }

/********** check user's old password from the database ************/
      public function get_check_old_password($user_id,$old_password){
            $getPassword =  $this->db->select('password')->where('user_id',$user_id)->get('login')->row();
            $decrypted_Password = $this->encryption->decrypt($getPassword->password);
            if($decrypted_Password == $old_password){
                  return true;
            }else{
                  return false;
            }
      }

/********* change old password in the login table **************/
      public function change_password($user_id,$new_password){
            $encrypted_password = $this->encryption->encrypt($new_password);

            $query = $this->db->where('user_id',$user_id)->update('login',array('password'=>$encrypted_password));
            if($query){
                  return true;
            }else{
                  return false;
            }
      }

/*********** get filtered group details from groups table ***********/
      public function get_filtered_group_details($id){

 return $this->db->select('groups.group_id,groups.group_name,groups.location as groupLocation,users.profile_image,users.name,users.location,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.rating,groups.group_name,groups.group_image,groups.cost_range,DATE_FORMAT(groups.end_date,"%e %M %Y") as end_date,groups.members_count,groups.description,user_groups.join_status')
                          ->join('categories','categories.category_id = groups.category_id')
                          ->join('subcategories','subcategories.subcategory_id = groups.subcategory_id','left')
                          ->join('subcategories2','subcategories2.subcategory2_id = groups.subcategory2_id','left')
                          ->join('subcategories3','subcategories3.subcategory3_id = groups.subcategory3_id','left')
                          ->join('subcategories4','subcategories4.subcategory4_id = groups.subcategory4_id','left')
                          ->join('subcategories5','subcategories5.subcategory5_id = groups.subcategory5_id','left')
                          ->join('users','users.user_id = groups.createdby_userid','left')
                          ->join('user_groups','user_groups.user_id = groups.createdby_userid','left')
                          ->where('groups.category_id',$id)
                           ->where('groups.group_name like', '%%')
                          ->where('groups.status','approved')
                          ->where('groups.is_approved',1)
                          ->get('groups')
                          ->result();

           

            return $result;
      }

public function updateExpired()
{

   $this->load->helper('date');

        $currentdate=date("Y-m-d");
         $this->load->helper('date');


          $date = new DateTime($currentdate);
                $date->modify('+1 day');
			$prev_date= $date->format('Y-m-d');
      
    
      $advertisement_details=  $this->db->select('advertisement_id,createdby_userid')
                          ->where('end_date',$prev_date)
                          ->get('advertisements')
                          ->result();

       $group_details=  $this->db->select('group_id,created_by')
        ->where('end_date',$prev_date)
        ->get('groups')
        ->result();

                         
 foreach($advertisement_details as $data){


$data1 = array(
				'adver_id' => $data->advertisement_id,
				'seller_id' => $data->createdby_userid,				
				'status' => 'Expired'
			);
$query = $this->db->insert('notifications',$data1);

 }
 foreach($group_details as $value){


$data1 = array(
				'group_id' => $value->group_id,
				'user_id' => $value->created_by,				
				'status' => 'Expired'
			);
$query = $this->db->insert('notifications',$data1);

 }


         $group_details = array(
                  'status' => 'expired',
                  'is_approved'=>'0'
                  
                  );

          $ad_details = array(
                  'status' => 'expired',
                  'is_approved'=>'0'
                  
                  );
          

        $query=$this->db->where('end_date < ',$currentdate)->update('groups',$group_details);

        $query1=$this->db->where('end_date < ',$currentdate)->update('advertisements',$ad_details);


        return $query1;


}



  public function pushNotification($device_token,$body,$title){
       if (!defined('API_ACCESS_KEY')) define( 'API_ACCESS_KEY', 'AAAAgj2eksg:APA91bGCZ67vj4cxjo11251gg2PEchTZgLHWa3YAb4kCiCaI42qPy3YPZc5H29ED8-3LUm4Mv6aCGSWpB7VOb2d8FLA7f1wCMGzr43m4_ebQEG_OByAElJaDzEHcDVMzXs_BkJKT2PlVoBk01cqoIq1kT_e1mWabnQ' );
// $registrationIds = array('fb1jTTIW0vI:APA91bGoM67GJEPs7MgpHrrV6os6OEgbcZvuLb0jaYt1yWaP7r5_CdJzqOZ84t_lXkT6m3nHpN-GEbz4wFzR0kHe8VpSyMETQdlD0gffE8Ks812yY0QVaVIR7C1WRHDy9ytfrCn21PNR');
// prep the bundle
$msg = array
(
    'message'   => $body,
    'title'     => $title,
    'subtitle'  => 'This is a subtitle. subtitle',
    'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'   => 1,
    'sound'     => 1,
    'largeIcon' => 'large_icon',
    'smallIcon' => 'small_icon'
);
 
 
$notification = array(
    
      "body" => $body,
      "title" => $title,
      "icon" => "myicon"    
    );
$fields = array
(
    'registration_ids'  => $device_token,
    'data'          => $msg,
     "title" => $title,
    "notification" => $notification,
    "priority" => "normal"
 
);
 
$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
//echo $result;
    }



/********** get filtered advertisement details from advertisement table *************/
      public function get_filtered_advertisement_details($data){
            $result = $this->db->select('advertisements.advertisement_id,advertisements.advertisement_name,advertisements.status,date_format(advertisements.end_date,"%e %M %Y") as end_date,advertisement_statics.views_count,advertisement_statics.group_count,advertisements_images.image_path')
                               ->join('advertisement_statics','advertisement_statics.advertisement_id = advertisements.advertisement_id','left')
                               ->join('advertisements_images','advertisements_images.advertisement_id = advertisements.advertisement_id')
                               ->or_where('start_date',$data['start_date'])
                               ->or_where('end_date',$data['end_date'])
                               ->or_where('category_id',$data['category_id'])
                               ->or_where('subcategory_id',$data['subcategory_id'])
                               ->or_where('user_count',$data['member_count'])
                               ->where('advertisements.status','approved')
                               ->where('advertisements.is_approved',1)
                               ->get('advertisements')
                               ->result();

            return $result;
      }


       public function get_filteredseller_advertisement_details($data){


 $condition = "SELECT `advertisements`.`advertisement_id`,`advertisements`.`advertisement_name`, `advertisements`.`status`, date_format('advertisements.end_date', '%e %M %Y') as end_date, `advertisements`.`user_count`, `advertisement_statics`.`group_count`, date_format('advertisements.start_date', '%e %M %Y') as start_date, `advertisements`.`advertisement_details`, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, `categories`.`category_title`, `subcategories`.`subcategory_title`, `subcategories2`.`subcategory_title2`, `subcategories3`.`subcategory_title3`, `subcategories4`.`subcategory_title4`, `subcategories5`.`subcategory_title5`, `advertisements`.`location`
 FROM `advertisements`
 LEFT JOIN `advertisement_statics` ON `advertisement_statics`.`advertisement_id` = `advertisements`.`advertisement_id`
 LEFT JOIN `categories` ON `categories`.`category_id` = `advertisements`.`category_id`
 LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `advertisements`.`subcategory_id`
 LEFT JOIN `subcategories2` ON `subcategories2`.`subcategory2_id` = `advertisements`.`subcategory2_id`
LEFT JOIN `subcategories3` ON `subcategories3`.`subcategory3_id` = `advertisements`.`subcategory3_id`
 LEFT JOIN `subcategories4` ON `subcategories4`.`subcategory4_id` = `advertisements`.`subcategory4_id`
 LEFT JOIN `subcategories5` ON `subcategories5`.`subcategory5_id` = `advertisements`.`subcategory5_id`
 WHERE (( '" . $data['start_date'] . "'='' OR  `start_date` >= '" . $data['start_date'] . "')
 AND ( '" . $data['end_date'] . "'='' OR `end_date` <= '" . $data['end_date'] . "')
 AND ( '" . $data['category_id'] . "'='' OR `advertisements`.`category_id` = '" . $data['category_id'] . "')
 AND ('" . $data['subcategory_id'] . "'='' OR `advertisements`.`subcategory_id` ='" . $data['subcategory_id'] . "')
 
 AND (`advertisements`.`created_by` = '" . $data['user_id'] . "'))";

// // print_r($condition);die;

 $query = $this->db->query($condition)->result();
 return$query;

      }


/************* check user is exits in db or not by user's email ***********/
      public function check_user_exits($username){
            return $this->db->where('user_name',$username)->get('login')->row();
      }


 public function getNotificationcount($user_id,$user_type){

   $notify_status = $this->db->select('notify_status')
                               ->where('user_id',$user_id)                              
                               ->get('users')
                               ->row('notify_status');

    if($user_type=='seller')
        {
                                $query = $this->db->select('notifications.seller_id')
                               ->where('notifications.seller_id',$user_id)
                               ->where('notifications.read_status',0)
                                ->where('notifications.status != ', 'NULL')
                               // ->where('true = ', $notify_status)
                               ->get('notifications')
                               ->result();
                               return count($query);

        }
        else
        {
                              $query = $this->db->select('notifications.user_id')
                               ->where('notifications.user_id',$user_id)
                               ->where('notifications.read_status',0)
                                ->where('notifications.status != ', 'NULL')
                               // ->where('true = ', $notify_status)
                               ->get('notifications')
                               ->result();
                                 return count($query);
        }


 }


  public function updatenotification($user_id,$user_type){
          

          if($user_type=='seller')
        {
            return $this->db->where('seller_id',$user_id)
                            ->where('read_status',0)
                             ->where('notifications.status != ', 'NULL')
                            //->where('read_status',0)
                ->update('notifications',array('read_status' => 1));
        }
        else
        {
           return $this->db->where('user_id',$user_id)
                            ->where('read_status',0)
                             ->where('notifications.status != ', 'NULL')
                ->update('notifications',array('read_status' => 1));

        }

           
      
        }
         
      

       public function getNotification($user_id,$user_type){

      //  $result;

         $notify_status = $this->db->select('notify_status')
                               ->where('user_id',$user_id)                              
                               ->get('users')
                               ->row('notify_status');

        if($user_type=='seller')
        {
                                $query = $this->db->select('notifications.status,advertisements.created_date,notifications.created_at')
                               ->join('advertisements','notifications.adver_id = advertisements.advertisement_id','left')
                               ->where('notifications.seller_id',$user_id)
                               ->where('notifications.status != ', 'NULL')
                               ->order_by('created_at desc')
                               ->get('notifications')
                               ->result();

                                 return $query;

        }
        else
        {
                              $query = $this->db->select('notifications.status,groups.group_name,notifications.created_at')
                               ->join('groups','notifications.group_id = groups.group_id','left')                               
                               ->where('notifications.user_id',$user_id)
                               ->where('notifications.status != ','NULL')
                               ->order_by('created_at desc')
                               ->get('notifications')
                               ->result();
                                 return $query;
        }
         
      }

      public function get_seller_details_by_email($email)
      {
        return $this->db->select('user_id,name,email')
                        ->where('email',$email)
                        ->get('users')
                        ->row();
      }


      public function get_single_coupon_details($data,$coupon_code)
      {
       return $this->db->select('coupons.*,seller.name as seller_name,buyer.name as buyer_name,seller.lastName as seller_lastName,buyer.lastName as buyer_lastName,seller.email as seller_email,buyer.email as buyer_email,advertisements.advertisement_id,advertisements.advertisement_name,advertisements.category_id')
                        ->from('coupons')
                        ->where('coupons.buyer_id',$data['user_id'])
                        ->where('coupons.advertisement_id',$data['advertisement_id'])
                        ->where('coupon_code',$coupon_code)
                        ->join('users as seller','coupons.seller_id = seller.user_id','left')
                        ->join('users as buyer','coupons.buyer_id = buyer.user_id','left')
                        ->join('advertisements','coupons.advertisement_id = advertisements.advertisement_id')
                        ->get()
                        ->row();
    }
}

