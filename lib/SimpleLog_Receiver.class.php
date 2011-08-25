<?php

/**
 * Catches events and log them in a mysql database
 * 
 * @example SimpleLog_Receiver::trigger('Page View');
 */
Class SimpleLog_Receiver
{

    /**
     * Current Settings
     * @access public
     * @var array
     */
    var $settings = array();


    /**
     * Default settings
     * Not much for now, but it can grow
     * @access private
     * @var array
     */
    var $defaults = array(
        'database_hostname' => null,
        'database_name' => null,
        'database_username' => null,
        'database_password' => null,
    );

    /**
     * @access private
     * @var ressource
     */
    var $db_link;
    
    /*
     * Load configured storage device (mysql right now)
     *
     * @param array $config a configuration array to overload the default settings
     *
     */
    function SimpleLog_Receiver($config = array())
    {
        global $configuration;

        // build settings
        foreach($this->defaults as $key => $value) {
            if (array_key_exists($key, $config) && $config[$key]) {
                $this->settings[$key] = $value;
            } else {
                $this->settings[$key] = $this->defaults[$key];
            }
        }

        // Do we have a database specified?
        if ($this->settings['database_hostname'] == null) {
            
            // detect CodeIgniter so we can use its configuration
            global $CI;
            if (is_object($CI)) {
                
                $CI->load->database();

                // found CI, get db config
                $this->settings['database_hostname'] = $CI->db->hostname;
                $this->settings['database_name']     = $CI->db->database;
                $this->settings['database_username'] = $CI->db->username;
                $this->settings['database_password'] = $CI->db->password;
            }
            

            // you could detect another framework here
            if ($configuration['host']) {
                $this->settings['database_hostname'] = $configuration['host'];
                $this->settings['database_name']     = $configuration['db'];
                $this->settings['database_username'] = $configuration['user'];
                $this->settings['database_password'] = $configuration['pass'];
            }
        }


        // establish a DB connection
        $this->db_link = mysql_connect($this->settings['database_hostname'],
                $this->settings['database_username'],
                $this->settings['database_password']);

        mysql_select_db($this->settings['database_name'], $this->db_link);
    }

    
    /**
     * Get the singleton instance
     * @staticvar SimpleLog_Receiver $SimpleLog_Receiver_instance
     * @return SimpleLog_Receiver
     */
    function &getInstance() {
        //global $SimpleLog_instance;
        static $SimpleLog_Receiver_instance = null;

        if(!$SimpleLog_Receiver_instance) {
            $SimpleLog_Receiver_instance = new SimpleLog_Receiver();
        }

        return $SimpleLog_Receiver_instance;
    }

    
    /**
     * Triggers an event
     * Currently it's just an alias for record, but could eventually call
     * binded functions like in jQuery
     * @param string $event
     * @uses $this->record()
     */
    function trigger($event, $objectId = null, $userId = null, $additionalData = null)
    {
        // record the event
        $this->record($event,  $objectId, $userId, $additionalData);
    }


    /**
     * Record and event to storage (mysql)
     * @param string $event
     * @param int|string|null $objectId
     * @param int|null $userId
     * @param string|array|object|null $additionalData
    */
    function record($event, $objectId = null, $userId = null, $additionalData = null)
    {
        if (is_array($additionalData) || is_object($additionalData)) {
            // json does not exist in php4 :(
            $additionalData = serialize($additionalData);
        }
        
        
        $sql = "INSERT INTO `log`
                (`event`, `date`, `oid`, `uid`, `data`)
                VALUES
                (
                    '". mysql_real_escape_string($event) . "',
                    NOW(),
                    " . (is_null($objectId) ? "NULL" : "'" . intval($objectId) . "'") . ",
                    " . (is_numeric($userId) ? intval($userId) : 'NULL') . ",
                    " . (is_null($additionalData) ? "NULL" : "'" . mysql_real_escape_string($additionalData) . "'") . "
                );
            ";

        if(!mysql_query($sql, $this->db_link)) {
            print mysql_error();
            exit; 
        }
        
    }
}
?>
