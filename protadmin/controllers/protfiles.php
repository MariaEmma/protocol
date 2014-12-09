<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Protfiles extends MY_Controller {

    
    public function __construct()
	{
		
                parent::__construct();
             //   include($_SERVER['DOCUMENT_ROOT']."/archadmin/include_partials/incNoitems.php");
                $this->load->library('form_validation');
               // $this->load->library('pagination');
                
	}

    public function input($id) { 
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/protaccess.php");
        $data['mtitle'] = 'Εισερχόμενα αρχεία';
        $bs = new User($id);
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
            redirect('backend/protocol/input/'.$data['user']->id);
        }
        $data['ontotita'] = $bs ;
        $data['eggrafes'] = $bs->getUserUnstoredFiles();

        $this->load->view('protfiles/sidebar',$data);
        $this->load->view('protfiles/input',$data); 
        
    }
        
     public function send($id,$fileid)
	{ 
       require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/protaccess.php");
            $data['mtitle'] = 'Εισερχόμενα αρχεία';
           // get user, file and the connection id
            $ds = new File($fileid);
            $bs = new User($id);
            //redirect if the file is not user's 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα αρχειοθέτησης αυτού του αρχείου!</div>');            
                redirect('backend/protocol/input/'.$data['user']->id);
             }
        
            $data['ontotita'] = $bs ;
            //get the category from the form and store it
            $this->form_validation->set_rules('usersid', 'Παραλήπτες', 'checkIfUserIdIsZero');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');

            if ($this->form_validation->run() == FALSE){         
            $this->load->view('protfiles/sidebar',$data);
            $this->load->view('protfiles/input',$data); 
             }else{
            $temp = new File($fileid);
            $temp->user_id = $bs->id;
            $temp->is_protocol = 1;
            $temp->protocol_date = date("Y-m-d H:i:s");
            $temp->sender_name = $bs->firstname.' '.$bs->lastname;
            $urids = $this->input->post('usersid');
            
            if (!empty($urids)){
                $temp->save(); 
                foreach ($urids as $oneid):
                    $receiver = new User($oneid);
                    $temp->save($receiver);
                endforeach;
            }
            if ($temp->save()){
                  
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                            redirect('backend/protocol/input/'.$data['user']->id);
                                  }
                    else {
                                  $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                                  redirect('/backend/protocol/input/'.$data['user']->id);
                                  }
             }
            $this->load->view('protfiles/sidebar',$data);
            $this->load->view('protfiles/input',$data);
        
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