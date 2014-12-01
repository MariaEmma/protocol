<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Protfiles extends CI_Controller {

    
    public function __construct()
	{
		
                parent::__construct();
             //   include($_SERVER['DOCUMENT_ROOT']."/archadmin/include_partials/incNoitems.php");
                $this->load->library('form_validation');
               // $this->load->library('pagination');
                
	}

    public function input()
	{ 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incPaths.php");
       }
        
     public function output()
	{ 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incPaths.php");
        
       
        
       	}
        
        
     public function edit($id)
	{ 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incPaths.php");
        
        
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incHeader.php");
       
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incFooter.php"); 
	}
    
    
        /*
     public function delete($id)
	{ 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incPaths.php");
        
        
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incHeader.php");
        $this->load->view('gramfiles/gramsidebar');
        $this->load->view('gramfiles/startpage');
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include_partials/incFooter.php"); 
	}
       
         * 
         */
   
      
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */