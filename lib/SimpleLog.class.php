<?php

// getting dependencies
// you may update this path to fit your framework/platform
// require_once 'SimpleLog_Receiver.class.php';


/**
 * Provides a unified API for SimpleLog sub classes
 * 
 * @example SimpleLog:trigger('sale');
 * @example $this->simplelog->trigger('sale') // also available in codeigniter
 */
Class SimpleLog
{
    function SimpleLog()
    {
    }

    /**
     * @uses SimpleLog_Receiver
     * @param string $event
     * @param int|string|null $objectId
     * @param int|null $userId
     * @param string|array|object|null $additionalData
     */
    function trigger($event, $objectId = null, $userId = null, $additionalData = null, $alert = false)
    {
        global $config;
        if (class_exists('Console')) {
            Console::log($event, 'SimpleLog::trigger');
        }
        
        $instance = SimpleLog_Receiver::getInstance();
        $instance->trigger($event, $objectId, $userId, $additionalData);
        
        if ($alert) {
            mail($config['systemEmail'], $event, print_r(array('Object ID' => $objectId, 'User ID' => $userId, 'Additional Data' => $additionalData), 1), 'From: ' . $config['systemEmail']);
        }
    }
}


?>
