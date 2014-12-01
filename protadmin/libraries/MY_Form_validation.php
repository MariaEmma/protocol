<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Form_validation Class
 *
 * Extends Form_Validation library
 *
 * Adds one validation rule, "unique" and accepts a
 * parameter, the name of the table and column that
 * you are checking, specified in the forum table.column
 *
 * Note that this update should be used with the
 * form_validation library introduced in CI 1.7.0
 */
class MY_Form_validation extends CI_Form_validation {

	function __construct()
	{
	    parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * Unique
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	
 //μεθοδος για validation rule αν υπάρχει στο edit το item  μοναδικά
    function edit_unique($value, $params)
    {
    $CI =& get_instance();
    $CI->load->database();
     
    $CI->form_validation->set_message('edit_unique', 'Η τιμή που εισάγατε υπάρχει ήδη');
     
    list($table, $field, $current_id) = explode(".", $params);
     
    $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
     
    if ($query->row() && $query->row()->id != $current_id)
    {
    return FALSE;
    }
    }


        
   //μεθοδος για validation rule αν υπάρχει το domain του email
        public function emailexist($email)
        {
            $domain = substr($email, strpos($email, '@') + 1);
            if  (checkdnsrr($domain) !== FALSE) {
                return true;
            }
            else 
            {
                $CI =& get_instance();
                $CI->form_validation->set_message('emailexist', 'To domain name δεν υπάρχει.');            
                return false;
            }
        }
        
        public function checkIfUserIdIsZero($userid)
        {
            if($userid != 0) return true;
            else 
            {
                $CI =& get_instance();
                $CI->form_validation->set_message('checkIfUserIdIsZero', 'Δεν έχετε επιλέξει τιμή. Σε πεδίο λίστας δεν πρέπει να αφήνετε την επιλογή "Μην αφήσετε κενή επιλογή".');            
                return false;
            }
        
        }
}
?>
