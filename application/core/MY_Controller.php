<?php
class My_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
	
    public function LoadAdminView($view,$viewData=null){
		$viewData['side_cat']=$this->Dmodel->get_tbl("parents");
		
        $data=array(
            'view'=>$view,
            'viewData'=>$viewData
        );
        $this->load->view('admin/layout',$data);
    }
    
	public function LoadView($view,$viewData=null){
        $data=array(
            'view'=>$view,
            'viewData'=>$viewData
        );
        $this->load->view('layout',$data);
    }
	
	public static function slugify($text){
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	
    
}
?>