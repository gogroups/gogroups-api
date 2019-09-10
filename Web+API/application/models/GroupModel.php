<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupModel extends CI_Model {

	public function get_groups_details($user_id,$data,$search){

		$query = "SELECT groups.group_id,groups.group_name,groups.location,groups.status,users.user_id,groups.start_date,groups.end_date,users.name,users.lastName,categories.category_title,subcategories.subcategory_title,report_advertisements.* FROM `groups` JOIN `users` ON `users`.`user_id` = `groups`.`createdby_userid` LEFT JOIN `report_advertisements` ON `report_advertisements`.`advertisement_id`=`groups`.`group_id` AND (`report_advertisements`.`report_type`='group') LEFT JOIN `categories` ON `categories`.`category_id` = `groups`.`category_id` LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `groups`.`subcategory_id` WHERE `groups`.`status` IN('approved', 'rejected','unapproved','expired')";
		 
		if($user_id != null) {

			$query .= " AND `groups`.`createdby_userid` = ".$user_id." AND `groups`.`status` IN('approved', 'rejected','unapproved','expired') ";
			
		}	

		if($search != null ){
			$start_date=date('Y-m-d', strtotime( $data['start_date'] ));
			$end_date=date('Y-m-d', strtotime( $data['end_date'] ));
			$query .= " AND `groups`.`start_date`>= '".$start_date."' AND `groups`.`end_date`<= '".$end_date."' ";
		}		   

		$result = $this->db->query($query)->result();
		//print_r($result);die;
		return $result;

		/*$status = array('approved', 'rejected');
		$result = $this->db->join('users','users.user_id = groups.createdby_userid')
						   ->join('categories','categories.category_id = groups.category_id','left')
						   ->join('subcategories','subcategories.subcategory_id = groups.subcategory_id','left')
						   ->where_in('groups.status',$status)
						   ->get('groups')
						   ->result();

		print_r($this->db->last_query());die;*/

	} 


	public function add_details($data,$newfile_name){
		$start_date = $data['start_date'];
		$end_date = $data['end_date'];
		$end = new DateTime($end_date);
		$start = new DateTime($start_date);
		//print_r($data);die;

		$adData = array('category_id' => $data['categories'],
						'subcategory_id' => $data['sub_categories'],
						'subcategory2_id' => $data['sub_categories2'],
						'subcategory3_id' => $data['sub_categories3'],
						'subcategory4_id' => $data['sub_categories4'],
						'subcategory5_id' => $data['sub_categories5'],
						'description' => $data['ads_description'],
						'HistoryOfChange' => $data['history'],
						'members_count' => $data['user_count'],
						'start_date' => $start->format('Y-m-d'),
						'end_date' => $end->format('Y-m-d'),
						'createdby_userid' => $data['users'],
						'created_by' => $data['users'],
						'status' =>'approved',
						'is_approved' => 1,
						'group_name' => $data['group_name'],
						'group_image'=>$newfile_name,
						);

		return $this->db->insert('groups',$adData);
	}
	
	public function update_details($data,$newfile_name){
		$start_date = $data['start_date'];
		$end_date = $data['end_date'];
		$end = new DateTime($end_date);
		$start = new DateTime($start_date);
		//print_r($data);die;
		
		$user_data=$this->db->where('group_id', $data['group_id'])
				 		->update('groups', 
				 				// 	array('category_id' => $data['categories'],
									// 'subcategory_id' => $data['sub_categories'],
									// 'subcategory2_id' => $data['sub_categories2'],
									// 'subcategory3_id' => $data['sub_categories3'],
									// 'subcategory4_id' => $data['sub_categories4'],
									// 'subcategory5_id' => $data['sub_categories5'],
									array('description' => $data['ads_description'],
									'members_count' => $data['user_count'],
									'start_date' => $start->format('Y-m-d'),
									'end_date' => $end->format('Y-m-d'),
									'createdby_userid' => $data['users'],
									'created_by' => $data['users'],
									//'status' =>'approved',
									//'is_approved' => 1,
									'group_name' => $data['group_name'],
									'group_image'=>$newfile_name,
									)
				 				);

		return $user_data;		 	


	}

	public function addReason($data){
		$reasonData = array('group_id'=>$data['group_id'],
							'reason' => $data['reason']
							);

		$result = $this->db->insert('notifications',$reasonData);
		return $result;
	}
	public function get_active_users(){
		$result = $this->db->select('users.name,users.lastName,users.user_id')->join('login','login.user_id = users.user_id')->where('login.Status',1)->where('users.user_type','User')->get('users')->result();

		return $result;
	}

	public function get_all_categories(){
		$result = $this->db->get('categories')->result();

		return $result;
	}

	public function get_sub_category($id){
		return $this->db->where('category_id',$id)->get('subcategories')->result();

	}
	public function get_sub_category2($id){
		return $this->db->where('subcategory_id',$id)->get('subcategories2')->result();

	}
	public function get_sub_category3($id){
		return $this->db->where('subcategory2_id',$id)->get('subcategories3')->result();

	}
	public function get_sub_category4($id){
		return $this->db->where('subcategory3_id',$id)->get('subcategories4')->result();

	}
	public function get_sub_category5($id){
		return $this->db->where('subcategory4_id',$id)->get('subcategories5')->result();

	}


	public function delete_group($id){
		$result = $this->db->where('group_id',$id)
						   ->from('groups')
						   ->delete();

		return $result;
	} 

	/****** Change Group approved  status *********/
	public function change_group_approve_status($group_id,$user_id){
		$result = $this->db->where('group_id',$group_id)->update('groups',array('status'=>'approved', 'is_approved' => '1'));

		$notification_data=array('group_id' => $group_id,
								 'user_id'=> $user_id,
								 'status'=>'enable'
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}

	/****** Change Group rejected  status *********/
	public function change_group_reject_status($data){
		//print_r($data['group_id']);die;
		$result = $this->db->where('group_id',$data['group_id'])->update('groups',array('status'=>'rejected', 'is_approved' => '0'));

		$notification_data=array('group_id' => $data['group_id'],
								 'user_id'=> $data['user_id'],
								 'status'=>'disable',
								 'reason'=>$data['reason']
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}
}