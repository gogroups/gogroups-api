<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

		public function insertUser($data,$newfile_name){
			$check_user = $this->db->select('*')
					  ->or_where('email',$data['email'])
					  ->or_where('contact_number',$data['country_code'].$data['contact'])->get('users')->row();
					  
				

		if(!empty($check_user))
		{
			
			if($check_user->email==$data['email'] && $check_user->contact_number==$data['country_code'].$data['contact'])
			{
				return "2";
			}

			elseif($check_user->email==$data['email'])
			{
				return "3";
			}

			else
			{
				return "4";
			}
		}

		/******** insert data into users table *******/
		$user_data = array('name' => $data['full_name'],
						   'email' => $data['email'],
						   'contact_number' => $data['country_code'].$data['contact'],
						   'zipcode' => $data['zipcode'],
						   'location' => $data['location'],
						   'age' => $data['age'],
						   'user_type' => 'User',
						   'paytm_no' => $data['paytm_no'],
						   'notify_status' => 'false',
						   'profile_image'=>$newfile_name,
						  );

		$this->db->insert('users',$user_data);
		$user_id =  $this->db->insert_id();



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
							'user_type' => 'User',
							'Status' => 1,
							'created_by' => '',
							'password' => $this->encryption->encrypt($this->random_password()),
							'opt_text'=>$opt
						   );

		return  $this->db->insert('login',$login_data);

		
	}

		public function updateUser($data,$newfile_name){
			//echo "a";die;
			//print_r($data);die;

		/******** update data into users table *******/

   		$user_data=$this->db->where('user_id', $data['user_id'])
				 		->update('users', 
				 			array('name' => $data['full_name'],
								   'email' => $data['email'],
								    'contact_number' => $data['contact'],
									'zipcode' => $data['zipcode'],
									'location' => $data['location'],
									'paytm_no' => $data['paytm_no'],
								     'age' => $data['age'],
								     'user_type' => 'User',
									'notify_status' => 'false',
									'profile_image'=>$newfile_name,
						  )
				 	);

		return $user_data;		 		

		
	}


	function random_password( $length = 6 ) {
		    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		    $password = substr( str_shuffle( $chars ), 0, 6);
		    return $password;
	}

/******** get all users details ********/
	public function get_active_users(){
		// $result = $this->db->select('users.user_id,users.name,users.lastName,users.seller_companyName,users.location,users.contact_number,users.email,login.Status,report_advertisements.comments,CASE WHEN `groups`.`status` IN("approved", "rejected") THEN COUNT(`groups`.`created_by`) ELSE 0 END as Total')
		// 					   ->join('login','users.user_id = login.user_id')
		// 					   ->join('groups','users.user_id=groups.created_by','left')
		// 					   ->join('report_advertisements','report_advertisements.report_userid = users.user_id','left')
		// 					   ->where('login.user_type','User')
		// 					   ->group_by('users.user_id')
 	// 						   ->get('users')
		// 					   ->result();

		$result = $this->db->select('users.user_id,users.name,users.age,users.zipcode,users.lastName,users.seller_companyName,users.location,users.contact_number,users.email,login.Status,report_advertisements.comments,CASE WHEN `groups`.`status` IN("approved", "rejected") THEN COUNT(`groups`.`created_by`) ELSE 0 END as Total')
							   ->join('login','users.user_id = login.user_id')
							   ->join('groups','users.user_id=groups.created_by','left')
							   ->join('report_advertisements','report_advertisements.advertisement_id = users.user_id','left')
							   ->where('login.user_type','User')							  
							   ->group_by('users.user_id')  
							   ->get('users')
							   ->result();
							  // print_r($this->db->last_query());die;

			return $result;

	}

/******** get user details by user_id *********/
	public function getUserDetails($user_id){
		$details  = array();
		$result = $this->db->where('user_id',$user_id)->get('users')->row();
		$report_details = $this->db->join('report_advertisements','report_advertisements.advertisement_id = users.user_id AND report_advertisements.report_type="member"')
						   ->where('users.user_id',$user_id)->get('users')->result();

						 //  print_r($report_details);die;
		
		foreach($report_details as $res){
			if($res->report_type == 'member'){
				$details[] = $this->db->join('report_advertisements','report_advertisements.report_userid = users.user_id')						
									->where('users.user_id',$res->report_userid)
									->where('report_advertisements.advertisement_id',$user_id)
									->where('report_advertisements.report_type','member')
									->get('users')->result();

				//$details['comments']= $res->comments;

				//print_r($details['comments']);die;

				//array_merge($details,$details['comments']);
			}
			//print_r($details);die;

			if($res->report_type == 'group'){
				$details[] = $this->db->join('report_advertisements','report_advertisements.advertisement_id = groups.group_id')
									->join('users','users.user_id = groups.createdby_userid')
									->where('groups.group_id',$res->advertisement_id)

									->get('groups')->result();
			}
			if($res->report_type == 'ads'){
				$details[] = $this->db
									->join('report_advertisements','report_advertisements.advertisement_id = advertisements.advertisement_id')
									->join('users','users.user_id = advertisements.createdby_userid')
									->where('advertisements.advertisement_id',$res->advertisement_id)
									->get('advertisements')->result();
			}


		}
		
		$data = array('user_details' => $result,
					  'other_details' => $details);
		return $data;
	}


/******* delete user by id******/
	public function delete_user($user_id){

		$result = $this->db->where('user_id',$user_id)
						   ->where('user_type','User')
						   ->from('users')
						   ->delete();

		return $result;
	}

	/****** Change user request status *********/
	public function change_approve_status($user_id){
		$result = $this->db->where('user_id',$user_id)->update('login',array('Status'=>1));
		return $result;
	}

	/****** Change user request status *********/
	public function change_reject_status($user_id){
		$result = $this->db->where('user_id',$user_id)->update('login',array('Status'=>2));
		return $result;
	}

	public function addReason($data){
		$reasonData = array('user_id'=>$data['user_id'],
							'reason' => $data['reason']
							);

		$result = $this->db->insert('notifications',$reasonData);
		return $result;
	}



}

