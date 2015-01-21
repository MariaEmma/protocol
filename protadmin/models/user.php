<?php

class User extends DataMapper {
   
    var $has_one = array('usertype');
    var $has_many = array(
        'file' => array(			
            'class' => 'file',			
            'other_field' => 'user',		
            'join_self_as' => 'user',		
            'join_other_as' => 'file',		
            'join_table' => 'user_files'),
    'group' => array(			
            'class' => 'group',			
            'other_field' => 'user',		
            'join_self_as' => 'user',		
            'join_other_as' => 'group',		
            'join_table' => 'group_users'),
        );

    var $table = 'users';
    var $validation = array(
        'username' => array(
            'label' => 'Όνομα χρήστη',
            'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 3, 'max_length' => 20),
        ),
        'passwd' => array(
            'label' => 'Κώδικος',
            'rules' => array('required', 'min_length' => 7, 'encrypt'),
        ),
        'salt' => array(
            'label' => 'salt',
            'rules' => array('required'),
        ),
        'login_date' => array(
            'label' => 'Ημερομηνία εισόδου',
            'rules' => array('required'),
        ),
        'register_date' => array(
            'label' => 'Ημερομηνία εγγραφής',
            'rules' => array('required'),
        ),
        'firstname' => array(
            'label' => 'Όνομα',
            'rules' => array('required'),
        ),
        'lastname' => array(
            'label' => 'Επώνυμο',
            'rules' => array('required'),
        ),
        'phone' => array(
            'label' => 'Τηλέφωνο',
            'rules' => array('required'),
        ),
        'email' => array(
            'label' => 'Ηλ. διεύθυνση',
            'rules' => array('required'),
        ),

    );
    
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function login()
    {
        
        $uname = $this->username;
        $u = new User();
        $u->where('username', $uname)->get();
        
        $this->salt = $u->salt;
        
        $this->validate()->get();
        if ($this->exists())
        {
            if($u->active == 0)
                return FALSE;

            return TRUE;
        }
        else
        {
            $this->username = $uname;
            return FALSE;
        }
    }
    
    function _encrypt($field)
    {
        // Don't encrypt an empty string
        if (!empty($this->{$field}))
        {
            // Generate a random salt if empty
            if (empty($this->salt))
            {
                $this->salt = md5(uniqid(mt_rand(), true));
            }
            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }
    function getUserAllFiles(){
        return $this->file->get();
    }
    function getUserFiles(){
        return $this->file->where('is_protocol',0)->order_by("created_date","asc")->get();
    }
    function getProtocolUserFiles(){
         return $this->file->where('is_protocol',1)->order_by("created_date","asc")->get();
    }
        
    function getUserSentFiles($userid){
        return $this->file->where('user_id',$userid)->order_by("created_date","asc")->get();
    }
    //xrhstes gia ti diaxeirisi
    function getAllUsers(){
        return $this->order_by("lastname")->order_by("firstname")->get();
    }
    //να φερνει μονο τους χρηστες εκτος διαχειριστή
    function getUsers(){
        return $this->where('id >',1)->order_by("lastname")->order_by("firstname")->get();
    }
//    //get users only grams and protocol
//    function getUsersForSchool($id){
//        return $this->where('id >',1)->where()->order_by("lastname")->order_by("firstname")->get();
//    }
    function getSchoolUsers(){
        return $this->where('usertype_id',6)->order_by("firstname")->get();
    }
    function getUserPresident(){
        return $this->where('usertype_id',4)->get();
    }
    function getVicepresidentIncharge(){
        return $this->where('usertype_id',7)->where('is_incharge',1)->get();
    }
    function getAllVicepresidents(){
        return $this->where('usertype_id',7)->get();
    }
    function getUserProtocol(){
        return $this->where('usertype_id',3)->get();
    }
    function getUserUnstoredFiles(){
        return $this->file->where('category_id',NULL)->order_by("created_date","asc")->get();
    }
    function getUserNopresUnstoredFiles(){
        return $this->file->where('category_id',NULL)->where('is_president',0)->get();
    }
    function getUserPresUnstoredFiles(){
        return $this->file->where('category_id',NULL)->where('is_president',1)->get();
    }
    function getUserWithoutSchoolprotocolFiles(){
        return $this->file->where('is_school',0)->get();
    }
    function getUserWithSchoolprotocolFiles(){
        return $this->file->where('is_school',1)->get();
    }
    function getUserStoredFiles(){
        return $this->file->where('category_id <>','Null')->get();
    }
    function getUserStoredFilesByCategory($cid){
        return $this->file->where('category_id <>','Null')->where('category_id',$cid)->get();
    }
    
    function getProtocolInputFiles(){
        return $this->file->where('is_protocol',0)->get();
    }
    
    
    
}

/* End of file user.php */
/* Location: ./lamdapp/models/user.php */
   
    

   
