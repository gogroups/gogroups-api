<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BuyerModel extends CI_Model
{


      /*********** insert group details by a particular user in group table *******/
      public function create_group($data)
      {

            $group_details = array(
                  'group_name' => $data['group_name'],

                  'group_image' => $data['file_name'],
                  'location' => $data['location'],
                  'category_id' => $data['category_id'],
                  'createdby_userid' => $data['createdby_userid'],
                  'cost_range' => $data['cost_range'],
                  'members_count' => $data['members_count'],
                  'start_date' => $data['start_date'],
                  'end_date' => $data['end_date'],
                  'description' => $data['description'],
                  'status' => 'unapproved',
                  'created_by' => $data['user_id']
            );
            $query =  $this->db->insert('groups', $group_details);
            $id = $this->db->insert_id();
            if (!empty($data['subcategory_id'])) {
                  $query = $this->db->where('group_id', $id)->update('groups', array('subcategory_id' => $data['subcategory_id']));
            }
            if (!empty($data['subcategory_id2'])) {
                  $query = $this->db->where('group_id', $id)->update('groups', array('subcategory2_id' => $data['subcategory_id2']));
            }
            if (!empty($data['subcategory_id3'])) {
                  $query = $this->db->where('group_id', $id)->update('groups', array('subcategory3_id' => $data['subcategory_id3']));
            }
            if (!empty($data['subcatgeory_id4'])) {
                  $query = $this->db->where('group_id', $id)->update('groups', array('subcategory4_id' => $data['subcategory_id4']));
            }
            if (!empty($data['subcategory_id5'])) {
                  $query = $this->db->where('group_id', $id)->update('groups', array('subcategory5_id' => $data['subcategory_id5']));
            }

            $data = array(
                  'group_id' => $id,
                  'group_image' => base_url() . 'groupImages/' . $data['file_name'],
            );

            return $data;
      }

      public function update_group($data)
      {

            $end_date = $this->db->select('end_date')
                  ->where('group_id', $data['group_id'])
                  ->get('groups')
                  ->row('end_date');


            $query1 = $this->db->where('group_id', $data['group_id'])->update('groups', array('HistoryOfChange' => 'Prevoious End date was' . $end_date));

            $my_date = date('Y-m-d', strtotime($data['end_date']));


            $group_details = array(

                  'end_date' => $my_date,
                  'status' => 'unapproved',
                  'is_approved' => '0',

            );

            $query = $this->db->where('group_id', $data['group_id'])->update('groups', $group_details);



            return $data['group_id'];
      }







      public function UpdateGroup($data)
      {
            $query = $this->db->where('group_id', $data['group_id'])->update('groups', array('channelkey' => $data['channelKey']));
            return $query;
      }


      /************** get user's created group details by user Id from groups table *********/
      public function get_create_group_details($user_id)
      {

            return  $this->db->select('groups.group_id,groups.channelkey,groups.group_name,groups.group_image,categories.category_id,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.cost_range,groups.members_count,date_format(groups.start_date,"%e %M %Y") as start_date,date_format(groups.end_date,"%e %M %Y") as end_date,groups.description,groups.status')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  ->where('groups.createdby_userid', $user_id)
                  ->where('groups.created_by', $user_id)
                  ->where('groups.status', 'approved')
                  ->where('groups.is_approved', 1)
                  // ->where('groups.channelkey != ',0)
                  ->order_by('groups.group_id', 'desc')
                  ->get('groups')
                  ->result();
      }

      public function get_owncreate_group_details($user_id)
      {

            return  $this->db->select('groups.group_id,groups.channelkey,groups.group_name,groups.group_image,categories.category_id,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.cost_range,groups.members_count,date_format(groups.start_date,"%e %M %Y") as start_date,date_format(groups.end_date,"%e %M %Y") as end_date,groups.description,groups.status')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  ->where('groups.createdby_userid', $user_id)
                  ->where('groups.created_by', $user_id)
                  //->where('groups.channelkey != ','0')                            
                  ->order_by('groups.status', 'asc')
                  ->get('groups')
                  ->result();
      }



      /*********** get all advertisements from advertisement table ***********/
      public function get_all_advertisements($id, $data)
      {

            $this->load->helper('date');

            $currentdate = date("Y-m-d", strtotime("+330 minutes"));

            $condition = "SELECT `advertisements`.`advertisement_id`,`advertisements`.`advertisement_name`,`advertisements`.`created_by`,`advertisements`.`actual_price`,`advertisements`.`offer_price`,`advertisements`.`offerfortwo`, `offerforx` , `advertisements`.`status`,`advertisements`.`min_user_count`,`advertisements`.`quantity_per_user`, date_format(`advertisements`.`end_date`, '%e %M %Y') as end_date, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, date_format(`advertisements`.`start_date`, '%e %M %Y') as start_date, `advertisements`.`advertisement_details`, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, `categories`.`category_title`, `subcategories`.`subcategory_title`, `subcategories2`.`subcategory_title2`, `subcategories3`.`subcategory_title3`, `subcategories4`.`subcategory_title4`, `subcategories5`.`subcategory_title5`, `advertisements`.`location`
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
  AND ('" . $data['advertisement_name'] . "'='' OR `advertisements`.`advertisement_details` like '%" . $data['advertisement_name'] . "%' OR `advertisements`.`advertisement_name` like '%" . $data['advertisement_name'] . "%')
  AND (`categories`.`category_id` = '" . $id . "')
 AND (`advertisements`.`status` = 'approved')
AND (`advertisements`.`is_approved` = '1')
AND (`advertisements`.`start_date` <= '" . $currentdate . "')
AND (`advertisements`.`end_date` >= '" . $currentdate . "'))";

            // AND (`groups`.`group_name` like '%" . $search_text . "%')

            $query = $this->db->query($condition)->result();

            return $query;
      }


      public function get_all_favadvertisements($id)
      {

            $this->load->helper('date');

            $currentdate = date("Y-m-d");

            $condition = "SELECT `advertisements`.`advertisement_id`,`advertisements`, `offerforx` .`advertisement_name`,`advertisements`.`actual_price`,`advertisements`.`offer_price`, `advertisements`.`offerfortwo`,`advertisements`.`status`, date_format(`advertisements`.`end_date`, '%e %M %Y') as end_date, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, date_format(`advertisements`.`start_date`, '%e %M %Y') as start_date, `advertisements`.`advertisement_details`, `advertisement_statics`.`views_count`, `advertisement_statics`.`group_count`, `categories`.`category_title`, `subcategories`.`subcategory_title`, `subcategories2`.`subcategory_title2`, `subcategories3`.`subcategory_title3`, `subcategories4`.`subcategory_title4`, `subcategories5`.`subcategory_title5`, `advertisements`.`location`
FROM `advertisements`
LEFT JOIN `advertisement_statics` ON `advertisement_statics`.`advertisement_id` = `advertisements`.`advertisement_id`
LEFT JOIN `categories` ON `categories`.`category_id` = `advertisements`.`category_id`
LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `advertisements`.`subcategory_id`
LEFT JOIN `subcategories2` ON `subcategories2`.`subcategory2_id` = `advertisements`.`subcategory2_id`
LEFT JOIN `subcategories3` ON `subcategories3`.`subcategory3_id` = `advertisements`.`subcategory3_id`
LEFT JOIN `subcategories4` ON `subcategories4`.`subcategory4_id` = `advertisements`.`subcategory4_id`
LEFT JOIN `subcategories5` ON `subcategories5`.`subcategory5_id` = `advertisements`.`subcategory5_id`
LEFT JOIN `views` ON `views`.`advertisement_id` = `advertisements`.`advertisement_id`
WHERE ((`views`.`user_id` = '" . $id . "')
 AND (`advertisements`.`status` = 'approved')
 AND (`views`.`Favorites_ads` = '1')
AND (`advertisements`.`is_approved` = '1')
AND (`advertisements`.`start_date` <= '" . $currentdate . "')
AND (`advertisements`.`end_date` >= '" . $currentdate . "'))";

            // print_r($condition);die;

            $query = $this->db->query($condition)->result();

            return $query;
      }

      /*********** get advertisement images from advertisement_images table ******/
      public function get_advertisement_images()
      {
            return $this->db->select('advertisements_images.advertisement_id,advertisements_images.image_id,advertisements_images.image_path')
                  ->join('advertisements_images', 'advertisements_images.advertisement_id = advertisements.advertisement_id', 'left')
                  ->get('advertisements')
                  ->result();
      }
      /********* get advertivertisemet details by advertisement id *************/
      public function get_advertisement_by_id($id)
      {
            return $this->db->select('advertisements.advertisement_id,advertisements.quantity_per_user,advertisements.offerforx,advertisements.advertisement_name,advertisements.offerfortwo,advertisements.actual_price,advertisements.offer_price,advertisements.status,advertisements.min_user_count,date_format(advertisements.start_date,"%e %M %Y") as start_date,date_format(advertisements.end_date,"%e %M %Y") as end_date,advertisements.advertisement_details,advertisement_statics.views_count,advertisement_statics.group_count,categories.category_title,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,advertisements.location')
                  ->join('advertisement_statics', 'advertisement_statics.advertisement_id = advertisements.advertisement_id', 'left')
                  ->join('categories', 'categories.category_id = advertisements.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = advertisements.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = advertisements.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = advertisements.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = advertisements.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = advertisements.subcategory5_id', 'left')
                  ->where('advertisements.advertisement_id', $id)
                  // ->where('advertisements.status','approved')
                  // ->where('advertisements.is_approved',1)
                  ->get('advertisements')
                  ->result();
      }

      public function getSellerContact($id)
      {
            return $this->db->select('contact_number,email,createdby_userid,name,lastName,address')
                  ->join('users', 'users.user_id = advertisements.createdby_userid', 'left')
                  ->where('advertisements.advertisement_id', $id)
                  // ->where('advertisements.status','approved')
                  // ->where('advertisements.is_approved',1)
                  ->get('advertisements')
                  ->row();
      }

      /********* get advertisement images by advertisement id ****************/
      public function get_advertisement_images_by_id($id)
      {
            return $this->db->select('advertisements_images.advertisement_id,advertisements_images.image_id,advertisements_images.image_path')
                  ->join('advertisements', 'advertisements.advertisement_id = advertisements_images.advertisement_id', 'left')
                  ->join('users', 'advertisements.created_by = users.user_id')
                  ->where('advertisements_images.advertisement_id', $id)
                  // ->where('advertisements.status','approved')
                  // ->where('advertisements.is_approved',1)
                  ->order_by('advertisements_images.advertisement_id', 'desc')
                  ->get('advertisements_images')
                  ->result();
      }

      public function get_advertisement_images_for_group($group_id)
      {
            return $this->db->select('advertisements.advertisement_id,advertisements.advertisement_name,advertisements.end_date,advertisements.actual_price,advertisements.offer_price,users.name,users.lastName')
                  ->from('advertisements')
                  ->join('group_advertisements', 'group_advertisements.advertisement_id = advertisements.advertisement_id')
                  ->join('users', 'advertisements.created_by = users.user_id')
                  ->where('group_advertisements.group_id', $group_id)
                  ->where('advertisements.status', 'approved')
                  ->where('advertisements.is_approved', 1)

                  ->get()
                  ->result();
      }

      /************ get all categories details from categories table, group table ***********/
      public function get_all_categories_details()
      {
            return $this->db->select('category_id,category_title,category_image')
                  ->get('categories')
                  ->result();
      }

      public function get_all_groupIds($category_id)
      {
            return $this->db->select('group_id')
                  ->where('category_id', $category_id)
                  ->where('status', 'approved')
                  ->where('is_approved', 1)
                  ->get('groups')
                  ->result();
      }

      /************* get group count by category_id **************/
      public function get_group_count($id)
      {
            $query =  $this->db->join('groups', 'groups.category_id = categories.category_id')
                  ->where('groups.category_id', $id)
                  ->where('groups.status', 'approved')
                  ->where('groups.is_approved', 1)
                  ->get('categories')
                  ->result();
            return count($query);
      }

      public function get_joinStatus($userid, $group_id)
      {
            $query =  $this->db->select('join_status')
                  ->where('user_id', $userid)
                  ->where('group_id', $group_id)
                  ->get('user_groups')
                  ->row('join_status');
            return $query;
      }

      public function get_favAdsStatus($userid, $advertisement_id)
      {
            $query =  $this->db->select('Favorites_ads')
                  ->where('user_id', $userid)
                  ->where('advertisement_id', $advertisement_id)
                  ->get('views')
                  ->row('Favorites_ads');
            return $query;
      }

      public function get_favStatus($userid, $group_id)
      {
            $query =  $this->db->select('user_favourite')
                  ->where('user_id', $userid)
                  ->where('group_id', $group_id)
                  ->get('user_groups')
                  ->row('user_favourite');
            return $query;
      }


      /******** Get category_id by group's details from groups table ************/
      public function get_category_by_groups($id, $search_text, $data)
      {

            $this->load->helper('date');

            $currentdate = date("Y-m-d");

            $condition = "SELECT `groups`.`group_id`,`groups`.`channelkey`,`groups`.`created_by`, `groups`.`location` as `groupLocation`, `users`.`profile_image`, `users`.`name`, `users`.`location`, `categories`.`category_title`,`categories`.`category_id`, `subcategories`.`subcategory_id`, `subcategories`.`subcategory_title`, `subcategories2`.`subcategory_title2`, `subcategories3`.`subcategory_title3`, `subcategories4`.`subcategory_title4`, `subcategories5`.`subcategory_title5`, `groups`.`rating`, `groups`.`group_name`, `groups`.`group_image`, `groups`.`cost_range`, DATE_FORMAT(`groups`.`end_date`, '%e %M %Y') as end_date,DATE_FORMAT(`groups`.`start_date`, '%e %M %Y') as start_date, `groups`.`members_count`, `groups`.`description`, `user_groups`.`join_status`
FROM `groups`
LEFT JOIN `categories` ON `categories`.`category_id` = `groups`.`category_id`
LEFT JOIN `subcategories` ON `subcategories`.`subcategory_id` = `groups`.`subcategory_id`
LEFT JOIN `subcategories2` ON `subcategories2`.`subcategory2_id` = `groups`.`subcategory2_id`
LEFT JOIN `subcategories3` ON `subcategories3`.`subcategory3_id` = `groups`.`subcategory3_id`
LEFT JOIN `subcategories4` ON `subcategories4`.`subcategory4_id` = `groups`.`subcategory4_id`
LEFT JOIN `subcategories5` ON `subcategories5`.`subcategory5_id` = `groups`.`subcategory5_id`
LEFT JOIN `users` ON `users`.`user_id` = `groups`.`createdby_userid`
LEFT JOIN `user_groups` ON `user_groups`.`user_id` =`users`.`user_id`
WHERE (( '" . $data['start_from_date'] . "'='' OR  `start_date` BETWEEN '" . $data['start_from_date'] . "' AND '" . $data['start_to_date'] . "' )
 AND ( '" . $data['end_from_date'] . "'='' OR `end_date` BETWEEN '" . $data['end_from_date'] . "' AND '" . $data['end_to_date'] . "')
AND ( '" . $data['category_id'] . "'='' OR `groups`.`category_id` = '" . $data['category_id'] . "')
 AND ('" . $data['subcategory_id'] . "'='' OR `groups`.`subcategory_id` ='" . $data['subcategory_id'] . "')
  AND ('" . $data['location'] . "'='' OR `groups`.`location` like '%" . $data['location'] . "%')

 AND ('" . $data['cost_range_from'] . "'='' OR  `cost_range` BETWEEN '" . $data['cost_range_from'] . "' AND '" . $data['cost_range_to'] . "')
AND ('" . $data['group_name'] . "'='' OR `groups`.`group_name` like '%" . $data['group_name'] . "%')

 AND (`groups`.`category_id` = '" . $id . "')
 AND (`groups`.`status` = 'approved')
AND (`groups`.`is_approved` = '1' )

AND (`groups`.`description` like '%" . $search_text . "%' OR `groups`.`group_name` like '%" . $search_text . "%')
AND (`groups`.`start_date` <= '" . $currentdate . "')
AND (`groups`.`end_date` >= '" . $currentdate . "'))

GROUP BY `groups`.`group_id`

ORDER BY `groups`.`status`

";
            //AND (`groups`.`location` like '%" . $search_text . "%' OR `groups`.`group_name` like '%" . $search_text . "%')
            //AND (`groups`.`channelkey` != '0' )

            //  // AND ( '" . $data['end_date'] . "'='' OR `end_date` <= '" . $data['end_date'] . "')
            //  // AND ( '" . $data['category_id'] . "'='' OR `groups`.`category_id` = '" . $data['category_id'] . "')
            //  // AND ('" . $data['subcategory_id'] . "'='' OR `groups`.`subcategory_id` ='" . $data['subcategory_id'] . "')
            //  // AND ('" . $data['location'] . "'='' OR `location` ='" . $data['location'] . "')
            //  // AND ('" . $data['cost_range'] . "'='' OR `cost_range` <='" . $data['cost_range'] . "')

            // // WHERE ((`start_date` >= '2017-09-26' OR '2017-09-26' = '' )
            // // AND  `groups`.`category_id` = '1'
            // //  AND `groups`.`status` = 'active'
            // //   AND `groups`.`is_approved` = '1' 
            // //   AND `groups`.`group_name` like '% % '");


            $query = $this->db->query($condition)->result();

            return $query;


            // return $this->db->select('groups.group_id,groups.location as groupLocation,users.profile_image,users.name,users.location,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.rating,groups.group_name,groups.group_image,groups.cost_range,DATE_FORMAT(groups.end_date,"%e %M %Y") as end_date,groups.members_count,groups.description,user_groups.join_status')
            //                 ->join('categories','categories.category_id = groups.category_id')
            //                 ->join('subcategories','subcategories.subcategory_id = groups.subcategory_id','left')
            //                 ->join('subcategories2','subcategories2.subcategory2_id = groups.subcategory2_id','left')
            //                 ->join('subcategories3','subcategories3.subcategory3_id = groups.subcategory3_id','left')
            //                 ->join('subcategories4','subcategories4.subcategory4_id = groups.subcategory4_id','left')
            //                 ->join('subcategories5','subcategories5.subcategory5_id = groups.subcategory5_id','left')
            //                 ->join('users','users.user_id = groups.createdby_userid','left')
            //                 ->join('user_groups','user_groups.user_id = groups.createdby_userid','left')
            //                 ->where('groups.category_id',$id)
            //                ->where('groups.group_name like', '%'.$search_text.'%')
            //                // ->or_where(array('groups.start_date=' => $start_date, $start_date => ''))

            //                 ->where('groups.status','active')
            //                 ->where('groups.is_approved',1)
            //                 // ->where($start_dateCond)
            //                 ->get('groups')
            //                 ->result();



      }

      /********* get group's details by group id from groups table *********/
      public function get_group_details($id)
      {
            return $this->db->select('groups.group_id,groups.channelkey,groups.category_id,groups.group_name,groups.location as groupLocation,users.user_id,users.name,users.location,users.profile_image,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.rating,groups.group_image,groups.cost_range,DATE_FORMAT(groups.end_date,"%e %M %Y") as end_date,DATE_FORMAT(groups.start_date,"%e %M %Y") as start_date,groups.members_count,groups.description,user_groups.join_status,groups.created_by')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  ->join('user_groups', 'user_groups.user_id = groups.createdby_userid', 'left')
                  ->join('users', 'users.user_id = groups.createdby_userid')
                  ->where('groups.group_id', $id)
                  // ->where('groups.status','active')
                  // ->where('groups.is_approved',1)
                  ->order_by('groups.group_id', 'desc')
                  ->get('groups')
                  ->result();
      }

      public function get_group_detailBy_ID($id)
      {
            return $this->db->select('groups.group_id,groups.channelkey,groups.category_id,groups.group_name,groups.location,groups.category_id,categories.category_title,groups.subcategory_id,groups.subcategory2_id,groups.subcategory3_id,groups.subcategory4_id,groups.subcategory5_id,groups.group_image,groups.cost_range,DATE_FORMAT(groups.end_date,"%e %M %Y") as end_date, subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,  DATE_FORMAT(groups.start_date,"%e %M %Y") as start_date,groups.members_count,groups.description,groups.created_by')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  //->join('user_groups','user_groups.user_id = groups.createdby_userid','left')
                  // ->join('users','users.user_id = groups.createdby_userid')
                  ->where('groups.group_id', $id)
                  // ->where('groups.status','active')
                  // ->where('groups.is_approved',1)
                  ->order_by('groups.group_id', 'desc')
                  ->get('groups')
                  ->result();
      }

      /*********** get group member's details by using group_id **********/
      public function get_group_members($id)
      {
            return $this->db->select('users.user_id,users.profile_image,users.name,users.location')
                  ->join('user_groups', 'user_groups.group_id = groups.group_id')
                  ->join('users', 'users.user_id = user_groups.user_id')
                  ->where('groups.group_id', $id)
                  ->where('groups.status', 'approved')
                  ->where('groups.is_approved', 1)
                  ->where('user_groups.join_status', 1)
                  ->get('groups')
                  ->result();
      }

      /********** get all advertisements according to category_id **************/
      public function get_advertisement_details_by_id($category_id, $advertisement_id)
      {


            return $this->db->select('advertisements.advertisement_id,advertisements_images.image_path,advertisements_images.image_id')
                  ->join('advertisements_images', 'advertisements_images.advertisement_id = advertisements.advertisement_id')
                  ->where('advertisements.category_id', $category_id)
                  ->where('advertisements.advertisement_id', $advertisement_id)
                  ->where('advertisements.status', 'approved')
                  ->where('advertisements.is_approved', 1)
                  ->order_by('advertisements.advertisement_id', 'desc')
                  ->get('advertisements')
                  ->result();
      }
      /******** get All Advertisemnent details using the category id *********/
      public function get_advertisement_details($category_id)
      {

            $this->load->helper('date');

            $currentdate = date("Y-m-d");
            return $this->db->select()
                  ->where('category_id', $category_id)
                  ->where('status', 'approved')
                  ->where('start_date <=', $currentdate)
                  ->where('end_date >= ', $currentdate)


                  ->get('advertisements')
                  ->result();
      }

      public function get_advertisement_forgroup($group_id)
      {

            $this->load->helper('date');

            $currentdate = date("Y-m-d");

            return $this->db->select('advertisements.advertisement_id,advertisements.advertisement_name,advertisements.end_date,advertisements.actual_price,advertisements.offer_price,users.name,users.lastName')
                  ->from('advertisements')
                  ->join('users', 'advertisements.created_by = users.user_id')
                  ->where('group_id', $category_id)
                  ->where('status', 'approved')
                  ->where('start_date <=', $currentdate)
                  ->where('end_date >= ', $currentdate)
                  ->get()
                  ->result();

            //return count($query);
      }


      /********* insert group_id and advertisement id in group advertisement table ******/
      public function insert_groups($advertisement_id, $id, $user_id)
      {

            $check_previous_deatils = $this->db->where('advertisement_id', $advertisement_id)->where('group_id', $id)->get('group_advertisements')->result();

            if (!$check_previous_deatils) {
                  $data = array(
                        'advertisement_id' => $advertisement_id,
                        'group_id' => $id,
                        'created_by' => $user_id
                  );

                  return $this->db->insert('group_advertisements', $data);
            }
            return true;
      }

      /*********** insert the user_id and group id and mark as join in user_group table ************/
      public function join_group($user_id, $group_id)
      {
            $check_pre_details = $this->db->where('group_id', $group_id)->where('user_id', $user_id)->get('user_groups')->row();

            if (!$check_pre_details) {
                  $data = array(
                        'user_id' => $user_id,
                        'group_id' => $group_id,
                        'created_by' => $user_id,
                        'join_status' => 1
                  );

                  return $this->db->insert('user_groups', $data);
            } else {
                  return $this->db->where('group_id', $group_id)->where('user_id', $user_id)->update('user_groups', array('join_status' => 1));
            }
      }

      public function exit_group($user_id, $group_id)
      {
            //$check_pre_details = $this->db->where('group_id',$group_id)->where('user_id',$user_id)->get('user_groups')->row();

            $this->db->where('group_id', $group_id)->where('user_id', $user_id)->update('user_groups', array('join_status' => 0));

            $query =  $this->db->where('group_id', $group_id)
                  ->where('join_status', '1')
                  ->get('user_groups')
                  ->result();
            $count = count($query);


            return $this->update_join_count($group_id, $count);

            // }else{
            //   return $this->db->where('group_id',$group_id)->where('user_id',$user_id)->update('user_groups',array('join_status'=> 1));
            // }
      }


      public function getJoinMember($id)
      {
            $query = $this->db->select('user_id')
                  ->where('group_id', $id)
                  ->where('join_status', 1)
                  // ->where('is_approved',1)
                  ->get('user_groups')
                  ->result();
            return count($query);
      }

      //  public function joinStatus($id,$groupID){
      //      $query = $this->db->select('join_status')
      //                     ->where('user_id',$id)
      //                      ->where('group_id',$groupID)
      //                     // ->where('is_approved',1)
      //                     ->get('user_groups')
      //                     ->row('join_status');
      //                      return $query;

      // }





      /************* get group details by group id **************/
      public function get_group_details_by_id($id)
      {
            return $this->db->select('group_id,group_name, check_join_count,category_id,members_count,createdby_userid')
                  ->where('group_id', $id)
                  ->where('status', 'approved')
                  ->where('is_approved', 1)
                  ->get('groups')
                  ->row();
      }

      /******** check user's group join details ***********/
      public function check_user_details($user_id, $group_id)
      {
            return $this->db->select('*')
                  ->join('users', 'users.user_id = user_groups.user_id', 'left')
                  ->where('user_groups.user_id', $user_id)
                  ->where('user_groups.group_id', $group_id)
                  ->get('user_groups')
                  ->row();
      }

      public function getUserName($user_id)
      {
            return $this->db->select('name')

                  ->get('users')
                  ->row('name');
      }

      /*********** get All group memeber's count **********/
      public function get_user_count($group_id)
      {
            $query =  $this->db->where('group_id', $group_id)
                  ->where('join_status', '1')
                  ->get('user_groups')
                  ->result();
            return count($query);
      }

      /********* update group join count in group's table ***************/
      public function update_join_count($group_id, $details)
      {
            return $this->db->where('group_id', $group_id)
                  ->update('groups', array('check_join_count' => $details));
      }

      /************ get user's joined group details from users table and user_group's table ***********/
      public function get_joined_group_details($user_id)
      {
            return  $this->db->select('groups.group_id,groups.channelkey,groups.group_name,groups.group_image,categories.category_id,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.cost_range,groups.members_count,date_format(groups.start_date,"%e %M %Y") as start_date,date_format(groups.end_date,"%e %M %Y") as end_date,groups.description,groups.status,user_groups.join_status')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  ->join('user_groups', 'user_groups.group_id = groups.group_id')
                  ->where('user_groups.user_id', $user_id)
                  ->where('user_groups.join_status', 1)
                  ->where('groups.status', 'approved')
                  ->where('groups.is_approved', 1)
                  ->where('groups.created_by != ', $user_id)
                  ->order_by('groups.status', 'asc')
                  ->get('groups')
                  ->result();
      }

      /*************** get particular member details by member_id and group id **************/
      public function get_member_detail_by_id($member_id)
      {
            return $this->db->select('users.name,users.location,users.email,users.contact_number,users.profile_image')
                  ->join('users', 'users.user_id = user_groups.user_id')
                  ->where('user_groups.user_id', $member_id)
                  ->get('user_groups')
                  ->result();
      }

      /*********** check group joined status by user_id and group_id ************/
      public function check_join_status($group_id, $user_id)
      {
            return $this->db->select()
                  ->where('user_groups.group_id', $group_id)
                  ->where('user_groups.user_id', $user_id)
                  ->get('user_groups')
                  ->row();
      }

      /*********** check member is exit or not *********/
      public function check_member_by_id($member_id)
      {
            return $this->db->where('user_id', $member_id)->get('user_groups')->row();
      }

      /************ insert advertisements view's details in views table ***********/
      public function insert_view_details($user_id, $id)
      {
            $check_details = $this->db->where('user_id', $user_id)->where('advertisement_id', $id)->get('views')->row();

            if (!$check_details) {
                  $data = array(
                        'advertisement_id' => $id,
                        'user_id' => $user_id,
                        'created_by' => $user_id
                  );

                  return $this->db->insert('views', $data);
            }
            return true;
      }

      /******* get all view's user count from views table **********/
      public function get_view_user_count($id)
      {
            $query =  $this->db
                  ->from('views')
                  ->where('advertisement_id', $id)
                  ->get()
                  ->result();
            return count($query);
      }

      /********* insert total view_count in advertisement statics table ********/
      public function insert_total_view_count($getviewcount, $id, $user_id, $groupcount)
      {
            $check_details = $this->db->where('advertisement_id', $id)->get('advertisement_statics')->result();

            if (!$check_details) {
                  $data = array(
                        'advertisement_id' => $id,
                        'views_count' =>  $getviewcount,
                        'group_count' =>  $groupcount,
                        'created_by' => $user_id
                  );
                  $query =  $this->db->insert('advertisement_statics', $data);
            } else {
                  foreach ($check_details as $row) {
                        $data = array(
                              'advertisement_id' => $id,
                              'views_count' => '' ? $row->views_count : $getviewcount,
                              'group_count' => '' ? $row->group_count : $groupcount,
                              'created_by' => $user_id
                        );
                        $query =  $this->db->where('advertisement_id', $id)->update('advertisement_statics', $data);
                  }
            }

            return $query;
      }

      /*********** Get all view adevertisements user's details ************/
      public function get_view_user_details($id)
      {
            $result = $this->db->select('users.name,users.location,users.profile_image,categories.category_title')
                  ->join('users', 'users.user_id = views.user_id')
                  ->join('advertisements', 'advertisements.advertisement_id = views.advertisement_id')
                  ->join('categories', 'categories.category_id = advertisements.category_id')
                  ->where('views.advertisement_id', $id)
                  ->get('views')
                  ->result();
            return $result;
      }

      /*********** insert show advertisements details in a group_advertisement table ************/
      public function insert_group_by_adv_id($adv_id, $group_id, $user_id)
      {
            $check_pre_details = $this->db->where('advertisement_id', $adv_id)->where('group_id', $group_id)->get('group_advertisements')->row();

            if (!$check_pre_details) {
                  $data = array(
                        'advertisement_id' => $adv_id,
                        'group_id' => $group_id,
                        'created_by' => $user_id
                  );

                  return $this->db->insert('group_advertisements', $data);
            }

            return true;
      }

      /********** mark group as favourite ************/
      public function mark_favourite_group($group_id, $user_id, $status)
      {
            $check_pre_details = $this->db->where('group_id', $group_id)->where('user_id', $user_id)->get('user_groups')->row();

            if (!$check_pre_details) {
                  $data = array(
                        'user_id' => $user_id,
                        'group_id' => $group_id,
                        'user_favourite' => $status,
                        'created_by' => $user_id
                  );

                  return $this->db->insert('user_groups', $data);
            } else {
                  return $this->db->where('group_id', $group_id)->where('user_id', $user_id)->update('user_groups', array('user_favourite' => $status));
            }
      }

      public function mark_favourite_Ads($advertisement_id, $user_id, $status)
      {
            $check_pre_details = $this->db->where('advertisement_id', $advertisement_id)->where('user_id', $user_id)->get('views')->row();

            if (!$check_pre_details) {
                  $data = array(
                        'user_id' => $user_id,
                        'advertisement_id' => $advertisement_id,
                        'Favorites_ads' => $status,
                        'created_by' => $user_id
                  );

                  return $this->db->insert('views', $data);
            } else {
                  return $this->db->where('advertisement_id', $advertisement_id)->where('user_id', $user_id)->update('views', array('Favorites_ads' => $status));
            }
      }

      /********** get user's favorite groups by user_favourite status and user_id **********/
      public function get_favourite_groups_by_user($user_id)
      {
            return $this->db->select('groups.group_id,groups.group_name,groups.location,groups.created_by,groups.channelkey,users.profile_image,users.name,users.location,categories.category_id,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,groups.rating,groups.group_image,groups.cost_range,date_format(groups.end_date,"%e %M %Y") as end_date,date_format(groups.start_date,"%e %M %Y") as start_date,groups.members_count,groups.description,user_groups.user_favourite')
                  ->join('categories', 'categories.category_id = groups.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = groups.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = groups.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = groups.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = groups.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = groups.subcategory5_id', 'left')
                  ->join('users', 'users.user_id = groups.createdby_userid', 'left')
                  ->join('user_groups', 'user_groups.group_id = groups.group_id', 'left')
                  ->where('user_groups.user_favourite', 1)
                  ->where('user_groups.user_id', $user_id)
                  ->where('groups.status', 'approved')
                  ->where('groups.is_approved', 1)
                  ->get('groups')
                  ->result();
      }


      /******** insert data into report_advertisemnt table *********/
      public function insert_report_advertisement($data)
      {

            $checkDetails = $this->db->where('advertisement_id', $data['reportTo'])->where('report_userid', $data['user_id'])->get('report_advertisements')->row();

            if (!$checkDetails) {
                  $details = array(
                        'report_userid' => $data['user_id'],
                        'advertisement_id' => $data['reportTo'],
                        'comments' => $data['comments'],
                        'report_type' => $data['report_type'],
                        'created_by' => $data['user_id']
                  );

                  $this->db->insert('report_advertisements', $details);


                  if ($data['report_type'] == 'ads') {

                        $seller_id = $this->db->select('created_by')
                              ->where('advertisement_id', $data['reportTo'])
                              ->get('advertisements')
                              ->row();

                        $data1 = array(
                              'adver_id' => $data['reportTo'],
                              'seller_id' => $seller_id,
                              'status' => 'Report Abuse'
                        );
                        $query = $this->db->insert('notifications', $data1);
                  }


                  if ($data['report_type'] == 'group') {

                        $user_id = $this->db->select('created_by')
                              ->where('group_id', $data['reportTo'])
                              ->get('groups')
                              ->row();

                        $data1 = array(
                              'group_id' => $data['reportTo'],
                              'user_id' => $user_id,
                              'status' => 'Report Abuse'
                        );
                        $query = $this->db->insert('notifications', $data1);
                  }
            }
            return true;
      }


      /************* get advertisement count ************/
      public function get_advertisement_count($category_id)
      {
            $query =  $this->db->select()
                  // ->join('categories','categories.category_id = advertisements.category_id')
                  ->where('advertisements.category_id', $category_id)
                  ->where('advertisements.status', 'approved')
                  ->where('advertisements.is_approved', 1)
                  ->get('advertisements')
                  ->result();

            return count($query);
      }


      /******** get group images for category **********/
      public function get_group_images($category_id)
      {
            return $this->db->select('group_image as image_Path')->where('category_id', $category_id)->where('groups.status', 'approved')->where('groups.is_approved', 1)->get('groups')->row('image_Path');
      }


      /********* get advertisement count by advertisement id *************/
      public function advertisement_count($id)
      {
            $query =  $this->db->where('advertisement_id', $id)->get('group_advertisements')->result();
            return count($query);
      }

      /************ insert total group_view_coutn in advertisement_statis **************/
      public function insert_total_group_view_count($groupcount, $advertisement_id, $user_id)
      {
            $check_details = $this->db->where('advertisement_id', $advertisement_id)->get('advertisement_statics')->row();

            if (!$check_details) {
                  $data = array(
                        'advertisement_id' => $advertisement_id,
                        'group_count' => $groupcount,
                        'created_by' => $user_id
                  );
                  return $this->db->insert('advertisement_statics', $data);
            } else {
                  $data = array(
                        'advertisement_id' => $advertisement_id,
                        'group_count' => $groupcount,
                        'created_by' => $user_id
                  );
                  return $this->db->where('advertisement_id', $advertisement_id)->update('advertisement_statics', $data);
            }
      }


      /************** get all the details about the users by user_id from users table *************/
      public function get_user_profile_details($user_id)
      {
            return $this->db->where('user_id', $user_id)->get('users')->row();
      }

      public function get_groupByUserID($user_id)
      {
            $result = $this->db->select('group_id')

                  ->where('user_id', $user_id)
                  ->where('join_status', 1)
                  ->get('user_groups')
                  ->result();
            return $result;
      }

      public function get_UserListByGroup($groupIds, $user_id)
      {
            $result = $this->db->select('users.user_id,users.name,users.lastName,users.profile_image,users.location,users.email')
                  ->join('users', 'users.user_id = user_groups.user_id')
                  ->where_in('group_id', $groupIds)
                  ->where('join_status', 1)
                  ->where('user_type', 'User')
                  ->where('user_groups.user_id != ', $user_id)
                  ->group_by('users.user_id')
                  ->get('user_groups')
                  ->result();
            return $result;
      }





      public function getdeviceToken($user_id)
      {

            $this->db->select('device_token');
            $this->db->from('push_notification');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            return $query->result();
      }


      public function pushNotification($deviceToken, $body)
      {
            if (!defined('API_ACCESS_KEY')) define('API_ACCESS_KEY', 'AAAAgj2eksg:APA91bGCZ67vj4cxjo11251gg2PEchTZgLHWa3YAb4kCiCaI42qPy3YPZc5H29ED8-3LUm4Mv6aCGSWpB7VOb2d8FLA7f1wCMGzr43m4_ebQEG_OByAElJaDzEHcDVMzXs_BkJKT2PlVoBk01cqoIq1kT_e1mWabnQ');
            // $registrationIds = array('fb1jTTIW0vI:APA91bGoM67GJEPs7MgpHrrV6os6OEgbcZvuLb0jaYt1yWaP7r5_CdJzqOZ84t_lXkT6m3nHpN-GEbz4wFzR0kHe8VpSyMETQdlD0gffE8Ks812yY0QVaVIR7C1WRHDy9ytfrCn21PNR');
            // prep the bundle
            $msg = array(
                  'message'   => $body,
                  'title'     => "inside data title",
                  'subtitle'  => 'This is a subtitle. subtitle',
                  'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
                  'vibrate'   => 1,
                  'sound'     => 1,
                  'largeIcon' => 'large_icon',
                  'smallIcon' => 'small_icon'
            );


            $notification = array(

                  "body" => $body['description'],
                  "title" => $body['title'],
                  "icon" => "myicon",
                  "sound" => "http://52.37.22.174/industry_matic.wav"
            );
            $fields = array(
                  'registration_ids'  => $deviceToken,
                  'data'          =>  $body,

                  "notification" => $notification,
                  "priority" => "normal"

            );

            $headers = array(
                  'Authorization: key=' . API_ACCESS_KEY,
                  'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);

            log_message('debug', print_r($result, TRUE));


            curl_close($ch);
            //echo $result;
      }


      /************** coupon code functions starts *************/

      public function insert_coupon_code($data)
      {
            // print_r($data);die;
            $data['unique_id'] = $data['user_id'];

            $data['coupon_code'] = substr($this->generate_unique_coupon_code($data['unique_id']), -7);

            $check_coupon_code = $this->check_coupon_code_unique($data['coupon_code']);

            while ($check_coupon_code) {
                  $data['coupon_code'] = substr($this->generate_unique_coupon_code($data['unique_id']), -7);
                  $check_coupon_code = $this->check_coupon_code_unique($data['coupon_code']);
            }

            $coupon_details = array(
                  'advertisement_id' => $data['advertisement_id'],
                  'seller_id' => $data['seller_id'],
                  'buyer_id' => $data['user_id'],
                  'coupon_code' => $data['coupon_code'],
                  'quantity' => $data['quantity'],
                  'status'  => 'pending',
            );
            $query =  $this->db->insert('coupons', $coupon_details);
            return $data['coupon_code'];
      }




      // public function String2Hex($string){
      //       $hex='';
      //       for ($i=0; $i < strlen($string); $i++){
      //           $hex .= dechex(ord($string[$i]));
      //       }
      //       return $hex;
      //   }

      // public function generate_unique_coupon_code($string)
      // {
      //   $hex='';
      //     for ($i=0; $i < strlen($string); $i++){
      //           $hex .= dechex(ord($string[$i]));
      //     }

      //   return $this->String2Hex(base64_encode($hex));
      // }

      public function generate_unique_coupon_code($string)
      {
            return md5(uniqid($string, true));
      }


      public function generate_unique_reference_id($string)
      {
            $alpha_numeric_array = str_split('abcdefghijklmnopqrstuvwxyz'
                  . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                  . '0123456789!@#$%^&*()'); // and any other characters
            shuffle($alpha_numeric_array); // probably optional sin

            // echo "<pre>";
            // print_r($alpha_numeric_array);
            // echo "</pre>";die;
            $random_string = "";
            $random_string1 = "";
            foreach (array_rand($alpha_numeric_array, 3) as $k) $random_string .= $alpha_numeric_array[$k];
            foreach (array_rand($alpha_numeric_array, 3) as $k) $random_string1 .= $alpha_numeric_array[$k];

            return $random_string . md5(uniqid($string, true)) . $random_string;


            // return md5(uniqid($string, true));
      }

      public function check_coupon_code_unique($coupon_code)
      {
            return  $this->db->select('coupon_code')
                  ->from('coupons')
                  ->where('coupon_code', $coupon_code)
                  ->get()
                  ->result();
      }

      public function check_reference_id_unique($order_ref_id)
      {
            return  $this->db->select('order_ref_id')
                  ->from('coupons')
                  ->where('order_ref_id', $order_ref_id)
                  ->get()
                  ->result();
      }



      public function check_buyer_coupon_code($user_id, $advertisement_id)
      {
            return $this->db->select('coupon_code')
                  ->from('coupons')
                  ->where('buyer_id', $user_id)
                  ->where('advertisement_id', $advertisement_id)
                  ->get()
                  ->row('coupon_code');
      }

      public function is_status_pending($user_id, $advertisement_id, $coupon_code)
      {
            return $this->db->select('status')
                  ->from('coupons')
                  ->where('buyer_id', $user_id)
                  ->where('advertisement_id', $advertisement_id)
                  ->where('coupon_code', $coupon_code)
                  ->get()
                  ->row('status');
      }

      public function get_purchase_list($user_id, $page_index, $page_offset)
      {
            if ($page_offset) {
                  $this->db->limit($page_offset, $page_index);
            }

            $purchase_lists = $this->db->select('advertisements.advertisement_id, coupons.quantity,advertisements.quantity_per_user,advertisements.advertisement_name,advertisements.actual_price,advertisements.offer_price,advertisements.offerfortwo,advertisements.advertisement_details,advertisements.HistoryOfChange,advertisements.user_count,advertisements.min_user_count,advertisements.location,advertisements.start_date,advertisements.end_date,advertisements.status as AdvertisementStatus,categories.category_id,categories.category_title,subcategories.subcategory_id,subcategories.subcategory_title,subcategories2.subcategory_title2,subcategories3.subcategory_title3,subcategories4.subcategory_title4,subcategories5.subcategory_title5,coupons.coupon_id,coupons.seller_id,coupons.coupon_code,coupons.order_ref_id,coupons.sequence_of_order,coupons.created_at as CouponsCreatedAt,coupons.updated_at as CouponsUpdatedAt,coupons.order_ref_id,coupons.advertisement_id,coupons.status as CouponsStatus,order_placed_date,purchased_date,users.name,users.lastName,users.email,users.contact_number,users.address,users.location,users.profile_image')
                  ->join('advertisements', 'advertisements.advertisement_id = coupons.advertisement_id')
                  ->join('categories', 'categories.category_id = advertisements.category_id', 'left')
                  ->join('subcategories', 'subcategories.subcategory_id = advertisements.subcategory_id', 'left')
                  ->join('subcategories2', 'subcategories2.subcategory2_id = advertisements.subcategory2_id', 'left')
                  ->join('subcategories3', 'subcategories3.subcategory3_id = advertisements.subcategory3_id', 'left')
                  ->join('subcategories4', 'subcategories4.subcategory4_id = advertisements.subcategory4_id', 'left')
                  ->join('subcategories5', 'subcategories5.subcategory5_id = advertisements.subcategory5_id', 'left')
                  ->join('users', 'users.user_id = coupons.seller_id')
                  ->from('coupons')
                  ->where('buyer_id', $user_id)
                  ->get()
                  ->result();

            foreach ($purchase_lists as $purchase_list) {
                  $purchase_list->AdvertisementImages = $this->db->select('advertisements_images.*')

                        ->from('advertisements_images')
                        ->where('advertisement_id', $purchase_list->advertisement_id)
                        ->get()
                        ->result();
            }

            return $purchase_lists;
      }








      public function update_coupon_status($user_id, $advertisement_id, $coupon_code, $address, $location, $quantity)
      {
            if ($this->is_status_pending($user_id, $advertisement_id, $coupon_code) == 'pending') {
                  $data['reference_id'] = substr($this->generate_unique_reference_id($user_id), -12);
                  $check_reference_id = $this->check_reference_id_unique($data['reference_id']);

                  while ($check_reference_id) {

                        $data['reference_id'] = substr($this->generate_unique_reference_id($user_id), -12);
                        $check_reference_id = $this->check_reference_id_unique($data['reference_id']);
                  }


                  $coupon_details = array(

                        'order_ref_id' => $data['reference_id'],
                        'status' => 'orderPlaced',
                        'order_placed_date' => $this->convertToTz('Y-m-d H:i:s', date('Y-m-d H:i:s'), 'asia/calcutta', date_default_timezone_get()),
                        'location' => $location,
                        'address' => $address,
                        'quantity' => $quantity
                        //'sequence_of_order'=>$this->get_sequence_number($advertisement_id)

                  );
                  $query =  $this->db->where('buyer_id', $user_id)
                        ->where('advertisement_id', $advertisement_id)
                        ->where('coupon_code', $coupon_code)
                        ->update('coupons', $coupon_details);
                  if ($query) {
                        log_message('debug', print_r($coupon_details, TRUE));

                        return $coupon_details;
                  }

                  return false;
            } else {
                  return false;
            }
      }

      function convertToTz($format, $time = "", $toTz = '', $fromTz = '')
      {    // timezone by php friendly values
            $date = new DateTime($time, new DateTimeZone($fromTz));
            $date->setTimezone(new DateTimeZone($toTz));
            $time = $date->format($format);
            return $time;
      }

      /************** coupon code functions ends *************/

      /****************Liked code******************************/

      public function getLikedCount($advertisement_id)
      {
            $query = $this->db->select('advertisement_id,')
                  ->from('advertisement_liked')
                  ->where('isLiked', 1)
                  ->where('advertisement_id', $advertisement_id)
                  ->get()
                  ->result();

            return count($query);
      }

      public function isLiked($advertisement_id, $user_id)
      {
            return $this->db->select('isLiked,')
                  ->from('advertisement_liked')
                  ->where('advertisement_id', $advertisement_id)
                  ->where('buyer_id', $user_id)
                  ->get()
                  ->row('isLiked');
      }


      public function insert_like($advertisement_id, $user_id, $status)
      {

            $isexist = $this->isLiked($advertisement_id, $user_id);

            if ($isexist == null) {

                  $data = array(
                        'advertisement_id' => $advertisement_id,
                        'buyer_id' => $user_id,
                        'isLiked' => $status
                  );

                  return $this->db->insert('advertisement_liked', $data);
            } else {
                  $data = array(
                        'isLiked' => $status
                  );

                  return $this->db->where('advertisement_id', $advertisement_id)
                        ->where('buyer_id', $user_id)
                        ->update('advertisement_liked', $data);
            }
      }



      /****************end***************************/

      public function getbanner()
      {
            return $this->db->select('*')
                  ->from('banner')
                  ->get()
                  ->result();
      }

      public function getmostlikedads()
      {
            return $this->db->select('advertisements.advertisement_id,advertisements.advertisement_name,advertisements.end_date,advertisements.actual_price,advertisements.offer_price,users.name,users.lastName')
                  ->from('advertisements')
                  ->join('advertisement_liked', 'advertisements.advertisement_id = advertisement_liked.advertisement_id')
                  ->join('users', 'advertisements.created_by = users.user_id')
                  ->where('isLiked', 1)
                  ->group_by('advertisement_liked.advertisement_id')
                  ->order_by('isLiked', 'desc')
                  ->get()
                  ->result();

            //return count($query);
      }


      public function isRated($seller_id, $user_id)
      {
            $countrating = $this->db->select('*')
                  ->from('rating')
                  ->where('seller_id', $seller_id)
                  ->where('buyer_id', $user_id)
                  ->get()
                  ->row();

            return count($countrating);
      }

      public function insert_rating($seller_id, $user_id, $rating)
      {

            $isexist = $this->isRated($seller_id, $user_id);

            if ($isexist == 0) {

                  $data = array(
                        'seller_id' => $seller_id,
                        'buyer_id' => $user_id,
                        'rating' => $rating
                  );

                  return $this->db->insert('rating', $data);
            } else {
                  $data = array(
                        'rating' => $rating
                  );

                  return $this->db->where('seller_id', $seller_id)
                        ->where('buyer_id', $user_id)
                        ->update('rating', $data);
            }
      }



      public function getRating($seller_id)
      {


            $query1 = $this->db->select('*')
                  ->from('rating')
                  ->where('seller_id', $seller_id)
                  ->get()
                  ->result();

            $count = count($query1);


            $query = $this->db->select('sum(rating) as allsum')
                  ->from('rating')
                  ->where('seller_id', $seller_id)
                  ->get()
                  ->row();



            return  $count == 0 ? '0' : $query->allsum / $count;
      }


      public function getselfRating($buyer_id, $seller_id)
      {
            return $this->db->select('rating')
                  ->from('rating')
                  ->where('seller_id', $seller_id)
                  ->where('buyer_id', $buyer_id)
                  ->get()
                  ->row('rating');
      }


      public function isratingoption($buyer_id, $advertisement_id)
      {
            $query = $this->db->select('*')
                  ->from('coupons')
                  ->where('advertisement_id', $advertisement_id)
                  ->where('buyer_id', $buyer_id)
                  ->where('status', 'purchased')
                  ->get()
                  ->result();

            return count($query);
      }
}
