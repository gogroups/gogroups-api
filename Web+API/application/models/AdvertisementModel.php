<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvertisementModel extends CI_Model {

	public function get_active_ads($user_id,$data,$search){


		$status = array('approved', 'rejected');



		$query = "SELECT `advertisements`.`advertisement_id`,`advertisements`.`advertisement_name`,`advertisements`.`advertisement_details`,`advertisements`.`cashback_per_user`, `users`.`name`, `users`.`lastName`, `categories`.`category_title`, `subcategories`.`subcategory_title`, `advertisements`.`start_date`, `advertisements`.`end_date`, `report_advertisements`.`comments`, `advertisements`.`status`, `advertisements`.`is_approved`, `users`.`user_id`
			FROM `advertisements`
			JOIN `users` ON `users`.`user_id` = `advertisements`.`createdby_userid`
			LEFT JOIN `categories` ON `categories`.`category_id` = `advertisements`.`category_id`
			LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `advertisements`.`subcategory_id`
			LEFT JOIN `report_advertisements` ON `report_advertisements`.`advertisement_id` = `advertisements`.`advertisement_id` AND (`report_advertisements`.`report_type`='ads')
			WHERE `advertisements`.`status` IN('approved', 'rejected','expired')";

		if($user_id != null) {

			$query .= " AND `advertisements`.`createdby_userid` = ".$user_id." ";
			
		}	

		if($search != null ){
			$start_date=date('Y-m-d', strtotime( $data['start_date'] ));
			$end_date=date('Y-m-d', strtotime( $data['end_date'] ));
			$query .= " AND `advertisements`.`start_date`>= '".$start_date."' AND `advertisements`.`end_date`<= '".$end_date."' ";
		}
//print_r($data);die;
		$result = $this->db->query($query)->result();
		//print_r($result);die;
		return $result;
	}

	/*public function addReason($data){
		$reasonData = array('adver_id'=>$data['advertisement_id'],
							'reason' => $data['reason']
							);

		$result = $this->db->insert('notifications',$reasonData);
		return $result;
	}*/

	public function add_details($data){
		$start_date=date('Y-m-d', strtotime( $data['start_date'] ));
		$end_date=date('Y-m-d', strtotime( $data['end_date'] ));
		
		// $end = new DateTime($end_date);
		// $start = new DateTime($start_date);
		$adData = array(
						'advertisement_name' => $data['ads_name'],
						'category_id' => $data['categories'],
						'subcategory_id' => $data['sub_categories'],
						'subcategory2_id' => $data['sub_categories2'],
						'subcategory3_id' => $data['sub_categories3'],
						'subcategory4_id' => $data['sub_categories4'],
						'subcategory5_id' => $data['sub_categories5'],
						'advertisement_details' => $data['ads_description'],
						'HistoryOfChange' => $data['history'],
						'min_user_count' => $data['min_user_count'],
						'actual_price' => $data['actual_price'],
						'offer_price' => $data['offer_price'],
						'start_date' => $start_date,
						'end_date' => $end_date,
						'createdby_userid' => $data['users'],
						'created_by' => $data['users'],
						'status' =>'approved',
						'is_approved' => 1
						);

		$query = $this->db->insert('advertisements',$adData);
		$data1=array();

		$data1['created_by']=$data['users'];
		$data1['adv_id']=$this->db->insert_id();
		
		return $data1;

		// $this->db->query("SELECT advertisement_id, createdby_userid FROM pagination GROUP BY id DESC LIMIT 1");
		// return $query;

	}

public function update_details($data){
		//print_r($data);die;
		$start_date=date('Y-m-d', strtotime( $data['start_date'] ));
		$end_date=date('Y-m-d', strtotime( $data['end_date'] ));
		
				$adData =$this->db->where('advertisement_id', $data['ads_id'])
				 		->update('advertisements', 
						 array(
			// 'category_id' => $data['categories'],
			// 			'subcategory_id' => $data['sub_categories'],
			// 			'subcategory2_id' => $data['sub_categories2'],
			// 			'subcategory3_id' => $data['sub_categories3'],
			// 			'subcategory4_id' => $data['sub_categories4'],
			// 			'subcategory5_id' => $data['sub_categories5'],
						'advertisement_name' => $data['ads_name'],
						'advertisement_details' => $data['ads_description'],
						//'HistoryOfChange' => $data['history'],
						//'min_user_count' => $data['min_user_count'],
						'actual_price' => $data['actual_price'],
						'offer_price' => $data['offer_price'],
						'start_date' => $start_date,
						'end_date' => $end_date,
						'createdby_userid' => $data['users'],
						'created_by' => $data['users'],
						'status' =>'approved',
						'is_approved' => 1
					)
						);

return $adData;
		//$query = $this->db->update('advertisements',$adData);
		//$data1=array();

	//	$data1['created_by']=$data['users'];
	//	$data1['adv_id']=$this->db->insert_id();
		
		//return $data1;

		// $this->db->query("SELECT advertisement_id, createdby_userid FROM pagination GROUP BY id DESC LIMIT 1");
		// return $query;

	}
	public function add_image_details($adv_id,$created_by,$newfile_name)
	{
		// print_r($result['adv_id']);die;
		$adData = array('advertisement_id' => $adv_id,
						'image_path' => $newfile_name,
						'created_by' => $created_by,
						);

		//print_r($adData);die;
		 $query=$this->db->insert('advertisements_images',$adData);
		 //print_r($query);die;

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

	/******** fetch advertisement details by advertisement id *********/
	public function get_adv_details_id($adv_id){
		$details=array();
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

	$report_details = $this->db->join('report_advertisements','report_advertisements.advertisement_id = advertisements.advertisement_id AND report_advertisements.report_type="ads"')
						   ->where('advertisements.advertisement_id',$adv_id)->get('advertisements')->result();

						  //print_r($report_details);die;
		
		foreach($report_details as $res){
				$details[] = $this->db->join('report_advertisements','report_advertisements.advertisement_id = advertisements.advertisement_id')
									  ->join('users','users.user_id = report_advertisements.report_userid')					
									  ->where('users.user_id',$res->report_userid)
									  ->where('report_advertisements.advertisement_id',$adv_id)
									  ->where('report_advertisements.report_type','ads')
									  ->get('advertisements')->result();			
		
	}


		$data = array('ads_details' => $result,
					  'other_details' => $details);

		//print_r($data['ads_details']);die;

	    return $data;

		//return $result;
	}

	public function get_total_views_by_adv($adv_id)
	{
		$result = $this->db->where('advertisement_id',$adv_id)->get('advertisement_statics');
		return $result->num_rows();
	}

	/****** Change Advertisement approved  status *********/
	public function change_adv_approve_status($adv_id,$seller_id){
		$result = $this->db->where('advertisement_id',$adv_id)->update('advertisements',array('status'=>'approved', 'is_approved' => '1'));

		$notification_data=array('adver_id' => $adv_id,
								 'seller_id'=> $seller_id,
								 'status'=>'enable'

								);

		$this->db->insert('notifications',$notification_data);

		return $result;
	}


	/****** Change advertisement rejected  status *********/
	public function change_adv_reject_status($data){
		$result = $this->db->where('advertisement_id',$data['advertisement_id'])->update('advertisements',array('status'=>'rejected', 'is_approved' => '0'));

		$notification_data=array('adver_id' => $data['advertisement_id'],
								 'seller_id'=> $data['seller_id'],
								 'status'=>'disable',
								 'reason' => $data['reason']
								);

		$this->db->insert('notifications',$notification_data);
		return $result;
	}

	/********* delete advertisement by id ********/
	public function delete_advertisement($id){
		$result = $this->db->where('advertisement_id',$id)
						   ->from('advertisements')
						   ->delete();

		return $result;
	}

	public function get_active_users(){
		$result = $this->db->select('users.name,users.lastName,users.user_id')->join('login','login.user_id = users.user_id')->where('login.Status',1)->where('users.user_type','Seller')->get('users')->result();

		return $result;
	}

	public function get_all_categories(){
		$result = $this->db->get('categories')->result();

		return $result;
	}


	public function get_ads_by_date($start_date,$end_date){

	}



}
