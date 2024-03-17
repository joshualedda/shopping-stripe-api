<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$config['stripe_api_key']         = 'sk_test_51Ov8YdP4esyi7AIvH5E2wD8bsIzu8WLSr1NOcS1UBwnohK1m56IUvrKdYTK1kalagQ3z25piVhGJh5CoRHT1seZ600VgFTHnBE'; 
$config['stripe_publishable_key'] = 'pk_test_51Ov8YdP4esyi7AIv9Z87tGQCjfakQxoIQobtplCIn4ggiF9WWIZTdb1duNce8ulHCM07hJiFvrogYhLMFs6onEC300HVAPHm5G'; 
$config['stripe_currency']        = 'usd';
