<?php

/**
 * Codeigniter Autoform
 *
 * A form generation library for Codeigniter, extend the native Form Helper
 *
 * @package codeigniter-autoform
 * @author William Manley <william@kindari.net>
 * @link http://bitbucket.org/kindari/codeigniter-autoform
 */


class Autoform {
	private $_values = array();
	private $_hidden = array();
	private $_ignore = array();
	private $_types = array();
	private $_confirm = array();
	private $_labels = array();
	
	private $use_reset_button = TRUE;
	private $_action = null;
	private $CI = null;
	
	
	/**
	 * Constructor
	 *
	 * Loads needed CI helpers and assigns values from passed objects
	*/
	function __construct() {
		// Setup
		$this->CI =& get_instance();
		$this->CI->load->helper(array('form','inflector','language'));
		$this->CI->lang->load('autoform');
		$this->action();
		// Construct
		$args = func_get_args();
		foreach($args as $arg) {
			$this->from($arg);
		}
	}
	/**
	 * Builds form data
	 *
	 * Takes object and decides what to do with it based on object type
	 * @access public
	 * @param str|array|object $arg Passed object
	 * 
	*/
	public function from($arg) {
		if (is_string($arg)) {
			$this->set($arg, null);
		} elseif (is_array($arg)) {
			$this->from_array($arg);
		} else {
			$this->from_object($arg);
		}
		return $this;
	}
	/**
	 * Builds form data from object
	 *
	 * @access private
	 * @param object $arg Object
	 * @return Autoform
	*/
	private function from_object($arg) {
		return $this->from_array((array)$arg);
	}
	/**
	 * Builds form data from array
	 *
	 * @access private
	 * @param array $arr Array to be looped over.
	 * @return Autoform
	*/
	private function from_array($arr) {
		foreach($arr as $k => $v) {
			if (is_numeric($k)) {
				$k = $v;
				$v = null;
			}
			$this->set($k, $v);
		}
		return $this;
	}
	/**
	 * Labels for form fields
	 *
	 * @access public
	 * @param str $field Form Field
	 * @param str $value Optional value to manually assign a label. If not provided $value is set to humanize($field)
	 * @return str $value retrieved from cache, humanize($field) or manually supplied
	*/
	public function label($field, $value=null, $confirm=FALSE) {
		if ($value) {
			$this->_labels[$field] = $value;
			return $value;
		} elseif ( array_key_exists($field, $this->_labels) ) {
			return $this->_labels[$field];
		} elseif ( $field=='password') {
			$value = $this->CI->lang->line('autoform_password_label');
		} elseif ($confirm) {
			$value = $this->CI->lang->line('autoform_confirm_label');
			$value = str_replace('%field%', $this->label($confirm), $value);
		} else {
			$value = humanize($field);
		}
		$this->_labels[$field] = $value;
		return $value;
	}
	/**
	 * Main logic, Loop over form elements and build form data, labels, etc.
	 *
	 * @access public
	 * @param str $field Optional fields to build data for, defaults to all fields.
	 * @param bool $cache Skip elements already defined or not
	*/
	public function run($field=null,$cache=TRUE) {
		$fields = $field ? (array)$field : array_keys($this->_values);
		foreach ($fields as $field) {
			if ( in_array($field, $this->_ignore) OR ($cache and in_array($field, $this->_fields))) {
				continue;
			}
			$type = $this->type($field);
			$field_data = array();
			if ($type!='hidden') { $field_data[] = form_label($this->label($field), $field);}
			$field_data[] = call_user_func("form_{$type}", $field, $this->$field);
			$this->_fields[$field] = $field_data;
			if ( in_array($field, $this->_confirm)) {
				$cfield =  str_replace('%field%', $field, $this->CI->lang->line('autoform_confirm_field'));
				$field_data = array();
				$field_data[] = form_label($this->label($cfield, NULL, $field), $field);
				$field_data[] = call_user_func("form_{$type}", $cfield);
				$this->_fields[$cfield] = $field_data;
			}
		}
		$buttons = array();
		if ($this->use_reset_button) {
			$buttons[] = form_reset($this->_reset_button, $this->CI->lang->line('autoform_reset_label'));
		}
			$buttons[] = form_submit($this->CI->lang->line('autoform_submit_button'), $this->CI->lang->line('autoform_submit_label'));
		$this->_fields['_buttons_'] = $buttons;
		return $this;
	}
	/**
	 * Determine type of form element
	 *
	 * @access public
	 * @param str $key form field name
	 * @param str $value optional value to manually override detection methods
	 * @return str Form type
	*/
	public function type($key, $value=null) {
		if ($value) {
			$this->_types[$key] = $value;
			return $value;
		}
		if (array_key_exists($key, $this->_types)) {
			return $this->_types[$key];
		}
		switch ($key) {
			case 'password':
				$value = 'password';
				break;
			default:
				$value = 'input';
				break;
		}
		if ( in_array($key, $this->_hidden)) {
			$value = 'hidden';
		}
		$this->_types[$key] = $value;
		return $value;
	}
	/**
	 * Assign values to form fields. Same as $autoform->field = $value;
	 *
	 * @access public
	 * @param str $key form field
	 * @param str $value form field value
	 * @return Autoform
	*/
	public function set($key, $value=null) {
		$this->_values[$key] = $value;
		return $this;
	}
	/**
	 * Action URI for form to be submitted to
	 *
	 * Automaticly generates URI from Controller/method call if not set. 
	 *
	 * @access public
	 * @param str|null $uri URI to post to. if not set, automaticly generate.
	*/
	public function action($uri=null) {
		if ($uri===null) {
			$CI =& get_instance();
			// Fetch accessed directory/controller/method
			$rt = $CI->router;
			$directory = $rt->fetch_directory();
			$controller = $rt->fetch_class();
			$method = $rt->fetch_method();
			$uri = "{$controller}/{$method}";
			if ($directory) {
				$uri = "{$directory}/{$uri}";
			}
		}
		$this->_action = $uri;
		return $this;
	}
	/**
	 * Wrapper function for form_open
	 *
	 * @access private
	 * @return str
	*/
	private function open() {
		return form_open($this->_action);
	}
	/**
	 * Wrapper function for form_close
	*/
	private function close() {
		return form_close();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Magic method transforming object to string for use with echo
	 *
	 * @access public
	 * @return str Finalized Form
	*/
	public function __toString() {
		$this->run();
		//var_dump($this);
		return $this->display();
	}
	/**
	 * Wrapper method for assigning values, calls set()
	 *
	 * @access public
	 * @param str $key
	 * @param mixed $value
	*/
	public function __set($key, $value) {
		$this->set($key, $value);
	}
	/**
	 * Returns values from $_values based on key
	 *
	 * @access public
	 * @param str $key
	 * @return mixed
	*/
	public function __get($key) {
		return isset($this->_values[$key]) ? $this->_values[$key] : null; 
	}
	/**
	 * Magic method for handling confirm, ignore and hidden methods
	*/
	public function __call($name, $args) {
		if (in_array($name, array('confirm', 'ignore','hidden'))) {
			foreach($args as $arg) {
				$method = "_{$name}";
				if (is_array($arg)) {
					$this->$method = array_merge($this->$method, $arg);
				} else {
					$this->{$method}[] = $arg;
				}
			}
		}
		return $this;
	}
	/**
	 * Return output using display method
	 *
	 * @access public
	 * @param str $method Display method to use, default table
	 * @return str
	*/
	public function display($method='table') {
		$method = "display_{$method}";
		return $this->open() . $this->$method() . $this->close();
	}
	/**
	 * Use Codeigniter HTML Table library to make representation of form
	 *
	 * @access public
	 * @return str
	*/
	public function display_table() {
		$CI =& get_instance();
		$CI->load->library('table');
		array_unshift($this->_fields, array(null));
		return $CI->table->generate($this->_fields);
	}
	/**
	 * Return unordered list of form elements
	 *
	 * @access public
	 * @return str
	*/
	public function display_list() {
		$output = "<ul>";
		foreach($this->_fields as $field) {
			$output .= "<li>" . implode('', $field) . "</li>";
		}
		return $output . "</ul>";
	}
	public function describe($table) {
		$data = $this->db->field_data($table);
		//var_dump($data);
	}
	
}