<?php
declare(strict_types=1);
/**
 * This is a demonstration class.
 * 
 * The purpose of this class is to get and set a protected property $test
 *
 */
class Test
{
    
    protected $test = 'TEST';
    
    /**
     * This method returns the current value of $test
     * 
     * @return string $test
     */
    public function getTest() : string
    {
        return $this->test;
    }
    
    /**
     * This method sets the value of $test
     * 
     * @param string $test
     * @return Test $this
     */
    public function setTest(string $test)
    {
        $this->test = $test;
        return $this;
    }
}
