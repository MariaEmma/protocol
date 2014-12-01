<?php 
         
         if(!$this->session->userdata('logged_in') ){redirect(base_url().'backend');}
        
         if($this->session->userdata('username')){
         $ur = new User();
         $data['user'] = $ur->get_by_username($this->session->userdata('username'));
         
         if($this->session->userdata('usertype'))
             $data['ltype'] = $this->session->userdata('usertype');
             if($data['ltype'] != 3) redirect(base_url().'backend');
         }
         if($this->session->userdata('login_date'))
         $data['ldate'] = $this->session->userdata('login_date');
         