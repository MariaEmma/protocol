<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gramfiles extends MY_Controller {

    
    public function __construct()
	{		
                parent::__construct();  
	}

    public function input($id)
	{ 
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/gramaccess.php");
        $data['mtitle'] = 'Ενέργειες Γραμματείας - Εισερχόμενα αρχεία';
        $bs = new User($id);
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
            redirect('backend/gram/input/'.$data['user']->id);
        }
        $data['ontotita'] = $bs ;
        $data['eggrafes'] = $bs->getUserUnstoredFiles();
        $this->load->view('gramfiles/sidebar',$data);
        $this->load->view('gramfiles/input',$data); 
	}
        
     public function upload($id)
	{    
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/gramaccess.php");
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα ανεβάσματος αρχείων για αυτό το χρήστη!</div>');            
            redirect('backend/gram/myown/'.$data['user']->id);
        }
        $data['mtitle'] = 'Ενέργειες Γραμματείας - Αποστολή αρχείου';
        $bs = new User($id); 
        $files = new File();
        $data['eggrafes'] = $files->getLastSentFilesOfUser($bs->id);
        $data['ontotita'] = $bs ;
        $school = new User($bs->school_id);
        $data['school'] = $school;
        $this->form_validation->set_rules('description', 'Περιγραφή','required|trim' );
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if($this->form_validation->run() == FALSE){         
            $this->load->view('gramfiles/sidebar',$data);
            $this->load->view('gramfiles/gramupload',$data);

         }else{
               $maxid = new File();
                $ar =$maxid->getMaxId()+1;
                $tempu = new File();
                $tempu->description = $this->input->post('description');      
                $tempu->user_id = $id;
                $tempu->created_date = date("Y-m-d H:i:s"); 
                $tempu->sender_name = $bs->firstname.' '.$bs->lastname;
                
         //start upload
                $config['upload_path'] = MY_FILEPATH;
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '';
                $config['encrypt_name']= FALSE;
                $config['file_name']	= $ar.'.pdf';
		$this->load->library('upload', $config);                
                
                if ( ! $this->upload->do_upload())
		{   
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης! <strong>Eπιλέξτε κάποιο αρχείο ή το αρχείο που επιλέγετε να είναι με κατάληξη .pdf!</strong></div>');
                    redirect('/backend/gram/upload/'.$id);
		}
		else
		{
                        $tempu->upload_file = $this->upload->file_name;
		}
                
                //end upload
      
                if($tempu->save()){ 
                        $tempu->save($school);
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                        redirect('/backend/gram/upload/'.$id);
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                              redirect('/backend/gram/upload/'.$id);
                              }
         }
        
       	}
        

     public function delete($userid,$id)
	{ 
         require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/gramaccess.php");             
            if((int)$id > 0){
                $bs = new File($id);
                $ds = new User($userid);
               
            if($ds->id == $data['user']->id){
   
           $ds->delete($bs);
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>'); 
            }
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα διαγραφής γι αυτό το αρχείο!</div>');
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('backend/gram/input/'.$data['user']->id);
	} 
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */