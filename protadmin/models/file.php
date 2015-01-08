<?php

class File extends DataMapper {
    
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
    function getUserFile($userid){
        return $this->user_file->where('user_id',$userid)->get();
    }
    //protocoled requests without uploaded file
    function getRequestsForProtocol(){
         return $this->where('is_protocol',0)->where('upload_file',NULL)->order_by("created_date","asc")->get();
    }
    //protocoled requests without uploaded file
    function getProtocoledRequests($userid){
         return $this->where('user_id',$userid)->where('upload_file',NULL)->order_by("created_date","asc")->get();
    }
    function getProtocoledFiles(){
         return $this->where('is_protocol',1)->order_by("protocol_date","asc")->get();
    }
    

}

/* End of file category.php */
/* Location: ./lamdapp/models/categroy.php */