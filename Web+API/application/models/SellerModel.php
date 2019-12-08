<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SellerModel extends CI_Model{

/********* insert advertisements deatils in advertisements table ***********/
	public function insert_advertisement_details($data){
		$data1 = array(
				'advertisement_name' => $data['advertisement_name'],
				'category_id' => $data['category_id'],
				'advertisement_details' => $data['deal_details'],
				'location' => $data['location'],
				'start_date' => $data['start_date'],
				'end_date' => $data['end_date'],
				'createdby_userid' => $data['user_id'],
				'created_by' => $data['user_id'],
				'min_user_count'=>$data['min_user_count'],
				'quantity_per_user' => $data['quantity_per_user'],
				'status' => 'unapproved',
				'actual_price'=>$data['actual_price'],
				'offer_price'=>$data['offer_price'],
                'cashback_per_user'=>$data['cashback_per_user']
                //'offerforx'=>$data['costfor_x']
			);

		$query = $this->db->insert('advertisements',$data1);
		$id = $this->db->insert_id();



		if(!empty($data['subcategory_id'])){
			$query = $this->db->where('advertisement_id',$id)->update('advertisements',array('subcategory_id'=>$data['subcategory_id']));

			log_message('debug',print_r($query,TRUE));
		}
		if(!empty($data['subcategory_id2'])){
			$query = $this->db->where('advertisement_id',$id)->update('advertisements',array('subcategory2_id'=>$data['subcategory_id2']));
			log_message('debug',print_r($query,TRUE));
		}
		if(!empty($data['subcategory_id3'])){
			$query = $this->db->where('advertisement_id',$id)->update('advertisements',array('subcategory3_id'=>$data['subcategory_id3']));
			log_message('debug',print_r($query,TRUE));
		}
		if(!empty($data['subcategory_id4'])){
			$query = $this->db->where('advertisement_id',$id)->update('advertisements',array('subcategory4_id'=>$data['subcategory_id4']));
			log_message('debug',print_r($query,TRUE));
		}
		if(!empty($data['subcategory_id5'])){
			$query = $this->db->where('advertisement_id',$id)->update('advertisements',array('subcategory5_id'=>$data['subcategory_id5']));
			log_message('debug',print_r($query,TRUE));
		}
		return $id;
	}




/********** insert advertisement images in advertisement_images table **********/
	public function insert_advertisement_images($data){


		if(!empty($data['file_name'])){
			$data = array(
				'advertisement_id' => $data['advertisement_id'],
				'image_path' => $data['file_name'],
				'created_by' => $data['user_id']
				); 

			$query =  $this->db->insert('advertisements_images',$data);
			return $query;
		}
			return false;
	}

/*********** get all advertisement by user id from advertisements table **********/
	public function get_all_advertisements($user_id,$data){

$condition = "SELECT `advertisements`.`advertisement_id`,`advertisements`.`advertisement_name`,`advertisements`.`actual_price`,`advertisements`.`offer_price`,`advertisements`.`cashback_per_user`,`advertisements`.`min_user_count`, `advertisements`.`status`, date_format(`advertisements`.`end_date`, '%e %M %Y') as end_date, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, date_format(`advertisements`.`start_date`, '%e %M %Y') as start_date, `advertisements`.`advertisement_details`, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, `categories`.`category_title`, `subcategories`.`subcategory_title`, `subcategories2`.`subcategory_title2`, `subcategories3`.`subcategory_title3`, `subcategories4`.`subcategory_title4`, `subcategories5`.`subcategory_title5`, `advertisements`.`location`,`advertisements`.`category_id`,`advertisements`.`subcategory_id`,`advertisements`.`subcategory2_id`,`advertisements`.`subcategory3_id`,`advertisements`.`subcategory4_id`,`advertisements`.`subcategory5_id`
FROM `advertisements`
LEFT JOIN `advertisement_statics` ON `advertisement_statics`.`advertisement_id` = `advertisements`.`advertisement_id`
LEFT JOIN `categories` ON `categories`.`category_id` = `advertisements`.`category_id`
LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `advertisements`.`subcategory_id`
LEFT JOIN `subcategories2` ON `subcategories2`.`subcategory2_id` = `advertisements`.`subcategory2_id`
LEFT JOIN `subcategories3` ON `subcategories3`.`subcategory3_id` = `advertisements`.`subcategory3_id`
LEFT JOIN `subcategories4` ON `subcategories4`.`subcategory4_id` = `advertisements`.`subcategory4_id`
LEFT JOIN `subcategories5` ON `subcategories5`.`subcategory5_id` = `advertisements`.`subcategory5_id`
WHERE (( '" . $data['start_from_date'] . "'='' OR  `start_date` BETWEEN '" . $data['start_from_date'] . "' AND '" . $data['start_to_date'] . "')
 AND ( '" . $data['end_from_date'] . "'='' OR `end_date` BETWEEN '" . $data['end_from_date'] . "' AND '" . $data['end_to_date'] . "')
 AND ( '" . $data['category_id'] . "'='' OR `advertisements`.`category_id` = '" . $data['category_id'] . "')
 AND ('" . $data['subcategory_id'] . "'='' OR `advertisements`.`subcategory_id` ='" . $data['subcategory_id'] . "')
  AND ('" . $data['location'] . "'='' OR `advertisements`.`location` like '%" . $data['location'] . "%')
   AND ('" . $data['advertisement_name'] . "'='' OR `advertisements`.`advertisement_name` like '%" . $data['advertisement_name'] . "%')
 AND (`advertisements`.`created_by` = '" . $user_id . "'))";
	
// print_r($condition);die;

$query = $this->db->query($condition)->result();

 return $query;
		// return $this->db->select('advertisements.advertisement_id,advertisements.status,date_format(advertisements.end_date,"%e %M %Y") as end_date,advertisement_statics.views_count,advertisement_statics.group_count,date_format(advertisements.start_date,"%e %M %Y") as start_date,advertisements.advertisement_details,advertisement_statics.views_count,advertisement_statics.group_count,categories.category_title,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,advertisements.location')
  //                        ->join('advertisement_statics','advertisement_statics.advertisement_id = advertisements.advertisement_id','left')
 	// 						->join('categories','categories.category_id = advertisements.category_id','left')
  //                         ->join('subcategories','subcategories.subcategory_id = advertisements.subcategory_id','left')
  //                         ->join('subcategories2','subcategories2.subcategory2_id = advertisements.subcategory2_id','left')
  //                         ->join('subcategories3','subcategories3.subcategory3_id = advertisements.subcategory3_id','left')
  //                         ->join('subcategories4','subcategories4.subcategory4_id = advertisements.subcategory4_id','left')
  //                         ->join('subcategories5','subcategories5.subcategory5_id = advertisements.subcategory5_id','left')

                                                        

  //                         ->where('advertisements.createdby_userid',$user_id)
  //                         ->where('advertisements.created_by',$user_id)
  //                         ->order_by('advertisements.advertisement_id','desc')
  //                       //  ->group_by('advertisements.advertisement_id')
  //                         ->get('advertisements')
  //                         ->result();

                        
	}

	/*********** get advertisement images from advertisement_images table ******/
      public function get_advertisement_images(){
            return $this->db->select('advertisements_images.advertisement_id,advertisements_images.image_id,advertisements_images.image_path')
                          ->join('advertisements_images','advertisements_images.advertisement_id = advertisements.advertisement_id','left')
                          ->get('advertisements')
                          ->result();
      }

/************ get particulaer advertisement details by advertisement id *************/
	public function get_advertisement_by_id($id){
		return $this->db->select('advertisements.advertisement_id,advertisements.quantity_per_user,advertisements.advertisement_name,advertisements.cashback_per_user,advertisements.actual_price,advertisements.offer_price,advertisements.min_user_count,advertisements.status,date_format(advertisements.end_date,"%e %M %Y") as end_date,date_format(advertisements.start_date,"%e %M %Y") as start_date,advertisements.advertisement_details,advertisement_statics.views_count,advertisement_statics.group_count,categories.category_title,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,advertisements.location,advertisements.category_id,advertisements.subcategory_id,advertisements.subcategory2_id,advertisements.subcategory3_id,advertisements.subcategory4_id,advertisements.subcategory5_id')
                          ->join('advertisement_statics','advertisement_statics.advertisement_id = advertisements.advertisement_id','left')
                          ->join('categories','categories.category_id = advertisements.category_id','left')
                          ->join('subcategories','subcategories.subcategory_id = advertisements.subcategory_id','left')
                          ->join('subcategories2','subcategories2.subcategory2_id = advertisements.subcategory2_id','left')
                          ->join('subcategories3','subcategories3.subcategory3_id = advertisements.subcategory3_id','left')
                          ->join('subcategories4','subcategories4.subcategory4_id = advertisements.subcategory4_id','left')
                          ->join('subcategories5','subcategories5.subcategory5_id = advertisements.subcategory5_id','left')
                          ->where('advertisements.advertisement_id',$id)
                          ->get('advertisements')
                          ->result();
	}

/********** check Advertisement id is exits or not **************/
	public function check_advertisements($id,$user_id){
		return $this->db->where('advertisement_id',$id)
						->where('createdby_userid',$user_id)
						->get('advertisements')
						->row();
	}


	
	/****** Toggle status *********/

	public function toggle_status($data)
	{
		$is_approved = $data['is_approved'];
		$adv_id = $data['advertisement_id'];
		if($is_approved == 1)
			$result = $this->db->where('advertisement_id',$adv_id)->update('advertisements',array('is_approved'=>'2', 'status'=>'disabled'));
		else if ($is_approved == 2) {
			$result = $this->db->where('advertisement_id',$adv_id)->update('advertisements',array('is_approved'=>'1', 'status' => 'approved'));
		}
		return $result;
	}

/********** update Advertisement details by advertisement ID ************/
	public function update_Advertisement_details($data){
		//print_r($data);die;

     $end_date=$this->db->select('end_date')                     
                          
                           ->where('advertisement_id',$data['advertisement_id'])
                           ->get('advertisements')
                          ->row('end_date');


      $query1 = $this->db->where('advertisement_id',$data['advertisement_id'])->update('advertisements',array('HistoryOfChange' =>'Prevoious End date was'. $end_date ));

           $my_date = date('Y-m-d', strtotime($data['end_date']));


		$details = array(
				'advertisement_name'=>$data['advertisement_name'],
				'category_id' => $data['category_id'],
				'advertisement_details' => $data['deal_details'],
				'location' => $data['location'],
				'end_date' => $my_date,
				'min_user_count'=>$data['min_user_count'],
				'status' => 'unapproved',
				'is_approved'=>'0',
				'subcategory_id'=>$data['subcategory_id'],
				'subcategory2_id'=>$data['subcategory_id2'],
				'subcategory3_id'=>$data['subcategory_id3'],
				'subcategory4_id'=>$data['subcategory_id4'],
				'subcategory5_id'=>$data['subcategory_id5'],
				'actual_price'=>$data['actual_price'],
                'offer_price'=>$data['offer_price'],
                //`offerforx` => $data['offerforx'],
				'cashback_per_user'=>$data['cashback_per_user']
				
			);
		$query = $this->db->where('advertisement_id',$data['advertisement_id'])
						->where('createdby_userid',$data['user_id'])
						->update('advertisements',$details);

		
		return $my_date;
	}


	public function get_advertisement_images_by_id($id){
            return $this->db->select('advertisements_images.advertisement_id,advertisements_images.image_id,advertisements_images.image_path')
                          ->join('advertisements','advertisements.advertisement_id = advertisements_images.advertisement_id')
                          ->where('advertisements_images.advertisement_id',$id)
                          ->get('advertisements_images')
                          ->result();
      }


      /////////////////////coupon code module///////////////////////////////////////

public function get_pendiingCount($advertisement_id){

            $qnt = 0;
            $coupon_details= $this->db->select('coupon_id,quantity')                         
                          ->where('advertisement_id',$advertisement_id)
                          //->where('status','pending')
                          ->get('coupons')
                          ->result();
            foreach($coupon_details as $row){
                $qnt = $qnt + $row->quantity;       
            }
            return $qnt;
      }

      public function get_purchasedCount($advertisement_id, $user_id){


		log_message('debug', $user_id);
		$userQuery = $this->db->select('coupon_id , purchased_date')
			->where('advertisement_id', $advertisement_id)
			->where('status', 'purchased')
			->where('buyer_id', $user_id)
			->get('coupons')
			->result();

		log_message('debug', $this->db->last_query());
		$qnt = 0;
		foreach ($userQuery as $row) {
			log_message('debug', $row->purchased_date);
			$query = $this->db->select('coupon_id')
				->where('advertisement_id', $advertisement_id)
				->where('status', 'purchased')
				->where('purchased_date > ', $row->purchased_date)
				->get('coupons')
				->result();
			$qnt = count($query);
			break;
		}

		return $qnt;
      }
       public function get_orderPlacedCount($advertisement_id){


            $query= $this->db->select('coupon_id')                         
                          ->where('advertisement_id',$advertisement_id)
                          ->where('status','orderPlaced')
                          ->get('coupons')
                          ->result();

            return count($query);
      }



       public function get_pendingBuyer($advertisement_id,$page_index,$page_offset){



       	 if ($page_offset) {
     			$this->db->limit($page_offset,$page_index);
 		 }
          return $this->db->select('user_id,profile_image,name,lastName,coupons.location,coupons.address,contact_number,email,coupon_code,status,order_ref_id')
                          ->join('coupons','coupons.buyer_id = users.user_id')
                          ->where('coupons.advertisement_id',$advertisement_id)
                          ->where('coupons.status','pending')
                          ->get('users')
                          ->result();
      }

       public function get_purchasedBuyer($advertisement_id,$page_index,$page_offset){

       	 if ($page_offset) {
     			$this->db->limit($page_offset,$page_index);
 		 }

          return $this->db->select('user_id,profile_image,name,lastName,coupons.location,coupons.address,contact_number,email,coupon_code,status,order_ref_id,sequence_of_order,order_placed_date,purchased_date')
                          ->join('coupons','coupons.buyer_id = users.user_id')
                          ->where('coupons.advertisement_id',$advertisement_id)
                          ->where('coupons.status != ','pending')
                          ->get('users')
                          ->result();
      }

       public function get_filterpurchasedBuyer($advertisement_id,$page_index,$page_offset,$status){

       	 if ($page_offset) {
     			$this->db->limit($page_offset,$page_index);
 		 }

          return $this->db->select('user_id,profile_image,name,lastName,coupons.location,coupons.address,contact_number,email,coupon_code,status,order_ref_id,sequence_of_order,order_placed_date,purchased_date')
                          ->join('coupons','coupons.buyer_id = users.user_id')
                          ->where('coupons.advertisement_id',$advertisement_id)
                          ->where('coupons.status',$status)
                          ->get('users')
                          ->result();
      }

      public function get_sequence_number($advertisement_id)
	{
    		$query= $this->db->select('coupon_id')
                    ->from('coupons')
                    ->where('status','purchased')
                    ->where('advertisement_id',$advertisement_id)
                    ->get()
                    ->result();

               return count($query)+1;
	}


      public function update_order_status($user_id,$advertisement_id,$coupon_code)
		{
		 

		    $coupon_details = array(		                  
		                 
		                  'status'=>'purchased',
		                   'sequence_of_order'=>$this->get_sequence_number($advertisement_id),
		                   'purchased_date'=>$this->convertToTz('Y-m-d H:i:s',date('Y-m-d H:i:s'),'asia/calcutta',date_default_timezone_get())
		                  
		                  ); 
		     $query =  $this->db->where('buyer_id',$user_id)
		                        ->where('advertisement_id',$advertisement_id)
		                        ->where('coupon_code',$coupon_code)
		                        ->update('coupons',$coupon_details);
		      if($query)
		      {
		        return $coupon_details;
		      } 
		    else
		    {

		      return false;                 
		    }
		     
		  }

		  function convertToTz($format,$time="",$toTz='',$fromTz='')
		    {    // timezone by php friendly values
		        $date = new DateTime($time, new DateTimeZone($fromTz));
		        $date->setTimezone(new DateTimeZone($toTz));
		        $time= $date->format($format);
		        return $time;
		    }

		     public function get_seller_feed($user_id,$page_index,$page_offset,$data)
{
//   if ($page_offset) {
//      $this->db->limit($page_offset,$page_index);
//   }

//   $purchase_lists = $this->db->select('advertisements.advertisement_id,advertisements.advertisement_name,advertisements.actual_price,advertisements.offer_price,advertisements.advertisement_details,advertisements.HistoryOfChange,advertisements.user_count,advertisements.min_user_count,advertisements.location,advertisements.start_date,advertisements.end_date,advertisements.status as AdvertisementStatus,coupons.coupon_id,coupons.seller_id,coupons.buyer_id,coupons.coupon_code,coupons.order_ref_id,coupons.sequence_of_order,coupons.created_at as CouponsCreatedAt,coupons.updated_at as CouponsUpdatedAt,coupons.order_ref_id,coupons.advertisement_id,coupons.status as CouponsStatus,order_placed_date,purchased_date,users.name,users.lastName,users.email,users.contact_number,users.address,users.location,users.profile_image')
//                     ->join('advertisements','advertisements.advertisement_id = coupons.advertisement_id')                   
//                     ->join('users','users.user_id = coupons.buyer_id')
//                     ->from('coupons')
//                     ->where('coupons.seller_id',$user_id)
//                     //->or_where('order_placed_date BETWEEN '$data['end_from_date']' AND '$data['end_to_date']'')
//                     //->where()
//                     ->get()
//                     ->result();

// log_message('debug',print_r($this->db->last_query(),TRUE));
                   // $sql = $this->db->last_query();

 
 $condition = "SELECT `advertisements`.`advertisement_id`, `advertisements`.`advertisement_name`, `advertisements`.`actual_price`, `advertisements`.`offer_price`, `advertisements`.`advertisement_details`, `advertisements`.`HistoryOfChange`, `advertisements`.`user_count`, `advertisements`.`min_user_count`, `advertisements`.`location`, `advertisements`.`start_date`, `advertisements`.`end_date`, `advertisements`.`status` as `AdvertisementStatus`, `coupons`.`coupon_id`, `coupons`.`seller_id`, `coupons`.`buyer_id`, `coupons`.`coupon_code`, `coupons`.`order_ref_id`, `coupons`.`sequence_of_order`, `coupons`.`created_at` as `CouponsCreatedAt`, `coupons`.`updated_at` as `CouponsUpdatedAt`, `coupons`.`order_ref_id`, `coupons`.`advertisement_id`, `coupons`.`status` as `CouponsStatus`, `order_placed_date`, `purchased_date`, `users`.`name`, `users`.`lastName`, `users`.`email`, `users`.`contact_number`, `users`.`address`, `users`.`location`, `users`.`profile_image`
FROM `coupons`
JOIN `advertisements` ON `advertisements`.`advertisement_id` = `coupons`.`advertisement_id`
JOIN `users` ON `users`.`user_id` = `coupons`.`buyer_id`
WHERE (( '" . $data['order_placed_from_date'] . "'='' OR  `order_placed_date` BETWEEN '" . $data['order_placed_from_date'] . "' AND '" . $data['order_placed_to_date'] . "')
 AND ( '" . $data['purchased_from_date'] . "'='' OR `purchased_date` BETWEEN '" . $data['purchased_from_date'] . "' AND '" . $data['purchased_to_date'] . "') 
 AND (`coupons`.`seller_id` = '" . $user_id . "')
 AND (`coupons`.`status` = '" . $data['status'] . "'))
LIMIT " . $page_offset . " OFFSET " . $page_index . " 
 ";
 

 $query = $this->db->query($condition)->result();

 return $query;

  //return $purchase_lists;              
}
   


}