<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login
$route['login'] = 'users';
//register
$route['register'] = 'users/register';
//logout
$route['logout'] = 'users/logout';


//products list
$route['default_controller'] = 'products';
//product view
$route['product/details/(:any)'] = 'Products/details/$1';


//add to cart
$route['addtocart'] = 'carts/addToCart';

//cart
$route['carts'] = 'carts';




//remove cart
$route['removeCartItem/(:any)'] = 'Carts/removeCartItem/$1';

//checkout stripe
$route['checkOutStripe']= 'Carts/checkOutStripe';

//afrer sucess 
$route['main/stripeSuccess']= 'Carts/stripeSuccess';



//admin dashboard
$route['dashboard/admin']= 'dashboards';
