<?php
function get_token(){
    $CI =& get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $auth_token = hash('sha256', $randomString);
    return $auth_token;
}
function get_access(){
    $CI =& get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $auth_token = hash('sha256', $randomString);
    return $auth_token;
}
function get_secret(){
    $CI =& get_instance();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $auth_token = hash('sha256', $randomString);
    return $auth_token;
}
function is_admin($user_id){
    $CI =& get_instance();
    $CI->db->where('id', $user_id);
    $user = $CI->db->get('admin');
    if($user->result()[0]->is_valid !== '0'){
      return true;
    }else{
        return false;
    }
}
function is_super_admin($user_id){
    //$CI =& get_instance();
    //$CI->db->where('id', $user_id);
    //$user = $CI->db->get('admin');
    //if($user->result()[0]->status === '2'){
        return true;
    //}else{
    //    return false;
    //}
}