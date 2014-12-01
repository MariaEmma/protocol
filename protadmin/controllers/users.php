<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
        function __construct()
        {
            parent::__construct();
        }
    
	public function index()
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");     
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Χρήστες';
                $bs = new User();
                $data['eggrafes'] = $bs->getUsers();
                $data['ontotita'] = $data['user'];
                $this->load->view('users/sidebar',$data);
                $this->load->view('users/index',$data);
        }
        public function addnew()
	{            
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
                require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Νέος Χρήστης';
         $data['ontotita'] = $data['user'];
        $this->form_validation->set_rules('username', 'Όνομα χρήστη', 'required|min_length[3]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('firstname', 'Όνομα', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Επώνυμο', 'trim|required');
        $this->form_validation->set_rules('phone', 'Τηλέφωνο', 'trim|required');
        $this->form_validation->set_rules('usertypeid', 'Τύπος Χρήστη', 'checkIfUserIdIsZero');
        $this->form_validation->set_rules('email', 'Ηλεκτρονική διεύθυνση', 'trim|required|valid_email|emailexist|is_unique[users.email]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if ($this->form_validation->run() == FALSE){         
                $this->load->view('users/sidebar',$data);
                $this->load->view('users/new',$data); 
         }else{
                $tempu = new User();
        $uname = $tempu->username = $this->input->post('username');
        
        $this->load->helper('string');
        $rs= random_string('alnum', 12);
        $tempu->passwd = $rs;
        $tempu->login_date = date("Y-m-d H:i:s"); 
        $tempu->register_date = date("Y-m-d H:i:s");
        $tempu->firstname = $this->input->post('firstname');
        $tempu->lastname = $this->input->post('lastname');
        $tempu->phone = $this->input->post('phone');
        $tempu->email = $this->input->post('email');
        $tempu->usertype_id = $this->input->post('usertypeid');
        $tempu->active = 1;

           if ($tempu->usertype_id == 2) {
               $tempu->school_id = $this->input->post('school_id');
               if ($tempu->school_id == null) {
                $this->session->set_flashdata('msg', '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!Πρέπει να επιλέξετε τη Σχολή στην οποία ανήκει το τμήμα!</div>');
                redirect('/backend/user/new');
            }
           }
        

                if($tempu->save()){ 
                              
                              $emailtype = 'adminreg';
                              require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/sendmail.php");
            
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                        redirect('backend/admin');
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                              redirect('/backend/user/new');
                              }
         }
                    
        }
        
        
        public function changepass($id)
	{
           require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                if((int)$id > 0){
                $bs = new User($id);
           
            if($bs->usertype_id == 1 ) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν μπορείτε ως διαχειριστής να στείλετε νέο κωδικό πρόσβασης στον εαυτό σας!</div>');
                redirect('/backend/admin');
                }
            
                $this->load->helper('string');
                $rs= random_string('alnum', 12);
                 $bs->passwd = $rs;
                 if($bs->save()){ 
                              $emailtype = 'sendpass';
                              require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/sendmail.php");
                              $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποστολή κωδικού!</div>');
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα στην αποθήκευση του κωδικού!</div>');
                              }
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/admin');
        }
        
        public function update($id)
	{
                //να γινει ελέγχος στον κωδικα οταν γραφτει
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/allaccess.php"); 
            $data['mtitle'] = 'Ενέργειες Διαχειριστή - Επεξεργασία Χρήστη';
            $data['ontotita'] = $data['user'];
            if((int)$id > 0){
                if($data['user']->usertype_id == 1){
                    $uri = '/backend/admin';
                    $lview = 'users/sidebar';
                }
                else if($data['user']->usertype_id == 2){
                    $uri ='/backend/gram/myown/'.$data['user']->id;
                    $lview = 'gramfiles/sidebar';
                }
                else if($data['user']->usertype_id == 3){
                    $uri ='/backend/protocol/input';
                    $lview = 'protfiles/sidebar';
                }
                else if($data['user']->usertype_id == 4){
                    $uri ='/backend/president/input';
                    $lview = 'presfiles/sidebar';
                }
                else if($data['user']->usertype_id == 5){
                    $uri ='/backend/suser/index/'.$data['user']->id;
                    $lview = 'suserfiles/sidebar';
                }
                else{}
                
                if($id != $data['user']->id && $data['user']->usertype_id != 1){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Δεν έχετε δικαιώματα αλλαγής των στοιχείων για αυτό το χρήστη!</div>');             
                redirect($uri);
            }
            $data['ontotita2'] = $bs = new User($id);
            $this->form_validation->set_rules('username', 'Όνομα χρήστη', 'required|min_length[3]|max_length[20]|edit_unique[users.username.'. $bs->id .']');
            if(isset($_POST['password']) && $bs->passwd != sha1($bs->salt . $_POST['password']))
                $this->form_validation->set_rules('password', 'Κώδικος', 'trim|min_length[7]|max_length[20]|matches[cnewpass]');         
            $this->form_validation->set_rules('cnewpass', 'Eπιβεβαίωση νέου κωδικού', 'trim'); 
            $this->form_validation->set_rules('firstname', 'Όνομα', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Επώνυμο', 'trim|required');
            $this->form_validation->set_rules('phone', 'Τηλέφωνο', 'trim|required');
            $this->form_validation->set_rules('email', 'Ηλεκτρονική διεύθυνση', 'trim|required|valid_email|emailexist||edit_unique[users.email.'. $bs->id .']');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
  
            if ($this->form_validation->run() == FALSE){
                    $this->load->view($lview,$data);
                    $this->load->view('users/update',$data);
            }
            else{             
                    if($bs->username != $this->input->post('username')){
                           $bs->username = $this->input->post('username');
                           if($id == $data['user']->id){
                           $this->session->unset_userdata(array('username' => ''));
                           $this->session->set_userdata(array('username' => $bs->username));
                    }
                           
                    }
                    if($this->input->post('password')!=null)                
                           $bs->passwd = $this->input->post('password');
                        
                    $bs->login_date = date("Y-m-d H:i:s"); 
                    $bs->firstname = $this->input->post('firstname');
                    $bs->lastname = $this->input->post('lastname');
                    $bs->phone = $this->input->post('phone');
                    $bs->email = $this->input->post('email');
                    if($bs->save()){
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                            redirect($uri);      
                    }
                    else {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                            redirect('/backend/user/update/'.$id);
                    }
            }                       
            } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
                    redirect('/backend');
                   } 
        }
        
        public function delete($id)
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php");             
            if((int)$id > 0){
                $bs = new User($id);
                
                $nofiles = $bs->getUserAllFiles()->result_count();
                if($nofiles > 0){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O χρήστης έχει αποστείλει αρχεία. Πρέπει να διαγράψει πρώτα αυτά για να μπορέσει να διαγραφεί.</div>');
                    redirect('/backend/admin');
                    } 
                    
                $det = new File();
                $nofiles2 = $det->getUserOwnFiles($bs->id)->result_count();
                if($nofiles2 > 0){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O χρήστης έχει χρεωθεί αρχεία. Πρέπει να πάψει η ανάθεση του σε αυτά για να μπορέσει να διαγραφεί.</div>');
                    redirect('/backend/admin');
                    }
            
            if($bs->usertype_id == 1 || $bs->usertype_id == 3 || $bs->usertype_id == 4) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O διαχειριστής, ο πρόεδρος και το πρωτόκολλο δε μπορούν να διαγραφούν!</div>');
                redirect('/backend/admin');
                }
            
            $bs->delete();
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>');            
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/admin');        
        }
        
        public function activate($id)
	{
           require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                if((int)$id > 0){
                $bs = new User($id);
           
            if($bs->usertype_id == 1 || $bs->usertype_id == 3 || $bs->usertype_id == 4) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O διαχειριστής, ο πρόεδρος και το πρωτόκολλο δε μπορούν να ενεργοποιηθούν αφού είναι πάντα ενεργοί!</div>');
                redirect('/backend/admin');
                }
            if($bs->active == 0){
            $bs->active = 1;
            $bs->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O χρήστης ενεργοποιήθηκε!</div>');            
            }
            else 
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Ο χρήστης είναι ήδη ενεργός!</div>');
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/admin');
        }
        
        public function deactivate($id)
	{
                require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
             if((int)$id > 0){
                $bs = new User($id);
           
            if($bs->usertype_id == 1 || $bs->usertype_id == 3 || $bs->usertype_id == 4) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O διαχειριστής, ο πρόεδρος και το πρωτόκολλο δε μπορούν να απενεργοποιηθούν αφού είναι πάντα ενεργοί!</div>');
                redirect('/backend/admin');
                }
            if($bs->active == 1){
            $bs->active = 0;
            $bs->save();
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>O χρήστης απενεργοποιήθηκε!</div>');            
            }
            else 
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Ο χρήστης είναι ήδη απενεργοποιημένος!</div>');
            } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/admin');;
        }
        
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
