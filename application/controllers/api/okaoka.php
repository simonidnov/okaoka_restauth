<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Simon Delamarre IDnovant
 * TODO les models ne sont pas créer, nous devons sortir les requetes du controler et les déporter dans les bon models quand on aura du temps.
 */
class Okaoka extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper('form');
        $this->load->database();
    }
    public function users_get()
    {
        /* GET USER INFOS */
        $users = $this->db->get('user')->result();
        $this->response(array("datas"=>$users), REST_Controller::HTTP_OK);
    }
    public function users_post()
    {
        $datas = $this->input->post();
        /* CREATE NEW USER */
        $datas['created'] = date("Y-m-d H:i:s");
        $datas['updated'] = date("Y-m-d H:i:s");
        $this->db->insert('user', $datas);
        $user_id = $this->db->insert_id();
        $this->response(['title'=>'POST SEND RESPONSE', 'user_id'=>$user_id], REST_Controller::HTTP_OK);
    }
    public function users_put()
    {
        $datas = $this->put();
        $user_id = $datas['user_id'];
        unset($datas['user_id']);
        $datas['updated'] = date("Y-m-d H:i:s");
        $this->db->where('id', $user_id);
        $this->db->update('user', $datas);
        /* UPDATE NEW USER */
        $this->response(['title'=>'PUT SEND RESPONSE'], REST_Controller::HTTP_OK);
    }
    public function users_delete()
    {
        /* DELETE USER */
        $this->response(['title'=>'DELETE SEND RESPONSE'], REST_Controller::HTTP_OK);
    }
    public function picture_get()
    {
        /* GET DRAWING PICTURE */
        $drawings = $this->db->get('pictures');
        $this->response(['datas'=>$drawings->result()], 200);
    }
    public function picture_post()
    {
        /* POST DRAWING PICTURE */
        $datas = $this->input->post();
        if (!is_dir('uploads/')) {
            mkdir('./uploads/', 0777, TRUE);
        }
        $decoded=base64_decode($datas['bitmap']);
        
        /* CHECK FOLDERS */
        $file_name = uniqid() . time();
        $base_folder = str_split($file_name);
        if (!is_dir('uploads/'.$base_folder[0])) {
            mkdir('./uploads/'.$base_folder[0], 0777, TRUE);
        }
        if (!is_dir('uploads/'.$base_folder[0].'/'.$base_folder[1])) {
            mkdir('./uploads/'.$base_folder[0].'/'.$base_folder[1], 0777, TRUE);
        }
        if (!is_dir('uploads/'.$base_folder[0].'/'.$base_folder[1].'/'.$base_folder[2])) {
            mkdir('./uploads/'.$base_folder[0].'/'.$base_folder[1].'/'.$base_folder[2], 0777, TRUE);
        }
        if (!is_dir('uploads/'.$base_folder[0].'/'.$base_folder[1].'/'.$base_folder[2].'/'.$base_folder[3])) {
            mkdir('./uploads/'.$base_folder[0].'/'.$base_folder[1].'/'.$base_folder[2].'/'.$base_folder[3], 0777, TRUE);
        }
        /* CHECK FOLDERS END */
        $folder = './uploads/'.$base_folder[0].'/'.$base_folder[1].'/'.$base_folder[2].'/'.$base_folder[3].'/';
        file_put_contents($folder.$file_name.'.png', $decoded);
        
        
        $this->db->insert('pictures', array("user_id"=>$datas['user_id'], "url"=>$file_name, "created"=>date("Y-m-d H:i:s"), "updated"=>date("Y-m-d H:i:s")));
        
        $this->response(['title'=>'PICTURE UPLOADED', 'picture_id'=>$this->db->insert_id()], REST_Controller::HTTP_OK);
    }
    public function stats_get()
    {
        $datas = $this->input->get();
        //if(!isset($datas['user_id']){
        //    $this->response(['title'=>'Admin', 'message'=>'Vous devez être authentifié pour accèder à ce webservice'], 403); 
        //}
        $this->load->helper('oauth');
        if(!is_admin($datas['user_id'])){
            $this->response(['title'=>'Admin', 'message'=>'votre compte n\'est pas validé, vous n\'avez pas accès à cette partie'], 403); 
        }else{
            /* GET STATS WITH PARAMS */
            $this->db->where('page_name !=', "null");
            $all_stats = $this->db->get('stats');
            $this->response(['title'=>'GET ALL STATS', 'datas'=>$all_stats->result()], REST_Controller::HTTP_OK);
        }
    }
    public function stats_post()
    {
        $datas = $this->input->post();
        if(!isset($datas['user_id']) or !isset($datas['datas'])){
            $this->response(['title'=>'POST STATS RESPONSE', 'message'=>'vous n\'avez pas rensigné les bonnes valeurs'], 400);
        }
        if(!is_array($datas['datas'])){
            $this->response(['title'=>'POST STATS RESPONSE', 'message'=>'vous n\'avez pas rensigné les bonnes valeurs'], 400);
        }
        $user_id = $datas['user_id'];
        foreach($datas['datas'] as $stats){
            $this->db->insert('stats', array('user_id'=>$user_id, 'page_name'=>$stats['page'], 'date'=>$stats['date']));
        }
        /* POST NEW STATS FROM USER BORNE OKAOKA */
        $this->response(['title'=>'POST STATS RESPONSE', 'datas'=>$datas], REST_Controller::HTTP_OK);
    }
    public function score_get()
    {
        /* GET STATS WITH PARAMS */
    }
    public function score_post()
    {
        $datas = $this->input->post();
        if(!isset($datas['user_id']) or !isset($datas['datas']) or !isset($datas['game_name'])){
            $this->response(['title'=>'POST STATS RESPONSE', 'message'=>'vous n\'avez pas rensigné les bonnes valeurs'], 400);
        }
        if(!is_array($datas['datas'])){
            $this->response(['title'=>'POST STATS RESPONSE', 'message'=>'les datas envoyées doivent etre de type array'], 400);
        }
        $user_id = $datas['user_id'];
        $game_name = $datas['game_name'];
        foreach($datas['datas'] as $score){
            $this->db->insert('scoring', array('user_id'=>$user_id, 'game_name'=>$game_name, 'score'=>$score['score']));
        }
        /* POST NEW STATS FROM USER BORNE OKAOKA */
        $this->response(['title'=>'POST SCORE RESPONSE'], REST_Controller::HTTP_OK);
    }
    public function admin_account_post(){
        $datas = $this->input->post();
        //$this->response(["datas"=>$datas], 200);
        //die();
        //if(!isset $datas['email'] or !isset $datas['password'] or !isset $datas['why']){
        //    $this->response(['title'=>'Erreur', 'message'=>'vous n\'avez pas précisé les informations requises'], 400);
        //}
        if($datas['why'] === ""){
            $this->response(['title'=>'Erreur', 'message'=>'Vous devez préciser les raisons pour lesquelles vous souhaitez obtenir un compte admin okaoka'], 400);
        }
        $this->load->helper('email');
        if (!valid_email($datas['email']))
        {
            $this->response(['title'=>'Erreur', 'message'=>'Votre email est invalide, merci de le vérifier'], 400);   
        }
        $this->db->where('email', $datas['email']);
        $is_admin = $this->db->get('admin');
        if(count($is_admin->result()) >= 1){
            $this->response(['title'=>'Erreur', 'message'=>'Votre email existe déjà, si vous avez perdu votre mot de passe, merci de demander un nouveau mot de passe, sinon connectez-vous.'], 400);
        }
        
        $this->load->helper('oauth');
        $insert = array(
            "email"=>$datas['email'],
            "password"  => sha1($datas['password']),
            "token"     => get_token(),
            "why"       => $datas['why'],
            "is_valid"  => 0,
            'created'   => date("Y-m-d H:i:s"),
            'updated'   => date("Y-m-d H:i:s"),
            "access"    => get_access(),
            "secret"    => get_secret(),
        );
        $this->db->insert('admin', $insert);
        
        $user_id = $this->db->insert_id();
        
        $this->db->where('id', $user_id);
        $user = $this->db->get('admin');
        //unset($user['password']);
        
        $this->response(array("title"=>"Account", "message"=>"Votre compte à bien été créé et est en attente de validation par nos administrateurs. Vous recevrez prochainement un email confirmant votre inscription. Merci et à boentôt.", "user_infos"=>$user), REST_Controller::HTTP_OK);
    }
    public function admin_login_get(){
        $datas = $this->input->get();
        if(!isset($datas['email']) or !isset($datas['password'])){
            $this->response(['title'=>'Erreur', 'message'=>'vous n\'avez pas précisé les informations requises', 'datas'=>$datas, 'isset mail'=>isset($datas['email'])], 400);
        }
        $this->load->helper('email');
        if (!valid_email($datas['email']))
        {
            $this->response(['title'=>'Erreur', 'message'=>'Votre email est invalide, merci de le vérifier'], 400);   
        }
        $this->db->where('email', $datas['email']);
        $this->db->where('password', sha1($datas['password']));
        $user = $this->db->get('admin');
        //$this->response(['user'=>$user->num_rows()], 200);
        if($user->num_rows() == 1){
            $user_infos = $user->result()[0];
            unset($user_infos->password);
            $this->response(array("title"=>"Account", "message"=>"Vous êtes à présent connecté sur okaoka.", "user_infos"=>$user_infos), REST_Controller::HTTP_OK);
        }else{
            if($user->num_rows() > 1){
                $this->response(array("title"=>"Account", "message"=>"Un problème est survenu avec votre compte, veuillez contacter un administrateur", "user_infos"=>$user), REST_Controller::HTTP_OK);
            }else{
                $this->db->where('email', $datas['email']);
                $user_test = $this->db->get('admin');
                if($user_test->num_rows() >= 1){
                    $this->response(array("title"=>"Account", "message"=>"Votre mot de passe semble incorrect, merci de le vérifier avant de réessayer.", "user_infos"=>$user), REST_Controller::HTTP_OK);
                }else{
                    $this->response(array("title"=>"Account", "message"=>"Aucun compte existant pour l'email ".$datas['email'], "user_infos"=>$user), REST_Controller::HTTP_OK);
                }
            }
        }
    }
    
    public function application_get(){
        $datas = $this->input->get();
        $apps = $this->db->get('application');
        $this->response(array("datas"=>$apps->result()), REST_Controller::HTTP_OK);
    }
    public function largezip_post(){
        $datas = $this->input->post();
        $this->load->library('ftp');
        $this->ftp->upload($datas['local_file_name'], '/uploads/release_versions/app.zip', 'ascii', 0775); 
        $this->response(array("title"=>"Realse Version", "message"=>"L'upload de votre fichier s'est bien passé, la version sera testée par un administrateur avant d'être validée ou rejeté."), REST_Controller::HTTP_OK);
    }
    public function application_post(){
        $datas = $this->input->post();
        $this->load->helper('oauth');
        if(!is_super_admin($datas['user_id'])){
            $this->response(['title'=>'Admin', 'message'=>'Vous devez être super admin pour effectuer cette action'], 403);
        }else{
            $user_id            = $datas['user_id'];
            $validator_id       = 1;
            $release_version    = $datas['release_version'];
            $whats_new          = $datas['whats_new'];
            $os                 = $datas['os'];
            $is_install         = $datas['is_install'];
            $datas_zip          = base64_decode($datas['datas_zip']);
            $created            = date("Y-m-d H:i:s");
            $updated            = date("Y-m-d H:i:s");
            
            
            $file_name = "okaoka_" . uniqid() . time();
            $base_folder = str_split($file_name);
            if (!is_dir('uploads/release_versions/')) {
                mkdir('./uploads/release_versions/', 0777, TRUE);
            }
            /* CHECK FOLDERS END */
            $folder = './uploads/release_versions/';
            file_put_contents($folder.$file_name.'.zip', $datas_zip);
            
            $post_datas = array(
                'user_id'       =>$user_id,
                'validator_id'  =>$validator_id,
                'release_version'=>$release_version,
                'whats_new'     =>$whats_new,
                'os'            =>$os,
                'is_install'    =>$is_install,
                'file_name'     =>$file_name,
                'created'       =>$created,
                'updated'       =>$updated
            );
            
            $this->db->insert('application', $post_datas);
            
            $this->response(array("title"=>"Realse Version", "message"=>"L'upload de votre fichier s'est bien passé, la version sera testée par un administrateur avant d'être validée ou rejeté."), REST_Controller::HTTP_OK);
        }
    }
    
    public function ideas_post(){
        $datas = $this->input->post();
        $this->load->helper('email');
        if (!valid_email($datas['email']))
        {
            $this->response(['title'=>'Erreur', 'message'=>'Votre email est invalide, merci de le vérifier'], 300);   
        }
        $post_datas = array(
            'email'     => $datas['email'],
            'type'      => $datas['type'],
            'title'     => $datas['title'],
            'message'   => $datas['message'],
            'created'   => date("Y-m-d H:i:s"),
            'updated'   => date("Y-m-d H:i:s"),
            'status'    => 0,
            'is_newsletter' => $datas['is_newsletter']
        );
        $this->db->insert('ideas', $post_datas);
        $this->response(array("title"=>"Ideas", "message"=>"Votre idée à bien été envoyée à l'équipe OkaOka, nous vous remercions de votre intêret et tâchons dans la mesure du possible :-) de revenir vers vous pour échanger sur ce sujet."), REST_Controller::HTTP_OK);
    }
    public function ideas_put(){
        $datas = $this->put();
        $this->load->helper('oauth');
        if(!is_admin($datas['user_id'])){
            $this->response(['title'=>'Admin', 'message'=>'votre compte n\'est pas validé, vous n\'avez pas accès à cette partie'], 403); 
        }else{
            $put_datas = array(
                'updated'   =>date("Y-m-d H:i:s"),
                'status'    =>$datas['status']
            );
            $this->db->where('id', $datas['id']);
            $this->db->update('ideas', $put_datas);
            $this->response(array("title"=>"Ideas", "message"=>"Le message à correctement était mis à jour."), REST_Controller::HTTP_OK);
        }
    }
    public function ideas_get(){
        $datas = $this->input->get();
        $this->load->helper('oauth');
        if(!is_admin($datas['user_id'])){
            $this->response(['title'=>'Admin', 'message'=>'votre compte n\'est pas validé, vous n\'avez pas accès à cette partie'], 403);
        }else{
            $ideas = $this->db->get('ideas');
            $this->response(array("datas"=>$ideas->result()), REST_Controller::HTTP_OK);
        }
    }
    public function ideas_delete(){
        $datas = $this->delete();
        $this->load->helper('oauth');
        if(!is_admin($datas['user_id'])){
            $this->response(['title'=>'Admin', 'message'=>'votre compte n\'est pas validé, vous n\'avez pas accès à cette partie'], 403); 
        }else{
            $this->db->where('id', $datas['id']);
            $this->db->delete('ideas');
            $this->response(array("title"=>"Ideas", "message"=>"le message a bien été supprimé"), REST_Controller::HTTP_OK);
        }
    }
    public function email_get(){
        $this->load->library('email');

        $this->email->from('sdelamarre@idnovant.fr', 'Simon Delamarre');
        $this->email->to('sdelamarre@idnovant.fr'); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');	

        $this->email->send();

        echo $this->email->print_debugger();
        //$this->response(array("title"=>"Email", "message"=>"Email sent"), REST_Controller::HTTP_OK);
    }
    public function checkinitialconfig_get(){
        $this->db->query('CREATE TABLE IF NOT EXISTS `pictures` (
  `id` bigint(20) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `dominante` text COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
        
        $this->db->query('CREATE TABLE IF NOT EXISTS `scoring` (
  `id` bigint(20) NOT NULL,
  `score` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci,
  `user_id` bigint(20) NOT NULL,
  `game_name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
        
        $this->db->query('CREATE TABLE IF NOT EXISTS `stats` (
  `id` bigint(20) NOT NULL,
  `user_id` text COLLATE utf8_unicode_ci NOT NULL,
  `page_name` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1620 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
        
        $this->db->query('CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `mac` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` text COLLATE utf8_unicode_ci NOT NULL,
  `hostname` text COLLATE utf8_unicode_ci NOT NULL,
  `architecture` text COLLATE utf8_unicode_ci NOT NULL,
  `total_memory` text COLLATE utf8_unicode_ci NOT NULL,
  `free_memory` text COLLATE utf8_unicode_ci NOT NULL,
  `processors` text COLLATE utf8_unicode_ci NOT NULL,
  `processor_model` text COLLATE utf8_unicode_ci NOT NULL,
  `processor_speed` text COLLATE utf8_unicode_ci NOT NULL,
  `release_version` text COLLATE utf8_unicode_ci NOT NULL,
  `uptime` text COLLATE utf8_unicode_ci NOT NULL,
  `platform` text COLLATE utf8_unicode_ci NOT NULL,
  `uid` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
        
        
        $this->response(array("message"=>"inital db config"), REST_Controller::HTTP_OK);
    }
}