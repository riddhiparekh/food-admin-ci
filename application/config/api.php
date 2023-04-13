<?php
$route['404_override'] = 'PageController/error404';
$route['default_controller'] = 'api/HomeController';
// API Routes
$route['/'] = 'api/HomeController';

// Login & Registration Routes
$route['login']['post'] = 'api/LoginController';
$route['logout']['get'] = 'api/LoginController/logout';
$route['register']['post'] = 'api/RegisterController';
$route['register/otp']['post'] = 'api/RegisterController/otp';
$route['register/verify']['post'] = 'api/RegisterController/verify';

// Category Routes
$route['categories/(:num)']['get'] = 'api/CategoryController/index/$1';

// Product Routes
$route['product/(:num)']['get'] = 'api/ProductController/index/$1';

// Wishlist
$route['wishlist']['get'] = 'api/WishlistController/index';
$route['wishlist']['post'] = 'api/WishlistController/store';

// Cart related Routes
$route['cart']['get'] = 'api/CartController/index';
$route['cart']['post'] = 'api/CartController/store';
$route['cart/(:num)/delete']['get'] = 'api/CartController/destroy/$1';
$route['cart/(:num)']['post'] = 'api/CartController/update/$1';

// Address related Routes
$route['address']['get'] = 'api/AddressController/index';
$route['address/(:num)']['get'] = 'api/AddressController/show/$1';
$route['address']['post'] = 'api/AddressController/store';
$route['address/(:num)']['post'] = 'api/AddressController/update/$1';
$route['address/(:num)/delete']['get'] = 'api/AddressController/destroy/$1';

// Coupon related Routes
$route['coupon']['get'] = 'api/CouponController/index';
$route['coupon/(:num)']['post'] = 'api/CouponController/store/$1';
$route['coupon/delete']['get'] = 'api/CouponController/destroy';

// Order related routes
$route['orders']['get'] = 'api/OrderController/index';
$route['orders/(:num)']['get'] = 'api/OrderController/show/$1';
$route['orders']['post'] = 'api/OrderController/store';