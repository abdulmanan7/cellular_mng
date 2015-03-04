<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Oinvoices
 *
 * @package		Oinvoices
 * @author		Oinvoices Dev Team
 * @license		http://doc.Oinvoicescms.com/en/basic-infos/license-agreement
 * @link		http://Oinvoicescms.com
 * @since		Version 0.90
 */

// ------------------------------------------------------------------------

/**
 * Oinvoices Installer
 *
 * @package		Oinvoices
 * @subpackage	Installer
 * @category	Installer
 * @author		Oinvoices Dev Team
 *
 */

class Installer
{
    private static $instance;

    private $template;

    public $lang = array();

    // Default language
    public $lang_code = 'en';

    public $db;


    // --------------------------------------------------------------------


    /**
     * Constructor
     *
     */
    public function __construct()
    {
        self::$instance =& $this;

        // Check GET language
        if (is_array($_GET) && isset($_GET['lang'])) {
            $this->lang_code = $_GET['lang'];

            if (is_file(ROOTPATH . 'install/language/' . $_GET['lang'] . '/install_lang.php'))
                $lang = $_GET['lang'];
        }

        $this->template['lang'] = $this->lang_code;

        // Include language file and merge it to language var
        $lang = array();
        include(ROOTPATH . 'install/language/' . $this->lang_code . '/install_lang.php');

        $this->lang = array_merge($this->lang, $lang);

        // Get all available translations
        $dirs = scandir(ROOTPATH . 'install/language');

        $languages = array();
        foreach ($dirs as $dir) {
            if (is_dir(ROOTPATH . 'install/language/' . $dir)) {
                if (is_file(ROOTPATH . 'install/language/' . $dir . '/install_lang.php') and strpos($dir, '.') === false) {
                    $languages[] = $dir;
                }
            }
        }
        $this->template['languages'] = $languages;

        // Put the current URL to template (for language selection)
        $this->template['current_url'] = (isset($_GET['step'])) ? '?step=' . $_GET['step'] : '?step=checkconfig';
    }


    // --------------------------------------------------------------------


    /**
     * Returns current instance of Installer
     *
     */
    public static function &get_instance()
    {
        return self::$instance;
    }


    // --------------------------------------------------------------------


    /**
     * Checks the config settings
     *
     */
    function check_config()
    {
        // PHP version >= 5
        $this->template['php_version'] = version_compare(substr(phpversion(), 0, 3), '5.3', '>=');

        // MySQL support
        $this->template['mysql_support'] = function_exists('mysql_connect');

        // Safe Mode
        $this->template['safe_mode'] = (ini_get('safe_mode')) ? FALSE : TRUE;

        // Files upload
        $this->template['file_uploads'] = (ini_get('file_uploads')) ? TRUE : FALSE;

        // GD lib
        $this->template['gd_lib'] = function_exists('imagecreatetruecolor');

        // Check files rights
        $files = array(
            'application/config/config.php',
            'application/config/database.php',
            'application/config/email.php',
            'application/config/ion_auth.php',
        );

        $check_files = array();
        foreach ($files as $file)
            $check_files[$file] = is_really_writable(ROOTPATH . $file);

        // Check folders rights
        $folders = array(
            'application/config',
        );

        $check_folders = array();
        foreach ($folders as $folder)
            $check_folders[$folder] = $this->_test_dir(ROOTPATH . $folder, true);

        $this->template['check_files'] = $check_files;
        $this->template['check_folders'] = $check_folders;

        // Message to user if one setting is false
        foreach ($this->template as $config) {
            if (!$config) {
                $this->template['next'] = false;
                $this->_send_error('check_config', lang('config_check_errors'));
            }
        }
        // Outputs the view
        $this->output('check_config');
    }


    // --------------------------------------------------------------------


    /**
     * Prints out the database form
     *
     */
    function configure_database()
    {
        if (!isset($_POST['action'])) {
            $data = array('db_driver', 'db_hostname', 'db_name', 'db_username');

            $this->_feed_blank_template($data);

            $this->output('database');
        } else {
            $this->_save_database_settings();
        }
    }


    // --------------------------------------------------------------------


    /**
     * Prints out the user form
     *
     */
    function configure_user()
    {
        // Check if an Admin user already exists in the DB
        $this->template['skip'] = FALSE;

        $this->db_connect();

        $this->db->where('id', '1');
        $query = $this->db->get('users');
        if(!empty($query)) {
            if ($query->num_rows() > 0) {
                //update existing
                $this->template['skip'] = TRUE;
            }
        }


        if (!isset($_POST['action'])) {
            // Skip TRUE and no POST = Admin user already exists
            if ($this->template['skip'] == TRUE) {
                $this->template['message_type'] = 'alert';
                $this->template['message'] = lang('user_info_admin_exists');
            }

            // Prepare data
            $data = array('username', 'firstname', 'lastname', 'email', 'encryption_key');

            $this->_feed_blank_template($data);

            // Encryption key : check if one exists
            require(ROOTPATH . 'application/config/config.php');
            if ($config['encryption_key'] == '') {
                $this->template['encryption_key'] = $this->generateEncryptKey();
            }

            $this->output('user');
        } else {
            $this->_save_user();

            $this->db_connect();

            // header("Location: ".BASEURL.'install/?step=data&lang='.$this->template['lang'], TRUE, 302);
            header("Location: " . BASEURL . 'install/?step=finish&lang=' . $this->template['lang'], TRUE, 302);
        }
    }



    // --------------------------------------------------------------------


    /**
     * Finish installation
     *
     */
    function finish()
    {            // Config library

        $this->template['base_url'] = BASEURL;
        $this->output('finish');
    }



    // --------------------------------------------------------------------


    /**
     * Saves database settings
     *
     */
    function _save_database_settings()
    {
        $fields = array('db_driver', 'db_hostname', 'db_name', 'db_username');

        // Post data
        $data = array();

        // Check each mandatory POST data
        foreach ($fields as $key) {
            if (isset($_POST[$key])) {
                $val = $_POST[$key];

                // Break if $val == ''
                if ($val == '') {
                    $this->_send_error('database', lang('database_error_missing_settings'), $_POST);
                }

                if (!get_magic_quotes_gpc())
                    $val = addslashes($val);

                $data[$key] = trim($val);
            }
        }


        // Try connect or exit
        if (!$this->_db_connect($data)) {
            $this->_send_error('database', lang('database_error_coud_not_connect'), $_POST);
        }


        // If database doesn't exists, create it !
        if (!$this->db->db_select()) {
            // Loads CI DB Forge class
            require_once(BASEPATH . 'database/DB_forge' . EXT);
            require_once(BASEPATH . 'database/drivers/' . $this->db->dbdriver . '/' . $this->db->dbdriver . '_forge' . EXT);

            $class = 'CI_DB_' . $this->db->dbdriver . '_forge';

            $this->dbforge = new $class();

            if (!$this->dbforge->create_database($data['db_name'])) {
                $this->_send_error('database', lang('database_error_coud_not_create_database'), $_POST);
            } else {
                // Put information about database creation to view
                $this->template['database_created'] = lang('database_created');
                $this->template['database_name'] = $data['db_name'];
            }
        }


        // Select database, save database config file and launch SQL table creation script
        // The database should exists, so try to connect
        if (!$this->db->db_select()) {
            $this->_send_error('database', lang('database_error_database_dont_exists'), $_POST);
        } else {
            // Everything's OK, save config/database.php
            if (!$this->_save_database_settings_to_file($data)) {
                $this->_send_error('database', lang('database_error_writing_config_file'), $_POST);
            }


            // Load database XML script
            $xml = simplexml_load_file('./database/database.xml');

            // Get tables & content
            $tables = $xml->xpath('/sql/tables/query');
            $content = $xml->xpath('/sql/content/query');

            // Create tables
            // In case of migration, this script will only create the missing tables
            foreach ($tables as $table) {
                $this->db->query($table);
            }


            // Basis content insert
            // In case of migration (content already exists), the existing content will not be overwritten
            foreach ($content as $sql) {
                $this->db->query($sql);
            }

            // Users message
            $this->template['database_installation_message'] = lang('database_success_install');
        }

        header("Location: " . BASEURL . 'install/?step=user&lang=' . $this->template['lang'], TRUE, 302);
    }


    // --------------------------------------------------------------------


    /**
     * Saves the user informations
     *
     */
    function _save_user()
    {
        // Config library
        require_once('./class/Config.php');

        // Saves the new encryption key
        if (!empty($_POST['encryption_key']) && strlen($_POST['encryption_key']) > 31) {
            include(APPPATH . 'config/config.php');
            include(APPPATH . 'config/ion_auth.php');

            if ($config['encryption_key'] == '') {
                $conf = new ION_Config(APPPATH . 'config/', 'config.php');

                $conf->set_config('encryption_key', $_POST['encryption_key']);

                if ($conf->save() == FALSE) {
                    $this->_send_error('user', lang('settings_error_write_rights_config'), $_POST);
                }

            }
        }

        // Saves the users data
        $fields = array('username', 'first_name', 'last_name', 'email', 'password', 'password2');
        // Post data
        $data = array();

        // Check each mandatory POST data
        foreach ($fields as $key) {
            if (isset($_POST[$key])) {
                $val = $_POST[$key];

                // Exit if $val == ''
                if ($val == '') {
                    $this->_send_error('user', lang('user_error_missing_settings'), $_POST);
                }

                // Exit if username or password < 4 chars
                if (($key == 'username' OR $key == 'password') && strlen($val) < 4) {
                    $this->_send_error('user', lang('user_error_not_enough_char'), $_POST);
                }

                if (!get_magic_quotes_gpc())
                    $val = addslashes($val);

                $data[$key] = trim($val);
            }
        }

        // Check email
        if (!valid_email($data['email'])) {
            $this->_send_error('user', lang('user_error_email_not_valid'), $_POST);
        }

        // Check password
        if (!($data['password'] == $data['password2'])) {
            $this->_send_error('user', lang('user_error_passwords_not_equal'), $_POST);
        }

        // Here is everything OK, we can create the user
        $data['username'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['salt'] = '';
        $data['password'] = $this->hash_password($data['password']);
        $user_id = '1';
        // Clean data array
        unset($data['password2']);

        // DB save
        $this->db_connect();

        // Check if the user exists
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            // updates the user
            // $this->db->where('username', $data['username']);
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);

            //Save Data to Ion_Auth config file
            $config_data['email'] = $_POST['email'];
            if (!$this->_save_ion_auth_settings_to_file($config_data)) {
                $this->_send_error('user', lang('ion_auth_error_writing_config_file'), $_POST);
            }
        }

    }


    // --------------------------------------------------------------------


    /**
     * Outputs the view
     *
     */
    function output($_view)
    {
        GLOBAL $config;
        if (!isset($this->template['next'])) {
            $this->template['next'] = true;
        }

        $this->template['version'] = $config['version'];

        extract($this->template);

        include('./views/header.php');
        include('./views/' . $_view . '.php');
        include('./views/footer.php');
    }


    // --------------------------------------------------------------------


    /**
     * Generates a random salt value.
     *
     * @return String    Hash value
     *
     **/


    public function hash_password($password)
    {
        if (empty($password)) {
            return FALSE;
        } else {
            //bcrypt
            require('../application/libraries/Bcrypt.php');
            $bcrypt = new Bcrypt();
            return $bcrypt->hash($password);
        }

    }



    // --------------------------------------------------------------------


    /**
     * Get one translation
     *
     */
    public function get_translation($line)
    {
        return (isset($this->lang[$line])) ? $this->lang[$line] : '#' . $line;
    }


    // --------------------------------------------------------------------

    /**
     * Connects to the DB with the database.php config file
     *
     */
    function db_connect()
    {
        include(APPPATH . 'config/database' . EXT);

        $this->db = DB('default', true);

        $this->db->db_connect();
        $this->db->db_select();
    }



    // --------------------------------------------------------------------


    /**
     * Tests if a dir is writable
     *
     * @param    string        folder path to test
     * @param    boolean        if true, check all directories recursively
     *
     * @return    boolean        true if every tested dir is writable, false if one is not writable
     *
     */
    function _test_dir($dir, $recursive = false)
    {
        if (!is_really_writable($dir) OR !$dh = opendir($dir))
            return false;
        if ($recursive) {
            while (($file = readdir($dh)) !== false)
                if (@filetype($dir . $file) == 'dir' && $file != '.' && $file != '..')
                    if (!$this->_test_dir($dir . $file, true))
                        return false;
        }

        closedir($dh);
        return true;
    }


    // --------------------------------------------------------------------

    /**
     * Tests if a file is writable
     *
     * @param    Mixed        folder path to test
     * @param    boolean        if true, check all directories recursively
     *
     * @return    boolean        true if every tested dir is writable, false if one is not writable
     *
     */
    function _test_file($files)
    {
        foreach ($files as $file) {
            if (!is_really_writable($file)) return false;
        }
        return true;
    }


    // --------------------------------------------------------------------


    /**
     * Try to connect to the DB
     *
     */
    function _db_connect($data)
    {
        // $dsn = 'dbdriver://username:password@hostname/database';
        $dsn = $data['db_driver'] . '://' . $data['db_username'] . ':' . $_POST['db_password'] . '@' . $data['db_hostname'] . '/' . $data['db_name'];

        $this->db = DB($dsn, true, true);

        return $this->db->db_connect();
    }


    // --------------------------------------------------------------------


    /**
     * Feed the templates data with blank values
     * @param    array    Array of key to fill
     */
    function _feed_blank_template($data)
    {
        foreach ($data as $key) {
            $this->template[$key] = '';
        }
    }


    // --------------------------------------------------------------------


    /**
     * Feed the templates data with provided values
     * @param    array    Array of key to fill
     */
    function _feed_template($data)
    {
        foreach ($data as $key => $value) {
            $this->template[$key] = $value;
        }
    }

    function _clean_data($data, $table)
    {
        $cleaned_data = array();

        if (!empty($data)) {
            $fields = $this->db->list_fields($table);
            $fields = array_fill_keys($fields, '');
            $cleaned_data = array_intersect_key($data, $fields);
        }
        return $cleaned_data;
    }

    public function _exists($where, $table)
    {
        $query = $this->db->get_where($table, $where, FALSE);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function _get_default_lang()
    {
        $query = $this->db->get_where('lang', array('def' => '1'), FALSE);

        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return FALSE;

    }


    // --------------------------------------------------------------------


    /**
     * Creates an error message and displays the submitted view
     * @param    string    View name
     * @param    string    Error message content
     * @param    array    Data to feed to form. Optional.
     */
    function _send_error($view, $msg, $data = array())
    {
        $this->template['message_type'] = 'error';
        $this->template['message'] = $msg;

        if (!empty($data)) {
            $this->_feed_template($data);
        }

        $this->output($view);

        exit();
    }


    // --------------------------------------------------------------------


    /**
     * Saves database settings to config/database.php file
     *
     */
    function _save_database_settings_to_file($data)
    {
        // Files begin
        $conf = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";

        $conf .= "\$active_group = 'default';\n";
        $conf .= "\$active_record = TRUE;\n\n";

        $conf .= "\$db['default']['hostname'] = '" . $data['db_hostname'] . "';\n";
        $conf .= "\$db['default']['username'] = '" . $data['db_username'] . "';\n";
        $conf .= "\$db['default']['password'] = '" . $_POST['db_password'] . "';\n";
        $conf .= "\$db['default']['database'] = '" . $data['db_name'] . "';\n";
//        enable if you want to auto deduct your db driver.
//        $conf .= "\$db['default']['dbdriver'] = '".$data['db_driver']."';\n";
        $conf .= "\$db['default']['dbdriver'] = 'mysql';\n";
        $conf .= "\$db['default']['dbprefix'] = '';\n";
        $conf .= "\$db['default']['pconnect'] = TRUE;\n";
        $conf .= "\$db['default']['db_debug'] = FALSE;\n";
        $conf .= "\$db['default']['cache_on'] = FALSE;\n";
        $conf .= "\$db['default']['cachedir'] = '';\n";
        $conf .= "\$db['default']['char_set'] = 'utf8';\n";
        $conf .= "\$db['default']['dbcollat'] = 'utf8_unicode_ci';\n";
        $conf .= "\$db['default']['swap_pre'] = '';\n";
        $conf .= "\$db['default']['autoinit'] = TRUE;\n";
        $conf .= "\$db['default']['stricton'] = FALSE;\n";

        // files end
        $conf .= "\n";
        $conf .= '/* End of file database.php */' . "\n";
        $conf .= '/* Auto generated by Installer on ' . date('Y.m.d H:i:s') . ' */' . "\n";
        $conf .= '/* Location: ./application/config/database.php */';

        return @file_put_contents(APPPATH . '/config/database' . EXT, $conf);
    }

    function _save_ion_auth_settings_to_file($data)
    {
        // Files begin
        $site = isset($data['site']) ? $data['site'] : 'example.com';
        $email = isset($data['email']) ? $data['email'] : 'admin@admin.com';

        $conf = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";
        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Ion Auth ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";
        $conf .= "\$config['tables']['users'] = 'users';\n\n";
        $conf .= "\$config['tables']['groups']          = 'groups';\n\n";
        $conf .= "\$config['tables']['users_groups']    = 'users_groups';\n\n";
        $conf .= "\$config['tables']['login_attempts']  = 'login_attempts';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Users Table ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['user_table'] = 'users';\n\n";
        $conf .= "\$config['user_table_pk'] = 'id';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Groups ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";
        $conf .= "\$config['join']['users']  = 'user_id';\n\n";
        $conf .= "\$config['join']['groups'] = 'group_id';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Hash Method (sha1 or bcrypt) ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['hash_method']    = 'bcrypt';\n\n";
        $conf .= "\$config['default_rounds'] = 8;	\n\n";
        $conf .= "\$config['random_rounds']  = FALSE;\n\n";
        $conf .= "\$config['min_rounds']     = 5;\n\n";
        $conf .= "\$config['max_rounds']     = 9;\n\n";
        $conf .= "\$config['salt_prefix']    = '$2y$';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Authentication Options' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['site_title']                 = '" . $site . "';\n";
        $conf .= "\$config['admin_email']                = '" . $email . "';\n";
        $conf .= "\$config['default_group']              = 'members';\n\n";
        $conf .= "\$config['admin_group']                = 'admin';\n\n";
        $conf .= "\$config['identity']                   = 'email';\n\n";
        $conf .= "\$config['min_password_length']        = 8;\n\n";
        $conf .= "\$config['max_password_length']        = 20;\n\n";
        $conf .= "\$config['email_activation']           = FALSE;\n\n";
        $conf .= "\$config['manual_activation']          = FALSE;\n\n";
        $conf .= "\$config['remember_users']             = TRUE;\n\n";
        $conf .= "\$config['user_expire']                = 86500;\n\n";
        $conf .= "\$config['user_extend_on_login']       = FALSE;\n\n";
        $conf .= "\$config['track_login_attempts']       = FALSE;\n\n";
        $conf .= "\$config['track_login_ip_address']     = TRUE;\n\n";
        $conf .= "\$config['maximum_login_attempts']     = 3;\n\n";
        $conf .= "\$config['lockout_time']               = 600;\n\n";
        $conf .= "\$config['forgot_password_expiration'] = 0;\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Cookies Options ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['remember_cookie_name'] = 'remember_code';\n\n";
        $conf .= "\$config['identity_cookie_name'] = 'identity';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Email Options ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['use_ci_email'] = FALSE;\n\n";
        $conf .= "\$config['email_config'] = array('mailtype' => 'html',);\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Email Template ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['email_templates'] = 'auth/email/';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Activate Account Email Template ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['email_activate'] = 'activate.tpl.php';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Forgot Password Email Template ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['email_forgot_password'] = 'forgot_password.tpl.php';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Forgot Password Complete Email Template' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['email_forgot_password_complete'] = 'new_password.tpl.php';\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|  Salt options ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['salt_length'] = 22;\n\n";
        $conf .= "\$config['store_salt']  = FALSE;\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Message Delimiters. ' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "\$config['delimiters_source']       = 'config';\n\n";
        $conf .= "\$config['message_start_delimiter'] = '<p class=\"alert alert-success\">';\n\n";
        $conf .= "\$config['message_end_delimiter']   = '</p>';\n\n";
        $conf .= "\$config['error_start_delimiter']   = '<p class=\"alert alert-danger\">';\n\n";
        $conf .= "\$config['error_end_delimiter']     = '</p>';\n\n";

        $conf .= "\n\n";
        $conf .= '/* End of file language.php */' . "\n";
        $conf .= '/* Auto generated by Oinvoices Installer on : ' . date('Y.m.d H:i:s') . ' */' . "\n";
        $conf .= '/* Location: ./application/config/ion_auth.php */';
        return @file_put_contents(APPPATH . '/config/ion_auth' . EXT, $conf);
    }

    /**
     * Saves the website default settings
     * - Default lang
     *
     *
     */
    function settings()
    {
        if (!isset($_POST['action'])) {
            $this->template[''] = '';
            $this->template[''] = '';
            $this->template[''] = '';

            $this->output('settings');
        } else {
            $ret = $this->_save_settings();

            if ($ret) {
                header("Location: " . BASEURL . 'install/?step=database&lang=' . $this->template['lang'], TRUE, 302);
            } else {
                $this->_send_error('settings', lang('settings_error_write_rights'), $_POST);
            }
        }
    }

    function _save_language_config_file($data)
    {
        // Default language
        $def_lang = '';

        // Available / Online languages array
        $available_languages = array();
        $online_languages = array();

        foreach ($data as $l) {
            // Set default lang code
            if ($l['def'] == '1')
                $def_lang = $l['lang'];

            $available_languages[$l['lang']] = $l['name'];

            if ($l['online'] == '1')
                $online_languages[$l['lang']] = $l['name'];
        }

        // Language file save
        $conf = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n\n";

        $conf .= '/*' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Oinvoices LANGUAGES' . "\n";
        $conf .= '| -------------------------------------------------------------------' . "\n";
        $conf .= '| Contains the available languages definitions for the front-end.' . "\n";
        $conf .= '| Auto-generated by Oinvoicess Language administration.' . "\n";
        $conf .= '| Changes made in this file will be overwritten by languages save in Oinvoices.' . "\n";
        $conf .= '|' . "\n";
        $conf .= '|' . "\n";
        $conf .= '*/' . "\n\n";

        $conf .= "// Default admin language code\n";
        $conf .= "\$config['default_admin_lang'] = 'en';\n\n";

        $conf .= "// Default language code\n";
        $conf .= "// This code depends on the language defined through the Oinvoices admin panel\n";
        $conf .= "// and will never change during the request process \n";
        $conf .= "\$config['default_lang_code'] = '" . $def_lang . "';\n\n";

        $conf .= "// Used language code\n";
        $conf .= "// Dynamically changed by the Router depending on the browser, cookie or asked URL\n";
        $conf .= "// By default, Oinvoices set it to the default lang code.\n";
        $conf .= "\$config['detected_lang_code'] = '" . $def_lang . "';\n\n";

        $conf .= "// Available languages\n";
        $conf .= "// Languages set through Oinvoices. Includes offline languages\n";
        $conf .= "\$config['available_languages'] = " . dump_variable($available_languages) . "\n\n";

        $conf .= "// Online languages\n";
        $conf .= "// Languages set online through Oinvoices.\n";
        $conf .= "\$config['online_languages'] = " . dump_variable($online_languages) . "\n\n";

        $conf .= "// Default Translations Language Code\n";
        $conf .= "// Used as reference by the translation tool\n";
        $conf .= "\$config['default_translation_lang_code'] = '" . $def_lang . "';\n\n";

        // files end
        $conf .= "\n\n";
        $conf .= '/* End of file language.php */' . "\n";
        $conf .= '/* Auto generated by Oinvoices Installer on : ' . date('Y.m.d H:i:s') . ' */' . "\n";
        $conf .= '/* Location: ./application/config/language.php */';

        return @file_put_contents(APPPATH . 'config/language' . EXT, $conf);

    }

    // --------------------------------------------------------------------


    /**
     * Encrypts one password, based on the encrypt key set in config/ascess.php
     *
     * @param    string        Password to encrypt
     * @param    array        User data array
     * @return    string        Encrypted password
     *
     */
    function _encrypt094($str, $data)
    {
        // Get the Access lib config file
        include(APPPATH . 'config/access.php');

        $hash = sha1($data['username'] . $data['salt']);
        $key = sha1($config['encrypt_key'] . $hash);

        return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, substr($key, 0, 56), $str, MCRYPT_MODE_CFB, substr($config['encrypt_key'], 0, 8)));
    }


    // --------------------------------------------------------------------


    function _decrypt($str, $data)
    {
        require_once('./class/Encrypt.php');

        include(APPPATH . 'config/config.php');

        $encrypt = new ION_Encrypt($config);

        $hash = $encrypt->sha1($data['username'] . $data['salt']);
        $key = $encrypt->sha1($config['encryption_key'] . $hash);

        return $encrypt->decode($str, substr($key, 0, 56));
    }

    function _decrypt096($str, $data)
    {
        require_once('./class/Encrypt.php');

        include(APPPATH . 'config/config.php');

        $encrypt = new ION_Encrypt($config);

        $hash = $encrypt->sha1($data['username'] . $data['salt']);
        $key = $encrypt->sha1($config['encryption_key'] . $hash);

        return $encrypt->old_decode($str, substr($key, 0, 56));
    }


    /**
     * Encrypts one password, based on the encrypt key set in config file
     *
     * @param    string        Password to encrypt
     * @param    array        User data array
     * @return    string        Encrypted password
     *
     */
    function _encrypt($str, $data)
    {
        require_once('./class/Encrypt.php');

        include(APPPATH . 'config/config.php');

        $encrypt = new ION_Encrypt($config);

        $hash = $encrypt->sha1($data['username'] . $data['salt']);
        $key = $encrypt->sha1($config['encryption_key'] . $hash);

        return $encrypt->encode($str, substr($key, 0, 56));
    }


    // --------------------------------------------------------------------


    function _decrypt094($str, $data)
    {
        // Get the Access lib config file
        include(APPPATH . 'config/config.php');

        $hash = sha1($data['username'] . $data['salt']);
        $key = sha1($config['encryption_key'] . $hash);

        return mcrypt_decrypt(MCRYPT_BLOWFISH, substr($key, 0, 56), base64_decode($str), MCRYPT_MODE_CFB, substr($config['encryption_key'], 0, 8));
    }

    // --------------------------------------------------------------------


    function _decrypt093($str, $data)
    {
        // Get the Access lib config file
        include(APPPATH . 'config/access.php');

        $hash = sha1($data['username'] . $data['join_date']);
        $key = sha1($config['encrypt_key'] . $hash);

        return mcrypt_decrypt(MCRYPT_BLOWFISH, substr($key, 0, 56), base64_decode($str), MCRYPT_MODE_CFB, substr($config['encrypt_key'], 0, 8));
    }


    // --------------------------------------------------------------------


    function generateEncryptKey($size = 32)
    {
        $vowels = 'aeiouyAEIOUY';
        $consonants = 'bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ1234567890@#$!()';

        $key = '';

        $alt = time() % 2;
        for ($i = 0; $i < $size; $i++) {
            if ($alt == 1) {
                $key .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $key .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $key;
    }

    /**
     *Save Site name and email for sending company invoices etc.
     */
    public function _save_settings()
    {
//        pr($_POST);
        // Config library
        require_once('./class/Config.php');
        // Check if data are empty
        $base_url = isset($_POST['base_url']) ? $_POST['base_url'] : BASEURL;

        if (empty($_POST['system_email'])) {
            $this->_send_error('settings', lang('settings_error_missing_email'), $_POST);
        }
        if (empty($_POST['default_controller'])) {
            $this->_send_error('settings', lang('settings_error_missing_controller'), $_POST);
        }
        if (!valid_email($_POST['system_email'])) {
            $this->_send_error('settings', lang('user_error_email_not_valid'), $_POST);
        }
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $base_url)) {
            $this->_send_error('settings', lang('settings_error_base_url'), $_POST);
        }

        $conf = new ION_Config(APPPATH . 'config/', 'oinvoices.php');
        $conf->set_config('system_email', $_POST['system_email']);
        $conf->set_config('site_title', $_POST['site_title']);
        //if admin_email saving fail
        if ($conf->save() == FALSE) {
            $this->_send_error('user', lang('settings_error_write_rights_email'), $_POST);
        }
        $conf = new ION_Config(APPPATH . 'config/', 'config.php');
        $conf->set_config('base_url', $base_url);
//        pr($conf);
        //if base url saving fail
        if ($conf->save() == FALSE) {
            $this->_send_error('user', lang('settings_error_write_rights_config'), $_POST);
        } else {
            $conf = new ION_Config(APPPATH . 'config/', 'routes.php');

            $conf->set_route('default_controller', $_POST['default_controller']);

            if ($conf->save() == FALSE) {
                $this->_send_error('user', lang('settings_error_write_rights_controller'), $_POST);
            }
            return true;
        }
    }
}

function &get_instance()
{
    return Installer::get_instance();
}

/**
 * Dumps the content of a variable into correct PHP.
 *
 * Attention!
 * Cannot handle objects!
 *
 * Usage:
 * <code>
 * $str = '$variable = ' . dump_variable($variable);
 * </code>
 *
 * @param  mixed
 * @param  int
 * @return string
 */

function dump_variable($data, $indent = 0)
{
    $ind = str_repeat("\t", $indent);
    $str = '';

    switch (gettype($data)) {
        case 'boolean':
            $str .= $data ? 'true' : 'false';
            break;

        case 'integer':
        case 'double':
            $str .= $data;
            break;

        case 'string':
            $str .= "'" . addcslashes($data, '\'\\') . "'";
            break;

        case 'array':
            $str .= "array(\n";

            $t = array();
            foreach ($data as $k => $v) {
                $s = '';
                if (!is_numeric($k)) {
                    $s .= $ind . "\t'" . addcslashes($k, '\'\\') . "' => ";
                }

                $s .= dump_variable($v, $indent + 1);

                $t[] = $s;
            }

            $str .= implode(",\n", $t) . "\n" . $ind . "\t)";
            break;

        default:
            $str .= 'NULL';
    }

    return $str . ($indent ? '' : ';');
}