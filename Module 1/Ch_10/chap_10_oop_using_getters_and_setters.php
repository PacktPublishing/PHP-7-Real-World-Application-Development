<?php
// shows the use of getters and setters

$a = new class() {
    protected $date;    // stored as a DateTime instance
    public function setDate($date)
    {
        if (is_string($date)) {
            $this->date = new DateTime($date);
        } else {
            $this->date = $date;
        }
    }
    public function getDate($asString = FALSE)
    {
        if ($asString) {
            return $this->date->format('Y-m-d H:i:s');
        } else {
            return $this->date;
        }
    }
};

// set date using a string
$a->setDate('2015-01-01');
var_dump($a->getDate());

// retrieves the DateTime instance
var_dump($a->getDate(TRUE));

// set date using a DateTime instance
$a->setDate(new DateTime('now'));
var_dump($a->getDate());

// retrieves the DateTime instance
var_dump($a->getDate(TRUE));
