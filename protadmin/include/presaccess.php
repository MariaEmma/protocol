<?php 
         
         if(!$this->session->userdata('logged_in') ){redirect(base_url().'backend');}
        
         if($this->session->userdata('username')){
         $ur = new User();
         $data['user'] = $ur->get_by_username($this->session->userdata('username'));
         
         if($this->session->userdata('usertype'))
             $data['ltype'] = $this->session->userdata('usertype');
             //$urtype= new Usertype($data['ltype']);
             
             //if($data['ltype'] == 4 || ($data['ltype'] == 7 && $data['user']->is_incharge==1)) {}
             //else 
         if($data['ltype'] != 4)
                 redirect(base_url().'backend');
         }
         if($this->session->userdata('login_date'))
         $data['ldate'] = $this->session->userdata('login_date');
         