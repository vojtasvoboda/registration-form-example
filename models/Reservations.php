<?php

/**
 * Class Reservations
 */
class Reservations {

    /** max amout of reservations for one term (one time within one date) */
    const MAX_PERSON_PER_TERM = 2;

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
        $exists = $this->db->query('SELECT id FROM ' . $this->table . ' WHERE email = ?', $email)->count();
        return $exists == 0;
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
        $count = $this->db->query('SELECT id FROM ' . $this->table . ' WHERE date = ? AND time = ?', $date, $time)->count();
        return $count < self::MAX_PERSON_PER_TERM;
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
