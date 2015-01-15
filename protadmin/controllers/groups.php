<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

    
    public function __construct()
	{		
                parent::__construct();  
	}
        
        public function index()
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");     
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Ομάδες χρηστών';
                $bs = new Group();
                $data['groups'] = $bs->getAllGroups();
                $data['ontotita'] = $data['user'];
                $this->load->view('users/sidebar',$data);
                $this->load->view('groups/index',$data);
        }
         public function view($id)
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");     
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Ομάδες χρηστών';
                $bs = new Group($id);
                $data['group'] = $bs->get_by_id($id);
                $data['users'] = $bs->getUsersOfGroups();
                $data['ontotita'] = $data['user'];
                $this->load->view('users/sidebar',$data);
                $this->load->view('groups/view',$data);
        }
        public function addnew()
	{            
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
                require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Νέα ομάδα χρηστών';
         $data['ontotita'] = $data['user'];
        $this->form_validation->set_rules('title', 'Τίτλος', 'required|trim');  
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if ($this->form_validation->run() == FALSE){         
                $this->load->view('users/sidebar',$data);
                $this->load->view('groups/new',$data); 
         }else{
                $tempu = new Group();
                $tempu->title = $this->input->post('title');
                
                if($tempu->save()){ 
                             
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                        redirect('backend/group');
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                              redirect('/backend/group/new');
                              }
         }
                    
        }
        
        
        public function update($id)
	{
                //να γινει ελέγχος στον κωδικα οταν γραφτει
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
            $data['mtitle'] = 'Ενέργειες Διαχειριστή - Επεξεργασία ομάδας χρηστών';
            $data['ontotita'] = $data['user'];
            if((int)$id > 0){
                 $bs = new Group();
                 $data['group'] = $bs->get_by_id($id);
                
        $this->form_validation->set_rules('title', 'Τίτλος', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
        
            if ($this->form_validation->run() == FALSE){
                    $this->load->view('users/sidebar',$data);
                    $this->load->view('groups/update',$data);
            }
            else{             
                                 
        $bs->title = $this->input->post('title');
                    if($bs->save()){
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                            redirect('/backend/group');      
                    }
                    else {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                            redirect('/backend/group/update/'.$id);
                    }
            }                       
            } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
                    redirect('/backend/group');
                   } 
        }
        
        public function delete($id)
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php");             
            if((int)$id > 0){
                $bs = new Group($id);
                
                $nousers = $bs->getUsersOfGroups()->result_count();
                if($nousers == 0){
                    $bs->delete();
                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>');            
                }
                else 
                    {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Yπάρχουν χρήστες σε αυτή την ομάδα. Πρέπει να διαγράψετε πρώτα να τους αφαιρέσετε για να μπορέσει να διαγραφεί η ομάδα.</div>');
                    
                    } 
                    
           } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/group');        
        }
        
        public function newmember($id) {
       
         require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
            $data['mtitle'] = 'Ενέργειες Διαχειριστή - Επεξεργασία ομάδας χρηστών';
            $data['ontotita'] = $data['user'];
            
        if((int)$id > 0){
           $bs = new Group();
           $data['group'] = $bs->get_by_id($id);
           $usrs = new User();
           $data['users'] = $usrs->getUsers();  
           $this->form_validation->set_rules('user_id', 'Χρήστης' );
           $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
        
            if ($this->form_validation->run() == FALSE){
                    $this->load->view('users/sidebar',$data);
                    $this->load->view('groups/newmember',$data);
            }
            else{             
                $tempu = new Group_user();
                $tempu->user_id = $this->input->post('user_id');
                $tempu->group_id = $bs->id;
                $grus = new Group_user();
                
                if($tempu->save()){
                    $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                    redirect('/backend/group/view/'.$bs->id);
                    
                }
                else {         
                    $this->session->set_flashdata('msg', '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                    redirect('/backend/group/newmember/'.$bs->id);
                    }
                
                }
                
            }
            
        }
        public function delmember($id,$userid) {
       
         require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
            $data['mtitle'] = 'Ενέργειες Διαχειριστή - Επεξεργασία ομάδας χρηστών';
            $data['ontotita'] = $data['user'];
       
           $bs = new Group($id);
           $data['group'] = $bs->get_by_id($id);
           $usrs = new User($userid);
           $groupuser = new Group_user();
           $grustodelete = $groupuser->getGroupUser($bs->id, $usrs->id);
           $grustodelete->delete();     
           $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>');            
                
           redirect('/backend/group/view/'.$bs->id); 
           
        }
        
        
       
        
       
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */