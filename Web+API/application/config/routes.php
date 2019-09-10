<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
/******* Define Routes of apis which are using same for seller/ user ****/
$route['login'] = 'api/login';
$route['register'] = 'api/register';
$route['verify_otp'] = 'api/verify_otp';
$route['profile'] = 'api/profile';
$route['editProfile'] = 'api/editProfile';
$route['getCategories'] = 'api/getCategories';
$route['getSubcategories'] = 'api/getSubcategories';
$route['getSubcategories2'] = 'api/getSubcategories2';
$route['getSubcategories3'] = 'api/getSubcategories3';
$route['getSubcategories4'] = 'api/getSubcategories4';
$route['getSubcategories5'] = 'api/getSubcategories5';
$route['changeSetting'] = 'api/changeSetting';
$route['changePassword'] = 'api/changePassword';
$route['getFilteredGroupDetails'] = 'api/getFilteredGroupDetails';
$route['getFilteredAdvertisements'] = 'api/getFilteredAdvertisements';
$route['forgotPassword'] = 'api/forgotPassword';
$route['editContact'] = 'api/editContact';
$route['getGroupByID'] = 'api/getGroupByID';

$route['getAdsByID'] = 'api/getAdsByID';


$route['updateotp'] = 'api/updateotp';
$route['UpdateGroupexpire'] = 'buyer/UpdateGroupexpire';
$route['notification'] = 'api/notification';
$route['readNotification'] = 'api/readNotification';
$route['send_mail']='api/send_mail';

$route['UpdateGroupexpire'] = 'buyer/UpdateGroupexpire';


/********** Routes for Buyer ********/
$route['createGroup'] = 'buyer/createGroup';
$route['getCreateGroups'] = 'buyer/getCreateGroups';
$route['getAllAdvertisements'] = 'buyer/getAllAdvertisements';
$route['getAdvertisement'] = 'buyer/getAdvertisement';

$route['getAllCategories'] = 'buyer/getAllCategories';
$route['getCategoryWisedGroups'] = 'buyer/getCategoryWisedGroups';
$route['getGroupDetails'] = 'buyer/getGroupDetails';
$route['joinGroup'] = 'buyer/joinGroup';
$route['getJoinedGroups'] = 'buyer/getJoinedGroups';
$route['groupMemberDetail'] = 'buyer/groupMemberDetail';
$route['getViewUsersDetails'] = 'buyer/getViewUsersDetails';
$route['MarkFavouriteGroup'] = 'buyer/MarkFavouriteGroup';
$route['getFavouriteGroups'] = 'buyer/getFavouriteGroups';
$route['report'] = 'buyer/report';
$route['exitGroup'] = 'buyer/exitGroup';
$route['updateChannelKey'] = 'buyer/updateChannelKey';

$route['getUserList'] = 'buyer/getUserList';
$route['editGroup'] = 'buyer/editGroup';
$route['getGroupsByID'] = 'buyer/getGroupsByID';

$route['MarkFavouriteAds'] = 'buyer/MarkFavouriteAds';
$route['getAllFavAdvertisements'] = 'buyer/getAllFavAdvertisements';

$route['generateCouponCode']='buyer/generateCouponCode';
$route['getPurchaseList']='buyer/getPurchaseList';
$route['purchaseAdvertisement']='buyer/purchaseAdvertisement';

$route['get_liked']='buyer/get_liked';

$route['insert_like']='buyer/insert_like';

$route['insert_rating']='buyer/insert_rating';



/******** Routes for Seller ***********/
$route['createAdvertisement'] = 'seller/createAdvertisement';
$route['getAllSellerAdvertisement'] = 'seller/getAllSellerAdvertisement';
$route['getSellerAdvertisement'] = 'seller/getSellerAdvertisement';
$route['editAdvertisement'] = 'seller/editAdvertisement';

$route['getFilteredsellerAdvertisements'] = 'seller/getFilteredsellerAdvertisements';

$route['getPendingUser'] = 'seller/getPendingUser';
$route['getPurchasedUser'] = 'seller/getPurchasedUser';

$route['validateOffer'] = 'seller/validateOffer';

$route['getSellerFeed'] = 'seller/getSellerFeed';
$route['toggleStatus'] = 'seller/toggleStatus';



///////////////////////////////////////////////////////////////////

$route['pushSeller'] = 'buyer/pushSeller';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
