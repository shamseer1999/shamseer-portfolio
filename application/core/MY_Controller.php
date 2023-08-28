<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
   public $adm_id;
   public $adm_session;
   public $adm_name;
   public $adm_tmpl_path;
   public $today;

   public $upl_path;
   public $usr_name;
   public $usr_id;
   public $usr_mail;

   public $per_page;
   public $store_access;
   public $policy_stat=array();
   public $claim_stat=array();
   public $trstatus_list=array();
   public $claim_type_list=array();
   public $cmp_list=array();

   public $roleArr=array();

   public $all_access = array();
   public $adm_store_list=array();



    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
      	// $this->load->model('M_login')	;
        // $login_session = $this->M_login->get_admin_login_session();


        
        // if(!empty($login_session)&&!empty($login_session['id'])):
        //     $this->adm_id = $login_session['id'];
        //     $this->adm_session = $login_session['session_value'];
        //     $this->adm_name = $login_session['user_name'];
        //     $this->adm_role = $login_session['user_role'];
        // endif;



        //   $this->all_access = array('1','2','3'); // Store access for listing policy-claim
        //   $this->tr_all_access = array('1','2'); // Transfer store all access roles

   

        //  if(isset($this->adm_role)){

        //           $this->pathaccess_array = $this->getAllAccess($this->adm_role);
				  


        //  }
       
        $this->today = date('Y-m-d');
  
        // $this->adm_tmpl_path = 'mngr/layout/template';

        $this->per_page     = 10;

        $this->form_validation->set_error_delimiters('<div class="form-error text-danger">', '</div>');


       
            //$this->has_access();
    

       // print_r($this->pathaccess_array);

    }


    // public function has_access($path='') {
    //   // echo "<pre>";print_r($this->pathaccess_array);die;
    //   $this->lang->load('messages');
    //   $url_access=1;
    //   if(isset($this->adm_id)&&$this->adm_id>0)
    //    {
    //     $session_compare = $this->M_session->cmpAdmSession($this->adm_id,$this->adm_session);
    //     // print_r($this->pathaccess_array);
    //       if($path!='' & !(in_array($path,$this->pathaccess_array))){

    //          $url_access=0;
    //          redirect(ADM_PREFIX);
    //        }
    //     //p($url_access);
    //     if($session_compare==true && $url_access==1){
    //         return true;
    //     }else{
    //         $error=$this->lang->line('text_login_session_expired');
    //         $this->M_notify->set_notification($error,'danger');
    //         redirect(ADM_PREFIX.'login');
    //     }
    //        return true;
    //     }
    //         redirect(ADM_PREFIX.'login');
    // }

  //   public function getAllAccess($role_id=1){
  //     $fields = TBL_PREFIX.'path.path';
  //     $this->db->select($fields);
  //     $this->db->from(TBL_PREFIX.'role_path');

  //     $this->db->join(TBL_PREFIX.'path',TBL_PREFIX.'path.id='.TBL_PREFIX.'role_path.path_id','left');
  //     $this->db->where(array(TBL_PREFIX.'role_path.role_id='=>$role_id));


  //     $query = $this->db->get();
  //     // p($this->db->last_query());
  //     $access_arr=array();
  //     $path_arr = $query->result_array();
  //     foreach ($path_arr as $key => $value) {
  //      $access_arr[]=$value['path'];
  //     }
  //     return $access_arr;

  //  }

  // public function linkAccess($path,$permission=0){

  //    $link_return = array();
  //    //foreach($link_arr as $key => $value) {
  //    if(in_array($path."/add",$this->pathaccess_array)){
  //      $link_return[] = 'add';
  //     }
  //     if(in_array($path."/edit",$this->pathaccess_array)){
  //      $link_return[] = 'edit';
  //     }
  //     if(in_array($path."/delete",$this->pathaccess_array)){
  //      $link_return[] = 'delete';
  //     }
  //        if(in_array($path."/view",$this->pathaccess_array)){
  //      $link_return[] = 'view';
  //     }
  //       if(in_array($path."/permission",$this->pathaccess_array)){
  //      $link_return[] = 'permission';
  //     }
  //      if($path=='customer' && in_array("policy/apply",$this->pathaccess_array)){
  //      $link_return[] = 'apply_policy';
  //     }
  //     if($path=='policy' && in_array("policy/approve",$this->pathaccess_array)){
  //      $link_return[] = 'approve_policy';
  //     }
  //      if($path=='claim' && in_array("claim/accept",$this->pathaccess_array)){
  //      $link_return[] = 'accept_claim';
  //     }
  //     if($path=='claim' && in_array("claim/close",$this->pathaccess_array)){
  //      $link_return[] = 'close_claim';
  //     }
  //      if($path=='admin' && in_array("admin/change_pass",$this->pathaccess_array)){
  //      $link_return[] = 'change_pass';
  //     }
  //    // if($permission==1  && in_array($path."/permission",$this->pathaccess_array)){
  //      if(in_array($path."/permission",$this->pathaccess_array)){
  //      $link_return[] = 'permission';

  //     }
  //   // }
  //    return $link_return;

  //  }

	
	//  public function imgUploadFn($image,$path,$name)
  //   {
  //       $img_ext = explode('.', $image);
  //       $img_upl_name = $name.get_rand_number().'.'.end($img_ext);

  //       $upl_path = $path; // Default upload directory defined in HRM_Controller
  //       $img_full_path =$upl_path.$img_upl_name;

  //       $mksubdir = $this->imagepath;
  //       if (!is_dir($mksubdir)) {
  //           mkdir($mksubdir);
  //       }

  //       $config['upload_path'] = $upl_path;
  //       $config['allowed_types'] = 'jpg|jpeg|png|gif';
  //       $config['file_name'] = $img_upl_name;


  //       //Load upload library and initialize configuration

  //       $this->load->library('upload',$config);
  //       $this->upload->initialize($config);
  //       if($this->upload->do_upload('image'))
  //       {
  //           return $img_upl_name;
  //       }
  //    $error = array('error' => $this->upload->display_errors());
  //   //p($error);
    
  //   //return "error";
    


  //   }

    // public function has_access()
    // {
    //     if($this->session->userdata('user_id') != "")
    //     {
    //         return true;
    //     }
    //     redirect(base_url('mngr/login'));
    // }

    

}