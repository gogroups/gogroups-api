<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/jwt/JWT.php';


class SellerControllerModel extends CI_Model {



	public function insertSeller($data,$file_name){	
		$check_seller = $this->db->select('*')
					  ->or_where('email',$data['email'])
					  ->or_where('contact_number',$data['country_code'].$data['contact'])->get('users')->row();
					  //print_r($this->db->last_query());
					 // print_r($check_seller->email);
					 // print_r($check_seller->contact_number);die;
					 // print_r($data['contact']);die;

		if(!empty($check_seller))
		{
			
			if($check_seller->email==$data['email'] && $check_seller->contact_number==$data['country_code'].$data['contact'])
			{
				return "2";
			}

			elseif($check_seller->email==$data['email'])
			{
				return "3";
			}

			else
			{
				return "4";
			}
		}

        //$data = array('upload_data' => $this->upload->data());

		/******** insert data into users table *******/
		$user_data = array('name' => $data['full_name'],
						   'email' => $data['email'],
						   'contact_number' => $data['country_code'].$data['contact'],
						   'zipcode' => $data['zip_code'],
						   'seller_companyName' => $data['company_name'],
						   'seller_secondary_name' => $data['secondary_name'],
						   'location' => $data['location'],
						   'address' =>$data['address'],
						   'account_number' =>$data['account_number'],
						   'ac_holder_name' =>$data['ac_holder_name'],
						   'bank_name' =>$data['bank_name'],
						   'ifsc' =>$data['ifsc'],
						   'paytm_no' =>$data['paytm_no'],
						   'seller_secondary_contact' => $data['secondary_contact'],
						   'seller_tinNo' => $data['secondary_gst'],
						   'seller_secondary_email' => $data['secondary_email'],
						   'seller_usp' => $data['seller_usp'],
						   'user_type' => 'Seller',
						   'notify_status' => 'false',
						   'profile_image'=>$file_name,
						  );
	

		$this->db->insert('users',$user_data);
		$user_id =  $this->db->insert_id();

				// $tokenData = array();
	   //          $tokenData['user_id'] = $user_id;
	   //          $token = $this->jwt_encode($tokenData);


		$password = $this->random_password();



$i = 0; //counter
            $opt = ""; //our default opt is blank.
            while($i < 4){
                  //generate a random number between 0 and 9.
                  $opt .= mt_rand(0, 9);
                  $i++;
            }
		/******* insert data into login table *******/

		$login_data = array('user_id' => $user_id,
							'user_name' => $data['email'],
							'user_type' => 'Seller',
							'Status' => 1,
							'created_by' => '',
							'password' => $this->encryption->encrypt($password),
							'opt_text'=>$opt
						   );

		return  $this->db->insert('login',$login_data);	
	}


	public function updateSeller($data,$file_name){
		//echo $data['seller_id'];die;
		
   		$user_data=$this->db->where('user_id', $data['seller_id'])
				 		->update('users', 
				 					array('name' => $data['full_name'],
						   'email' => $data['email'],
						   'contact_number' => $data['contact'],
						   'zipcode' => $data['zip_code'],
						   'seller_companyName' => $data['company_name'],
						   'seller_secondary_name' => $data['secondary_name'],
						   'location' => $data['location'],
						   'address' =>$data['address'],
						   'account_number' =>$data['account_number'],
						   'ac_holder_name' =>$data['ac_holder_name'],
						   'bank_name' =>$data['bank_name'],
						   'ifsc' =>$data['ifsc'],
						   'paytm_no' =>$data['paytm_no'], 
						   'seller_secondary_contact' => $data['secondary_contact'],
						   'seller_tinNo' => $data['secondary_gst'],
						   'seller_secondary_email' => $data['secondary_email'],
						   'seller_usp' => $data['seller_usp'],
						   'user_type' => 'Seller',
						   'notify_status' => 'false',
						   'profile_image'=>$file_name,
						  )
				 	);

		return $user_data;		 		
	
		
	}



	function random_password( $length = 6 ) {
		    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		    $password = substr( str_shuffle( $chars ), 0, 6);
		    return $password;
	}
	

	public function get_active_sellers(){

		$query = "SELECT `users`.`user_id`,`users`.`zipcode`,`users`.`email`,`users`.`seller_tinNo`,`users`.`seller_secondary_name`,`users`.`seller_secondary_email`,`users`.`seller_secondary_contact`,`users`.`seller_usp`, `users`.`name`, `users`.`lastName`, `users`.`seller_companyName`, `users`.`location`, `users`.`contact_number`, CASE WHEN `advertisements`.`status` IN('approved', 'rejected') THEN COUNT(`advertisements`.`createdby_userid`) ELSE 0 END as Total, `login`.`Status` FROM `users` JOIN `login` ON `users`.`user_id` = `login`.`user_id` LEFT JOIN `advertisements` ON `users`.`user_id`=`advertisements`.`createdby_userid` WHERE `users`.`user_type` = 'Seller' GROUP BY `users`.`user_id` ORDER BY `users`.`user_id` DESC";


		$result = $this->db->query($query)->result();

		//print_r($result);die;
		//print_r($this->db->last_query());die;
		return $result;
		/*$status = array('approved', 'rejected');

		$count = $this->db->join('advertisements','users.user_id=advertisements.createdby_userid','left')
						  ->where_in('advertisements.status',$status)
						  ->get('users')
						  ->result();

		$result=$this->db->select('users.user_id,users.name,users.lastName,users.seller_companyName,users.location,users.contact_number,login.Status')
		->join('login','users.user_id = login.user_id')		
		->join('advertisements','users.user_id=advertisements.created_by','left')
		->where('users.user_type','Seller')
		->group_by('users.user_id')
		->get('users')
		->result();

		$result['Total'] = $count;
		//print_r($result);die;
		return $result;*/


	}


	public function getSellerDetails($user_id){
		$result = $this->db->where('user_id',$user_id)->where('user_type','Seller')->get('users')->row();
		return $result;
	}

	// public function editSellerDetails($user_id){
	// 	$result = $this->db->where('user_id',$user_id)->where('user_type','Seller')->get('users')->row();
	// 	return $result;
	// }


	public function delete_seller($user_id){

		$result = $this->db->where('user_id',$user_id)
						   ->where('user_type','Seller')
						   ->from('users')
						   ->delete();

		return $result;
	}

	public function addReason($data){
		$reasonData = array('seller_id'=>$data['seller_id'],
							'reason' => $data['reason']
							);

		$result = $this->db->insert('notifications',$reasonData);
		return $result;
	}

	

}
