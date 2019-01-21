<?php
/**
 * Stripe - Payment Gateway integration example (Stripe Checkout)
 * ==============================================================================
 * 
 * @version v1.0: stripe_pay_checkout_demo.php 2016/10/05
 * @copyright Copyright (c) 2016, http://www.ilovephp.net
 * @author Sagar Deshmukh <sagarsdeshmukh91@gmail.com>
 * You are free to use, distribute, and modify this software
 * ==============================================================================
 *
 */
require_once('../environment.php');
$db_username = DB_USER;
$db_password = DB_PASSWORD;
$db_name = DB_NAME;
$db_host = DB_HOST;
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);

// Stripe library
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_GQLOOALiD4n6eRlqUyquutgI');

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$amount = $_POST['pckg_amount'] * 100;
$items_name = $_POST['items_name'];
$items_coupon = $_POST['items_coupon'];
$pass = rand();

try {

   \Stripe\Charge::create(array(
    'currency' => 'USD',
    'amount'   => round($amount),
    'card'     => $token
  ));

  $user_check =  mysqli_num_rows(mysqli_query($connection,"SELECT * FROM `users` where `email` = '" . $email . "'"));
    if($user_check > 0){
    $user_details =  mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM `users` where `email` = '" . $email . "'"));
    $order_details =  mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM `orders` ORDER BY id DESC LIMIT 1"));
    $userId = $user_details['id'];
    $orderId = '90DAYS00'.($order_details['id'] + 1);
    $order_insert = mysqli_query($connection,"INSERT INTO `orders` SET 
                                  `order_code` = '" . $orderId . "',
                                  `course_name` = '" . $items_name . "',
                                  `user_id` = '" . $userId . "',
                                  `total_amount` = '" . $_POST['pckg_amount'] . "',
                                  `discount_code` = '" . $items_coupon . "',
                                  `paid_amount` = '" . $_POST['pckg_amount'] . "',
                                  `payment_gateway` = '2',
                                  `transaction_id` = '" . $token . "',
                                  `transaction_status` = '1',
                                  `status` = '1'");
    $message =  "Hello ,<br><br>Thanks for the ordering.<br><br>Thanks & Regards<br><br>90DAYS";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: 90DAYS<info@90days.com>' . "\r\n";
                $to = $email;
                $subject = "Thanks Ordering";
                $mail = mail($to,$subject,$message,$headers);
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/thankyou');
    }else{
    $new_user = mysqli_query($connection,"INSERT INTO `users` SET 
                                  `user_name` = '" . $email . "',
                                  `password` = '" . MD5($pass) . "',
                                  `email` = '" . $email . "',
                                  `status` = '1'");
    $userId = $connection->insert_id;
    $order_details =  mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM `orders` ORDER BY id DESC LIMIT 1"));
    $orderId = '90DAYS00'.($order_details['id'] + 1);
    $order_insert = mysqli_query($connection,"INSERT INTO `orders` SET 
                                  `order_code` = '" . $orderId . "',
                                  `course_name` = '" . $items_name . "',
                                  `user_id` = '" . $userId . "',
                                  `total_amount` = '" . $_POST['pckg_amount'] . "',
                                  `discount_code` = '" . $items_coupon . "',
                                  `paid_amount` = '" . $_POST['pckg_amount'] . "',
                                  `payment_gateway` = '2',
                                  `transaction_id` = '" . $token . "',
                                  `transaction_status` = '1',
                                  `status` = '1'");
    $message1 =  "Hello ,<br><br>Please login with below credentials.<br><br>User :".$email."<br><br>Pass :".$pass."<br><br>Thanks & Regards<br><br>90DAYS";
                $headers1 = "MIME-Version: 1.0" . "\r\n";
                $headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers1 .= 'From: 90DAYS<info@90days.com>' . "\r\n";
                $to1 = $email;
                $subject1 = "User Signup";
                $mail1 = mail($to1,$subject1,$message1,$headers1);

    $message =  "Hello ,<br><br>Thanks for the ordering.<br><br>Thanks & Regards<br><br>90DAYS";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: 90DAYS<info@90days.com>' . "\r\n";
                $to = $email;
                $subject = "Thanks Ordering";
                $mail = mail($to,$subject,$message,$headers);            
    header('Location: https://'.$_SERVER['HTTP_HOST'].'/thankyou');
    }

} catch(\Stripe\Error\Card $e) {
  // The card can't be charged for some reason
  printError($e);
} catch (\Stripe\Error\RateLimit $e) {
  // Too many requests made to the API too quickly
  printError($e);
} catch (\Stripe\Error\InvalidRequest $e) {
  // Invalid parameters were supplied to Stripe's API
  printError($e);
} catch (\Stripe\Error\Authentication $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
  printError($e);
} catch (\Stripe\Error\ApiConnection $e) {
  // Network communication with Stripe failed
  printError($e);
} catch (\Stripe\Error\Base $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email
  printError($e);
} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe
  printError($e);
}

// Helper function to display errors back in the html page
function printError($error) {
  $body = $error->getJsonBody();
  $err  = $body['error'];

  print('An error happened in the server side script<br>');
  print('Status is: ' . $error->getHttpStatus() . '<br>');
  print('Type is: ' . $err['type'] . '<br>');
  print('Code is: ' . $err['code'] . '<br>');
  print('Param is: ' . $err['param'] . '<br>');
  print('Message is: ' . $err['message'] . '<br>');
}
?>