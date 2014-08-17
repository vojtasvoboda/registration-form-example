<?php

/**
 * Class Reservations
 */
class Reservations {

    /** @var \Connection $db */
    private $db;

    /** @var string $table */
    private $table;

    /**
     * Constructor
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection) {
        $this->db = $connection;
        $this->table = 'reservations';
    }

    /**
     * E-mail validation. One e-mail can make only one registration.
     *
     * @param string $email
     *
     * @return bool
     */
    public function checkEmail($email) {
        $exists = $this->db->query('SELECT email FROM ' . $this->table . ' WHERE email = ?', $email)->count();
        return $exists;
    }

    /**
     * Term validation.
     *
     * @param mixed $date
     * @param mixed $time
     *
     * @return bool
     */
    public function isFree($date, $time) {
        $exists = $this->db->query('SELECT date FROM ' . $this->table . ' WHERE date = ? AND time = ?', $date, $time)->count();
        return $exists;
    }

    /**
     * Create new reservation
     *
     * @param $data
     */
    public function create($data) {
        $data['created%sql'] = 'NOW()';
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        unset($data['terms']);
        $this->db->query('INSERT INTO ' . $this->table, $data);
    }

}
