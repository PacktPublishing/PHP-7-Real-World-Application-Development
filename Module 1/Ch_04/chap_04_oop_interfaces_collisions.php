<?php
// demonstrates naming collisions with multiple interfaces

interface DateAware
{
    public function setDate($date);
    public function setBoth(DateTime $dateTime);
}

interface TimeAware
{
    public function setTime($time);
    // this will cause a problem
    //public function setBoth($date, $time);
    // comment the line above, and uncomment the one below to resolve the problem
    public function setBoth(DateTime $dateTime);
}

class DateTimeHandler implements DateAware, TimeAware
{
    protected $date;
    protected $time;
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setTime($time)
    {
        $this->time = $time;
    }
    public function setBoth(DateTime $dateTime)
    {
        $this->date = $date;
    }
}
    
