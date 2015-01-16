<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schoolfiles extends MY_Controller {

    
    public function __construct()
	{		
                parent::__construct();  
	}

    public function input($id)
	{ 
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");
        $data['mtitle'] = 'Ενέργειες Γραμματείας Σχολής- Εισερχόμενα αρχεία';
        $bs = new User($id);
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
            redirect('backend/school/input/'.$data['user']->id);
        }
        $data['ontotita'] = $bs ;
        $data['eggrafes'] = $bs->getUserWithoutSchoolprotocolFiles();
        $this->load->view('schoolfiles/sidebar',$data);
        $this->load->view('schoolfiles/input',$data); 
	}
        
        public function certified($id)
	{ 
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");
        $data['mtitle'] = 'Ενέργειες Γραμματείας Σχολής- Πρωτοκολλημένα αρχεία Σχολής';
        $bs = new User($id);
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα προβολής ή διαγραφής των αρχείων αυτού του χρήστη!</div>');            
            redirect('backend/school/input/'.$data['user']->id);
        }
        $data['ontotita'] = $bs ;
        $data['eggrafes'] = $bs->getUserWithSchoolprotocolFiles();
        $this->load->view('schoolfiles/sidebar',$data);
        $this->load->view('schoolfiles/certified',$data); 
	}
        
     public function upload($id)
	{    
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα ανεβάσματος αρχείων για αυτό το χρήστη!</div>');            
            redirect('backend/school/input/'.$data['user']->id);
        }
        $data['mtitle'] = 'Ενέργειες Γραμματείας Σχολής - Αποστολή αρχείου';
        $bs = new User($id); 
        $data['ontotita'] = $bs ;
        
        $this->form_validation->set_rules('usersid', 'Παραλήπτες', 'required|checkIfUserIdIsZero');
        $this->form_validation->set_rules('description', 'Περιγραφή','required|trim' );
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if($this->form_validation->run() == FALSE){         
            $this->load->view('schoolfiles/sidebar',$data);
            $this->load->view('schoolfiles/upload',$data);

         }else{
               $maxid = new File();
                $ar =$maxid->getMaxId()+1;
                $tempu = new File();
                $tempu->description = $this->input->post('description');      
                $tempu->user_id = $id;
                $tempu->created_date = date("Y-m-d H:i:s"); 
                $tempu->sender_name = $bs->firstname.' '.$bs->lastname;
                $urids = $this->input->post('usersid');
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
                    redirect('/backend/school/upload/'.$id);
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
                        redirect('/backend/school/input/'.$id);
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                              redirect('/backend/school/upload/'.$id);
                              }
         }
        
       	}
//        public function certify($id,$fileid)
//	{ 
//            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
//            include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");
//            $data['mtitle'] = 'Εισερχόμενα αρχεία';
//           // get user, file and the connection id
//            $ds = new File($fileid);
//            $bs = new User($id);
//            //redirect if the file is not user's 
//            if($id != $data['user']->id){
//                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα αρχειοθέτησης αυτού του αρχείου!</div>');            
//                redirect('backend/school/input/'.$data['user']->id);
//             }
//        
//            $data['ontotita'] = $bs ;
//            //get the category from the form and store it
//            $this->form_validation->set_rules('protocol_no', 'Αριθμός πρωτοκόλλου', 'required|numeric|trim|checkIfUserIdIsZero');
//            $this->form_validation->set_rules('protocol_date', 'Ημερομηνία πρωτοκόλλου','required' );
//            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
//
//            if ($this->form_validation->run() == FALSE){         
//                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Βάλτε τιμή στα πεδία πρωτόκολλο και ημερομηνία!</div>');    
//            }  
//             else {
//                $temp = new File($fileid);
//                
//                $temp->protocol_no = $this->input->post('protocol_no');
//                $temp->is_school = 1;
//                if($this->input->post('protocol_date')=='') 
//                    $temp->protocol_date= date("Y-m-d H:i:s", strtotime($this->input->post('protocol_date')));
//                else
//                    $temp->protocol_date = date("Y-m-d H:i:s", strtotime($this->input->post('protocol_date')));
//
//                if ($temp->save()){
//                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
//                    redirect('backend/school/input/'.$data['user']->id);
//                }
//                else {
//                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
//                    redirect('/backend/school/input/'.$data['user']->id);     
//                }
//            }
//            
//            redirect('backend/school/input/'.$data['user']->id);
// 
//       	}
         public function bulkupload($id)
	{    
        require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");
        if($id != $data['user']->id){
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα ανεβάσματος αρχείων για αυτό το χρήστη!</div>');            
            redirect('backend/school/input/'.$data['user']->id);
        }
        $data['mtitle'] = 'Ενέργειες Γραμματείας Σχολής - Αποστολή αρχείου';
        $bs = new User($id); 
        $data['ontotita'] = $bs ;
        
        $this->form_validation->set_rules('usersid', 'Παραλήπτες', 'required|checkIfUserIdIsZero');
        $this->form_validation->set_rules('description', 'Περιγραφή','required|trim' );
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if($this->form_validation->run() == FALSE){         
           $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>Eπιλέξτε αρχεία από τα εισερχόμενα, παραλήπτες και αρχείο για την αποστολή του αρχείου!!!</div>');    
         }else{
                $maxid = new File();
                $ar =$maxid->getMaxId()+1;
                $tempu = new File();
                $tempu->description = $this->input->post('description');      
                $tempu->user_id = $id;
                $tempu->created_date = date("Y-m-d H:i:s"); 
                $tempu->sender_name = $bs->firstname.' '.$bs->lastname;
                $urids = $this->input->post('usersid');
                $fileids = $this->input->post('files');
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
                    redirect('/backend/school/input/'.$id);
		}
		else
		{
                        $tempu->upload_file = $this->upload->file_name;
		}
                
                //end upload
      
                if($tempu->save()){ 
                    foreach ($urids as $oneid):
                        $receiver = new User($oneid);
                        $tempu->save($receiver);
                    endforeach;
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή!</div>');
                        redirect('/backend/school/input/'.$id);
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποστολής!</div>');
                              redirect('/backend/school/input/'.$id);
                              }
         }
          redirect('/backend/school/input/'.$id);
        
       	}

     public function delete($userid,$id)
	{ 
         require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");
        include($_SERVER['DOCUMENT_ROOT']."/protadmin/include/schoolaccess.php");             
            if((int)$id > 0){
                $bs = new File($id);
                $ds = new User($userid);
            $usrfile = new User_file();
            $usrfileid = $usrfile->getUserFile($userid,$id);
//            if($bs->is_protocol == 1) {
//                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αρχείο δεν μπορεί να σβήσει!</div>');
//                redirect('backend/gram/input/'.$data['user']->id);
//                }
           
               
            if($ds->id == $data['user']->id){
//                if (isset($bs->upload_file))
//                    {
//                        $bpath = MY_FILEPATH;
//                        unlink($bpath.$bs->upload_file);
//                    }
//            $bs->delete();
                
           $userassign = new User_file($usrfileid);
           $userassign->delete();
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>'); 
            }
            else
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα διαγραφής γι αυτό το αρχείο!</div>');
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('backend/school/input/'.$data['user']->id);
	} 
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */