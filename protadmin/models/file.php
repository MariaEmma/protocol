<?php

class File extends DataMapper {
    var $has_one = array('category'); 
    var $has_many = array(
        'user' => array(			
            'class' => 'user',			
            'other_field' => 'file',		
            'join_self_as' => 'file',		
            'join_other_as' => 'user',		
            'join_table' => 'user_files'),
         
    );
    var $table = 'files';
    var $validation = array(
        'description' => array(
            'label' => 'Περιγραφή',
            'rules'=> array('trim'),
        ),
        'upload_file' => array(
            'label' => 'Αρχείο', 
            'rules'=> array('required'),
        ),        
    );
       
//function getUserOwnFiles($userid){
//        return $this->where('sent_user',$userid)->order_by("president_date")->get();
//    } 
function getMaxId(){
        return $this->select_max('id')->get()->id;
    }
    function getSentFilesOfUser($usrid){
        return $this->where('user_id',$usrid)->get();
    }
    function getFileReceiver(){
        return $this->user->get();
    }
    

}

/* End of file category.php */
/* Location: ./lamdapp/models/categroy.php */