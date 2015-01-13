<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {

    
    public function __construct()
	{		
                parent::__construct();  
	}
        public function findfilescategories(){
          if($_POST['id'] && $_POST['user']){
                $category = new Category($_POST['id']); 
                $userin = new User($_POST['user']);
                $eggrafes = $userin->getUserStoredFilesByCategory($_POST['id']);
                 foreach ($eggrafes as $b) :
                  echo   'tr>';
               echo '<td>'.$b->sender_name.'</td>';
                echo '<td>'.$b->description.'</td>';
                
          echo  '</tr>';
                 
                 endforeach;
                
            }   
            else {redirect('/');}
        }
        public function index()
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");     
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Κατηγορίες αρχειoθέτησης';
                $bs = new Category();
                $data['categories'] = $bs->getCategories();
                $data['ontotita'] = $data['user'];
                $this->load->view('users/sidebar',$data);
                $this->load->view('categories/index',$data);
        }
        public function addnew()
	{            
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
                require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
                $data['mtitle'] = 'Ενέργειες Διαχειριστή - Νέα κατηγορία αρχειοθέτησης';
         $data['ontotita'] = $data['user'];
        $this->form_validation->set_rules('title', 'Τίτλος', 'required|trim');
        $this->form_validation->set_rules('description', 'Περιγραφή', 'trim');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');
       
         if ($this->form_validation->run() == FALSE){         
                $this->load->view('users/sidebar',$data);
                $this->load->view('categories/new',$data); 
         }else{
                $tempu = new Category();
                $tempu->title = $this->input->post('title');
                $tempu->description = $this->input->post('description');

                if($tempu->save()){ 
                             
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                        redirect('backend/category');
                              }
                else {
                              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                              redirect('/backend/category/new');
                              }
         }
                    
        }
        
        
        public function update($id)
	{
                //να γινει ελέγχος στον κωδικα οταν γραφτει
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php"); 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php"); 
            $data['mtitle'] = 'Ενέργειες Διαχειριστή - Επεξεργασία κατηγορίας αρχειοθέτησης';
            $data['ontotita'] = $data['user'];
            if((int)$id > 0){
                 $bs = new Category();
                 $data['category'] = $bs->get_by_id($id);
                
        $this->form_validation->set_rules('title', 'Τίτλος', 'trim|required');
        $this->form_validation->set_rules('description', 'Περιγραφή', 'trim');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>', '</div>');
        
            if ($this->form_validation->run() == FALSE){
                    $this->load->view('users/sidebar',$data);
                    $this->load->view('categories/update',$data);
            }
            else{             
                                 
        $bs->title = $this->input->post('title');
        $bs->description = $this->input->post('description');
 
                    if($bs->save()){
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής αποθήκευση!</div>');
                            redirect('/backend/category');      
                    }
                    else {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Πρόβλημα αποθήκευσης!</div>');
                            redirect('/backend/category/update/'.$id);
                    }
            }                       
            } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
                    redirect('/backend/category');
                   } 
        }
        
        public function delete($id)
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/adminaccess.php");             
            if((int)$id > 0){
                $bs = new Category($id);
                
                $nofiles = $bs->getFilesOfCategories()->result_count();
                
                if($nofiles > 0){
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Yπάρχουν αρχειοθετημένα αρχεία με αυτή την κατηγορία. Πρέπει να διαγράψετε πρώτα τα αρχεία για να μπορέσει να διαγραφεί η κατηγορία.</div>');
                    redirect('/backend/category');
                }
                    $bs->delete();
                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Επιτυχής διαγραφή!</div>');            
               
                    
           } else {
               $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Το αντικείμενο δεν υπάρχει!</div>');  
            }      
         redirect('/backend/category');        
        }
        
       
}       


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */