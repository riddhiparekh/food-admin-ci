<?php
$route['404_override'] = 'PageController/error404';
$route['default_controller'] = 'HomeCtrl';
// Admin Routes
$route['/'] = 'HomeCtrl';

$route['login'] = 'LoginCtrl/login';
$route['logout'] = 'LoginCtrl/logout';

// Follow this controller for function names along with methods
$route['category']['get'] = 'CategoryCtrl';
$route['category/(:num)']['get'] = 'CategoryCtrl/show/$1';
$route['category/create']['get'] = 'CategoryCtrl/create';
$route['category/create']['post'] = 'CategoryCtrl/store';
$route['category/(:num)/update']['get'] = 'CategoryCtrl/edit/$1';
$route['category/(:num)/update']['post'] = 'CategoryCtrl/update/$1';
$route['category/list']['get'] = 'CategoryCtrl/get';
$route['category/(:num)/status']['post'] = 'CategoryCtrl/toggle/$1';
$route['category/(:num)/delete']['get'] = 'CategoryCtrl/remove/$1';

$route['product']['get'] = 'ProductCtrl';
$route['product/(:num)']['get'] = 'ProductCtrl/show/$1';
$route['product/create']['get'] = 'ProductCtrl/create';
$route['product/create']['post'] = 'ProductCtrl/store';
$route['product/(:num)/update']['get'] = 'ProductCtrl/edit/$1';
$route['product/(:num)/update']['post'] = 'ProductCtrl/update/$1';
$route['product/list']['get'] = 'ProductCtrl/get';
$route['product/(:num)/status']['post'] = 'ProductCtrl/toggle/$1';
$route['product/(:num)/delete']['get'] = 'ProductCtrl/remove/$1';

$route['coupon']['get'] = 'CouponCtrl';
$route['coupon/(:num)']['get'] = 'CouponCtrl/show/$1';
$route['coupon/create']['get'] = 'CouponCtrl/create';
$route['coupon/create']['post'] = 'CouponCtrl/store';
$route['coupon/(:num)/update']['get'] = 'CouponCtrl/edit/$1';
$route['coupon/(:num)/update']['post'] = 'CouponCtrl/update/$1';
$route['coupon/list']['get'] = 'CouponCtrl/get';
$route['coupon/(:num)/status']['post'] = 'CouponCtrl/toggle/$1';
$route['coupon/(:num)/delete']['get'] = 'CouponCtrl/remove/$1';

$route['delivery-boy']['get'] = 'DeliveryBoyCtrl';
$route['delivery-boy/(:num)']['get'] = 'DeliveryBoyCtrl/show/$1';
$route['delivery-boy/create']['get'] = 'DeliveryBoyCtrl/create';
$route['delivery-boy/create']['post'] = 'DeliveryBoyCtrl/store';
$route['delivery-boy/(:num)/update']['get'] = 'DeliveryBoyCtrl/edit/$1';
$route['delivery-boy/(:num)/update']['post'] = 'DeliveryBoyCtrl/update/$1';
$route['delivery-boy/list']['get'] = 'DeliveryBoyCtrl/get';
$route['delivery-boy/(:num)/delete']['get'] = 'DeliveryBoyCtrl/remove/$1';

$route['orders']['get'] = 'OrderCtrl/index';
$route['orders']['post'] = 'OrderCtrl/store';
$route['orders/assigned']['get'] = 'OrderCtrl/assigned';
$route['orders/ready-to-pick']['get'] = 'OrderCtrl/pickup';
$route['orders/in-transit']['get'] = 'OrderCtrl/shipped';
$route['orders/completed']['get'] = 'OrderCtrl/completed';
$route['orders/cancelled']['get'] = 'OrderCtrl/cancelled';

$route['content/(:any)'] = 'ContentCtrl/index/$1';

$route['website/about'] = 'WebsiteController/about';
$route['website/features'] = 'WebsiteController/features';
$route['website/benifits'] = 'WebsiteController/benifits';
$route['website/feedbacks'] = 'WebsiteController/feedbacks';
$route['website/screenshots'] = 'WebsiteController/screenshots';
$route['website/downloads'] = 'WebsiteController/downloads';
$route['website/contact'] = 'WebsiteController/contact';