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
     * Dates
     *
     * @var array
     */
    private $dates = array(
        '2014-07-04' => '4.7.',
        '2014-07-05' => '5.7.',
        '2014-07-06' => '6.7.',
        '2014-07-07' => '7.7.',
        '2014-07-08' => '8.7.',
    );

    /**
     * Times
     *
     * @var array
     */
    private $times = array(
        '09:00:00' => '9:00',
        '12:00:00' => '12:00',
        '15:00:00' => '15:00',
    );

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

    /**
     * Returns available dates for reservation
     *
     * @return array
     */
    public function getDates() {

        // maximum combinations for one date
        $max = $this->getMaxDatesCombination();

        // gets saved terms with count of reservations
        $result = $this->db->query('SELECT COUNT(id) as pocet, date FROM ' . $this->table . ' WHERE 1 GROUP BY date');

        // iterate all rows, but dont modify default dates
        $dates = $this->dates;
        foreach($result as $r) {

            // if some term has maximum count of reservations, remove them
            if ( $r->pocet >= $max ) {
                $termDate = $r->date;
                unset($dates[$termDate->format('Y-m-d')]);
            }

        }

        // return available dates
        return $dates;
    }

    /**
     * Returns available times for reservation
     *
     * @return array
     */
    public function getTimes() {

        // maximum combinations for one time
        $max = $this->getMaxTimesCombination();

        // gets saved times with count of reservations
        $result = $this->db->query('SELECT COUNT(id) as pocet, time FROM ' . $this->table . ' WHERE 1 GROUP BY time');

        // iterate all rows, but dont modify default times
        $times = $this->times;
        foreach($result as $r) {

            // if some time has maximum count of reservations, remove them
            if ( $r->pocet >= $max ) {
                $termTime = $r->time;
                unset($times[$termTime->format('H:i:s')]);
            }

        }

        // returns available times
        return $times;
    }

    /**
     * Returns number of combination for one date
     *
     * @return int
     */
    private function getMaxDatesCombination() {
        return count($this->times) * self::MAX_PERSON_PER_TERM;
    }

    /**
     * Returns number of combination for one time
     *
     * @return int
     */
    private function getMaxTimesCombination() {
        return count($this->dates) * self::MAX_PERSON_PER_TERM;
    }

}
