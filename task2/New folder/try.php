<?php

function api_menu() {
    $items = array();
    $items['api/user/forgetpwd'] = array(
        'page callback' => 'api_forget_pwd',
        'access arguments' => array('access content'),
        'delivery callback' => 'drupal_json_output',
        'access callback' => true,
        'type' => MENU_CALLBACK,
   );
   
    $items['api/user/verifycode'] = array(
        'page callback' => 'api_verify_code',
        'access arguments' => array('access content'),
        'delivery callback' => 'drupal_json_output',
        'access callback' => true,
        'type' => MENU_CALLBACK,
    );
    $items['api/user/resetpwd'] = array(
        'page callback' => 'api_reset_pwd',
        'access arguments' => array('access content'),
        'delivery callback' => 'drupal_json_output',
        'access callback' => true,
        'type' => MENU_CALLBACK,
    );
    return $items;
}

function api_forget_pwd(){
    $output = array();
    $email = $_REQUEST['email'];
    if (empty($email)) {
        $output['errors'] = array('status' => 0, 'msg' => t('Empty Email'));
        drupal_add_http_header('status', 400);
    }
    if (!$output['email']) {
        $account = user_load_by_mail($email);
        if ($account) {
            $verification_code = planindo_change_user_verification_code($account->uid);
            /*
            $now_seconds = time();
            $valid_for = 86400 ;
            $expire = $now_seconds + $valid_for;
            */
            $user_data = user_load($uid);
            $name = $user_data->name;
            $emailsubject = variable_get('site_name') . ' | Forgot password ';
            $message = '<p>' . __('Hello') . ' ' . $name . ',' . __('please use the following verficaiton code to reset your password') .$verification_code.'</p>';
            $to = $user_data->email; 
            $from = "";  
            $params = array(
                'subject' => $emailsubject,
                'body' => $message,
            );
           $output['success'] = 1;
           $output['msg'] = 'A verification code has been sent to you, please check your email.';
           drupal_mail('api', 'forgetpwd', $to, language_default(), $params, $from);
        } else {
            $output['errors'] = array('status' => 0, 'msg' => t('Email is not correct or does not exist.'));
            drupal_add_http_header('status', 400);
        }
    }

    return $output;
}

function api_verify_code() {
    $output = array();
    //$errors = array();
    //$inputs = json_decode(file_get_contents('php://input'), true);
    $verification_code = $_REQUEST['verification_code'];

    if (empty($verification_code)) {
        $output['verification_code'] = array('status' => 0, 'msg' => t('No code provided.'));
    }else{
        //if (!$output['verification_code']) {
         
          $result = db_select('users', 'u')
          ->fields('u')
          ->condition('verification_code', $verification_code )
          ->execute()
          ->fetchObject();

         //  echo '<pre/>';
         //  print_r($result); exit;
           if($result){
              $output['verification_code'] = array('status' => 1, 'msg' => t('True.'));
           }else{
              $output['verification_code'] = array('status' => 0, 'msg' => t('Invalid Verification code.'));
              drupal_add_http_header('status', 400);           }
        }
        return $output;
}
    



function api_reset_pwd() {

    $output = array();

    $verification_code = $_REQUEST['verification_code'];
    $new_password = $_REQUEST['new_password'];
   // $confirm_password = $_REQUEST['confirm_password'];

    if (empty($verification_code)) {
        $output['verification_code'] = array('status' => 0, 'msg' => t('No code provided.'));
    }
    if (empty($new_password)) {
        $output['new_password'] = array('status' => 0, 'msg' => t('No password provided.'));
    }
    /*if(empty($confirm_password)) {
        $output['confirm_password'] = array('status' => 0, 'msg' => t('Please confirm your new password.'));
    }*/
    if($new_password){

                 $result = db_select('users', 'u')
                 ->fields('u', array('uid', 'mail'))
                 ->condition('verification_code', $verification_code )
                 ->execute()
                 ->fetchObject();


                 if ($result) {
                    $result->pass = $new_pass;
                    user_save($result);
                 $output['new_password'] = array('status' => 1, 'msg' => t('Password updated successfully.'));

                 } else {
                 $output['new_password'] = array('status' => 0, 'msg' => t('No user with the provided verification code.'));
                 }

            } else{

            $output['new_password'] = array('status' => 0, 'msg' => t('Password was not updated.'));
            }
    }   
    return $output;
   