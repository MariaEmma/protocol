<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends CI_Controller {

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

	public function login()
	{ 
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/paths.php");
            $data['mtitle'] = 'Είσοδος Χρήστη';
            $data['description'] = 'Είσοδος Χρήστη';

            $this->form_validation->set_rules('login', 'Όνομα χρήστη', 'required|xss_clean');
            $this->form_validation->set_rules('pass', 'Κώδικος', 'required|xss_clean|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>', '</div>');

            if($this->form_validation->run() == TRUE) {
                    $u = new User();
                    $u->username = $this->input->post('login');
                    $u->passwd = $this->input->post('pass');

                    if ($u->login())
                    {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Σωστό Όνομα χρήστη και κωδικός. Συνεχίστε την πλοήγηση!</div>');            
                        $nur = new User();
                        $luser = $nur->get_by_username($u->username);               
                        $this->session->set_userdata(array('login_date' => $luser->login_date,'username' => $u->username, 'logged_in' => TRUE, 'usertype' => $u->usertype_id, 'active' => $u->active));            

                        $nur->login_date = date("Y-m-d H:i:s");
                        $nur->save();
                        if($u->usertype_id == 1)
                                redirect('backend/admin');
                        else if($u->usertype_id == 2)
                                redirect('backend/gram/myown/'.$u->id);
                        else if($u->usertype_id == 3)
                                redirect('backend/protocol/input');
                        else if($u->usertype_id == 4)
                                redirect('backend/president/input');
                        else if($u->usertype_id == 5)
                                redirect('backend/suser/input/'.$u->id);
                         else if($u->usertype_id == 6)
                                redirect('backend/school/index/'.$u->id);
                        else if($u->usertype_id == 7)
                                redirect('backend/vicepresident/input');
                        else redirect('backend/');
                        }
                    else
                    {
                            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Εσφαλμένο Όνομα χρήστη ή κωδικός ή ο χρήστης μπορεί να είναι απενεργοποιημένος. Προσπαθήστε ξανά ή επικοινωνήστε με το διαχειριστή!</div>');
                            redirect('backend');
                    }

            }
     
            $this->load->view('admin/login',$data);

            
	}
       
        public function logout()
	{
            $this->session->unset_userdata(array('username' => '', 'logged_in' => '', 'login_date' => '', 'usertype' => '', 'active' => ''));
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button class="close" data-dismiss="alert" aria-hidden="true" type="button">×</button>H Έξοδος σας ήταν επιτυχής!</div>');
            redirect('backend');
        }
        
        
        public function show404()
	{
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/paths.php");
            require_once($_SERVER['DOCUMENT_ROOT']."/protadmin/include/vars.php");
            $this->load->view('admin/page404', $data);
        }

        
        
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
