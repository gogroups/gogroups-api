<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

/********** fetch all pending approval sellers *********/
	public function get_pending_approval_sellers(){
		$result = $this->db->select('users.user_id,users.name,users.lastName,users.seller_companyName,users.location,users.contact_number')
						   ->join('login','users.user_id = login.user_id')
						   ->where('login.user_type','Seller')
						   ->where('login.Status',0)
						   ->get('users')
						   ->result();

		return $result;
	}

/******** fetch pending approval sellers details by seller id *******/
	public function get_pending_sellers_detail($user_id){
		$result = $this->db->where('user_id',$user_id)->get('users')->row();
		return $result;
	}

/****** Change seller request status *********/
	public function change_approve_status($user_id){
		$result = $this->db->where('user_id',$user_id)->update('login',array('Status'=>1));

		return $result;
	}


/****** Change seller request status *********/
	public function change_reject_status($user_id){
		$result = $this->db->where('user_id',$user_id)->update('login',array('Status'=>2));
		return $result;
	}


/********* Fetch all pending approval ads  *******/
	public function get_pending_approval_ads(){
		$result = $this->db->join('users','users.user_id = advertisements.createdby_userid')
						   ->join('categories','categories.category_id = advertisements.category_id','left')
						   ->join('subcategories','subcategories.subcategory_id = advertisements.subcategory_id')
						   ->where('advertisements.status','unapproved')
						   ->where('advertisements.is_approved',0)
						   ->get('advertisements')
						   ->result();

		return $result;
	}


/******** fetch advertisement details by advertisement id *********/
	public function get_adv_details_id($adv_id){
		$result = $this->db->join('advertisements_images','advertisements_images.advertisement_id = advertisements.advertisement_id')
						   ->join('categories','categories.category_id = advertisements.category_id','left')
						   ->join('users','users.user_id = advertisements.createdby_userid','left')
						   ->join('subcategories','subcategories.subcategory_id = advertisements.subcategory_id','left')
						   ->join('subcategories2','subcategories2.subcategory2_id = advertisements.subcategory2_id','left')
						   ->join('subcategories3','subcategories3.subcategory3_id = advertisements.subcategory3_id','left')
						   ->join('subcategories4','subcategories4.subcategory4_id = advertisements.subcategory4_id','left')
						   ->join('subcategories5','subcategories5.subcategory5_id = advertisements.subcategory5_id','left')
						   ->where('advertisements.advertisement_id',$adv_id)
						   ->get('advertisements')
						   ->result();
		return $result;
	}

/****** Change Advertisement approved  status *********/
	public function change_adv_approve_status($adv_id,$seller_id){
		$result = $this->db->where('advertisement_id',$adv_id)->update('advertisements',array('status'=>'approved', 'is_approved' => '1'));

		$notification_data=array('adver_id' => $adv_id,
								 'seller_id'=> $seller_id,
								 'status'=>'approved'
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}
/****** Change advertisement rejected  status *********/
	public function change_adv_reject_status($data,$seller_id){
		$result = $this->db->where('advertisement_id',$data['advertisement_id'])->update('advertisements',array('status'=>'rejected', 'is_approved' => '0'));

		$notification_data=array('adver_id' => $data['advertisement_id'],
								 'seller_id'=> $seller_id,
								 'status'=>'rejected',
								 'reason'=>$data['reason']
								);

		$this->db->insert('notifications',$notification_data);

		return $result;
	}

/******* Fetch a;; pending approval groups details *******/
	public function get_pending_approval_groups(){

		$result = $this->db->select('groups.group_id,groups.group_name,groups.location,users.user_id,groups.start_date,groups.end_date,users.name,users.lastName,categories.category_title,subcategories.subcategory_title')
						   ->join('users','users.user_id = groups.createdby_userid')
						   ->join('categories','categories.category_id = groups.category_id','left')
						   ->join('subcategories','subcategories.subcategory_id = groups.subcategory_id','left')
						   ->where('groups.status','unapproved')
						   ->where('groups.is_approved',0)
						   ->where('groups.is_approved is NOT NULL', NULL, FALSE)
						   // ->where('groups.channelkey != ','0')
						   ->get('groups')
						   ->result();

		return $result;
	}

/*********** get group details by id *****************/
	public function get_group_details_id($group_id){
		$details  = array();

		$result = $this->db->select('groups.group_id, groups.group_name, groups.group_image, groups.location, groups.category_id, groups.subcategory_id, groups.subcategory2_id, groups.subcategory3_id, groups.subcategory4_id, groups.subcategory5_id, groups.createdby_userid, users.name, users.user_id, groups.cost_range, groups.members_count, groups.start_date, groups.end_date, groups.description, groups.HistoryOfChange, groups.status, groups.is_approved, groups.rating, groups.check_join_count, groups.created_by, groups.created_date, groups.modify_date, categories.category_title,subcategories.subcategory_title, subcategories2.subcategory_title2, subcategories3.subcategory_title3, subcategories4.subcategory_title4, subcategories5.subcategory_title5 ')
						   ->join('categories','categories.category_id = groups.category_id','left')
						   ->join('users','users.user_id = groups.createdby_userid','left')
						   ->join('subcategories','subcategories.subcategory_id = groups.subcategory_id','left')
						   ->join('subcategories2','subcategories2.subcategory2_id = groups.subcategory2_id','left')
						   ->join('subcategories3','subcategories3.subcategory3_id = groups.subcategory3_id','left')
						   ->join('subcategories4','subcategories4.subcategory4_id = groups.subcategory4_id','left')
						   ->join('subcategories5','subcategories5.subcategory5_id = groups.subcategory5_id','left')
						   ->where('groups.group_id',$group_id)
						   ->get('groups')
						   ->row();

		$report_details = $this->db->join('report_advertisements','report_advertisements.advertisement_id = groups.group_id AND report_advertisements.report_type="group" ')
						   ->where('groups.group_id',$group_id)->get('groups')->result();

						 // print_r($report_details);die;
		
		foreach($report_details as $res){
				$details[] = $this->db->join('report_advertisements','report_advertisements.advertisement_id = groups.group_id')
									  ->join('users','users.user_id = report_advertisements.report_userid')					
									  ->where('users.user_id',$res->report_userid)
									  ->where('report_advertisements.advertisement_id',$group_id)
									  ->where('report_advertisements.report_type','group')
									  ->get('groups')->result();			
		
	}


		$data = array('group_details' => $result,
					  'other_details' => $details);

		//print_r($details);die;

	return $data;

	//print_r($details);die;
}

		public function edit_group_image($group_id,$image_name)
		{
			$edit_image = $this->db->where('group_id',$group_id)->update('groups',array('group_image'=>$image_name));
			return $edit_image;
		}

		public function get_joined_members_count_by_group($group_id)
		{
			$users_count = $this->db->where('group_id',$group_id)->where('join_status',1)->get('user_groups');
			return $users_count->num_rows();
		}

/****** Change Group approved  status *********/
	public function change_group_approve_status($group_id,$user_id){
		$result = $this->db->where('group_id',$group_id)->update('groups',array('status'=>'approved', 'is_approved' => '1'));

		$notification_data=array('group_id' => $group_id,
								 'user_id'=> $user_id,
								 'status'=> 'approved'
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}

/****** Change Group rejected  status *********/
	public function change_group_reject_status($data,$user_id){
		$result = $this->db->where('group_id',$data['group_id'])->update('groups',array('status'=>'rejected', 'is_approved' => '0'));


		$notification_data=array('group_id' =>$data['group_id'],
								 'user_id'=> $user_id,
								 'status'=>'rejected',
								 'reason'=>$data['reason']
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}


/******* get users details by user_id *********/
	public function get_user_detail_by($user_id){
		$result = $this->db->where('user_id',$user_id)->get('users')->row();
		return $result;

	}

/****** get total count of sellers *********/
	public function get_total_count_sellers(){
		$query = $this->db->select('users.user_id,users.name,users.lastName,users.seller_companyName,users.location,users.contact_number')
						   ->join('users','users.user_id = login.user_id')
						   ->where('login.user_type','Seller')
						   ->where('login.Status',1)
						   ->get('login')
						   ->result();


		$result = count($query);
		return $result;

	}

	public function get_total_count_users(){
		$query = $this->db->select('users.user_id,users.name,users.lastName,users.seller_companyName,users.location,users.contact_number')
						   ->join('users','users.user_id = login.user_id')
						   ->where('login.user_type','User')
						   ->where('login.opt_verify_status',1)
						   ->get('login')
						   ->result();


		$result = count($query);
		return $result;
	}

	public function get_total_count_ads(){
		$query = $this->db->where('status','approved')
						  ->where('is_approved',1)
						  ->get('advertisements')
						  ->result();

		$result = count($query);
		return $result;
	}


	public function admin_login_check($data)
	{
		$pass=$data['password'];
		 $password=$this->encryption->encrypt($pass);
		$password=$this->encryption->decrypt($password);
		$result= $this->db->select('user_id,user_name')
							->where('user_name',$data['email'])
							->where('password',$password)
							->where('user_type','Admin')
							->get('login')->row();

		return $result;
	}

	public function get_banners()
 	{
       return $this->db->select('*')
                    ->from('banner')   
                    ->get()
                    ->result();

               
  	}

  	public function delete_banner($banner_id)
 	{
 		$result = $this->db->where('ID',$banner_id)
						   ->from('banner')
						   ->delete();

		return $result;
               
  	}

  	public function insert_banner($filename)
 	{
 		$bannerData = array(
					'image_name' => $filename,
					);

		return $this->db->insert('banner',$bannerData);

               
  	}

  	public function get_group_info($group_id){
		$query = $this->db->select('group_name,category_id')
							->where('group_id',$group_id)						 
						    ->get('groups')
						    ->row();

		
		return $query;
	}

	
}