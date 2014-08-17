<?php

/**
 * Class Connection
 */
class Connection extends DibiConnection {

    /**
     * Return connection to database
     */
    public function __construct() {
        $options = array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'kviff',
        );
        parent::__construct($options);
    }

}
