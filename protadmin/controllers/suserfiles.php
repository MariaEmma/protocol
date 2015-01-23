<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suserfiles extends MY_Controller {

    
    public function __construct()
	{
		
                parent::__construct();
                
	}
        //view the incoming files wich are not stored
        public function input($id)
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Εισερχόμενα αρχεία';
            $bs = new User($id);
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
            }
            $data['ontotita'] = $bs ;
            $data['eggrafes'] = $bs->getUserUnstoredFiles();

            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/input',$data); 
	}
        
        // store the incoming files in one from the available categories
        public function store($id,$fileid)
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Εισερχόμενα αρχεία';
           // get user, file and the connection id
            $ds = new File($fileid);
            $bs = new User($id);
            $ks = new User_file();
            $ksid = $ks->getUserFile($id,$fileid);
            //redirect if the file is not user's 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα αρχειοθέτησης αυτού του αρχείου!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
             }
        
            $data['ontotita'] = $bs ;
            //get the category from the form and store it
            $this->form_validation->set_rules('categoryid', 'Κατηγορία αρχειοθέτησης', 'checkIfUserIdIsZero');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');

            if ($this->form_validation->run() == FALSE){         
                $this->load->view('suserfiles/sidebar',$data);
                $this->load->view('suserfiles/input',$data); 
            } else {
                $temp = new User_file($ksid);
                $temp->category_id = $this->input->post('categoryid');
                if($temp->save()){ 

                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αρχειθέτηση!</div>');
                        redirect('backend/suser/input/'.$data['user']->id);
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αρχειθέτησης!</div>');
                              redirect('/backend/suser/input/'.$data['user']->id);
                              }
             }
            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/input',$data);
	}
        //upload and send file in the user-protocol
      public function upload($id,$fileid) {    
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            // get user, file 
            $ds = new File($fileid);
            $bs = new User($id);
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα ανεβάσματος αρχείων για αυτό το χρήστη!</div>');            
                redirect('backend/suser/protocoled/'.$data['user']->id);
            }
            $data['mtitle'] = 'Αποστολή αρχείου';
            $data['ontotita'] = $bs ;
            
            $this->form_validation->set_rules('usersid', 'Παραλήπτες', 'required|checkIfUserIdIsZero');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');

             if($this->form_validation->run() == FALSE){         
                 $this->load->view('suserfiles/sidebar',$data);
                 $this->load->view('suserfiles/protocoled',$data); 

             }else{
                    //rename uploaded file with increaseing number
                    $maxid = new File();
                    $ar =$maxid->getMaxId()+1;
                    //select file
                    $tempu = new File($fileid);
                    $urids = $this->input->post('usersid');


             //start upload
                    $config['upload_path'] = MY_FILEPATH;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size']	= '';
                    $config['encrypt_name']= FALSE;
                    $config['file_name'] = $ar.'.pdf';
                    $this->load->library('upload', $config);                

                    if ( ! $this->upload->do_upload())
                    {   
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης! <strong>Eπιλέξτε κάποιο αρχείο ή το αρχείο που επιλέγετε να είναι με κατάληξη .pdf!</strong></div>');
                        redirect('/backend/suser/prtocoled/'.$id);
                    }
                    else
                    {
                            $tempu->upload_file = $this->upload->file_name;
                    }

                    //end upload

                    if($tempu->save()){ 
                        foreach ($urids as $oneid):
                            if(substr($oneid,-1) == 'g'){
                                $xsc = explode('-',$oneid);
                                $groupid =  $xsc[0];
                                $ngrp = new Group($groupid);
                                foreach ($ngrp->getUsersOfGroups() as $onusr):
                                    $tempu->save($onusr);
                                endforeach;
                            }
                            else{

                            $receiver = new User($oneid);
                            $tempu->save($receiver);
                            }
                        endforeach;
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                            redirect('/backend/suser/protocoled/'.$id);
                                  }
                    else {
                                  $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                                  redirect('/backend/suser/protocoled/'.$id);
                                  }
             }
        
       	}
          //view the protocoled files
        public function protocoled($id)
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Πρωτοκολλημένα αιτήματα';
            $bs = new User($id); 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
                redirect('backend/suser/protocoled/'.$data['user']->id);
            }
            $data['ontotita'] = $bs;
            $fs = new File();
            $data['eggrafes'] = $fs->getProtocoledRequests($bs->id);
            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/protocoled');
	}
        
        //view the sent files
        public function output($id)
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Απεσταλμένα αρχεία';
            $bs = new User($id); 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
                redirect('backend/suser/output/'.$data['user']->id);
            }
            $data['ontotita'] = $bs ;
            $files = new File();
            $data['eggrafes'] = $files->getLastPromotedFilesOfUser($bs->id);
            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/output');
	}
    
        //delete the sent files only when they are not protocoled
        public function delete($id)
	{ 
         require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");
         include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");             
            if((int)$id > 0){
                $bs = new File($id);
                if($bs->user_id == $data['user']->id){
                    if($bs->is_protocol == 0) {
                         if (isset($bs->upload_file))
                        {
                        $bpath = MY_FILEPATH;
                        unlink($bpath.$bs->upload_file);
                        }
                        $bs->delete();
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>'); 
                    }
                    else {
                $bs->user_id=null;
                $bs->save();
      
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>');
                redirect('backend/suser/output/'.$data['user']->id);
                }
            
              }
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα διαγραφής γι αυτό το αρχείο!</div>');
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('backend/suser/output/'.$data['user']->id);
	} 
        //view stored files
        public function archive($id){
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Αρχειοθετημένα αρχεία';
            $bs = new User($id);
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
            }
            $data['ontotita'] = $bs ;
            $data['eggrafes'] = $bs->getUserStoredFiles();

            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/archive',$data); 
            
        }
        public function request ($id) {
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");     
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php"); 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα ανεβάσματος αρχείων για αυτό το χρήστη!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
            }
            $data['mtitle'] = 'Αίτημα για πρωτόκολλο';
            $bs = new User($id); 
            $data['ontotita'] = $bs ;
            $this->form_validation->set_rules('description', 'Περιγραφή','trim' );
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');

             if($this->form_validation->run() == FALSE){         
                 $this->load->view('suserfiles/sidebar',$data);
                 $this->load->view('suserfiles/request',$data); 

             }else{
                    $maxid = new File();
                    $ar =$maxid->getMaxId()+1;
                    $tempu = new File();
                    $tempu->description = $this->input->post('description');      
                    $tempu->user_id = $id;
                    $tempu->created_date = date("Y-m-d H:i:s"); 
                    $tempu->sender_name = $bs->firstname.' '.$bs->lastname;

                    if($tempu->save()){ 

                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                            redirect('/backend/suser/protocoled/'.$id);
                                  }
                    else {
                                  $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                                  redirect('/backend/suser/request/'.$id);
                                  }
             }
    }
    public function filter($id,$catid){
          require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Αρχειοθετημένα αρχεία';
            $bs = new User($id);
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
            }
            $data['ontotita'] = $bs ;
            $cat = new Category($catid);
          
            $data['eggrafes'] = $bs->getUserStoredFilesByCategory($catid);

            $this->load->view('suserfiles/sidebar',$data);
            $this->load->view('suserfiles/archive',$data);
        }
        
         public function send($id,$fileid)
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/suaccess.php");
            $data['mtitle'] = 'Εισερχόμενα αρχεία';
           // get user, file and the connection id
            $ds = new File($fileid);
            $bs = new User($id);
            //redirect if the file is not user's 
            if($id != $data['user']->id){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα αρχειοθέτησης αυτού του αρχείου!</div>');            
                redirect('backend/suser/input/'.$data['user']->id);
             }
        
            $data['ontotita'] = $bs ;
            
            $this->form_validation->set_rules('usersid', 'Παραλήπτες', 'required|checkIfUserIdIsZero');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');

            if ($this->form_validation->run() == FALSE){                    
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Επιλέξτε παραλήπτες για την αποστολή του αρχείου!!!</div>');    
            }  else{
            
            $temp = new File($fileid);
            $temp->user_id = $bs->id; 
            $temp->sender_name = $bs->firstname.' '.$bs->lastname;
            $urids = $this->input->post('usersid');

            if ($temp->save()){
                foreach ($urids as $oneid):
                    if(substr($oneid,-1) == 'g'){
                        $xsc = explode('-',$oneid);
                        $groupid =  $xsc[0];
                        $ngrp = new Group($groupid);
                        foreach ($ngrp->getUsersOfGroups() as $onusr):
                            $temp->save($onusr);
                        endforeach;
                    }
                    else{
                            
                    $receiver = new User($oneid);
                    $temp->save($receiver);
                    }
                endforeach;
                $bs->delete($ds);
               
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                            redirect('backend/suser/input/'.$data['user']->id);
                                  }
                    else {
                                  $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                                  redirect('/backend/suser/input/'.$data['user']->id);
                                  }
             }
            
            redirect('backend/suser/input/'.$data['user']->id);
                             
        
       	}
        
   
      
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */