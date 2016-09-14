<?php
/**
 * This demonstrates that classnames are case-insensitive in PHP
 * 
 * If you include this file, an error will be generated.
 *
 */
class TwoClass
{
    /**
     * This method returns the current value of $name
     * 
     * @return string $name
     */
    public function showOne()
    {
        return 'ONE';
    }
}

/**
 * This is the second definition
 * 
 */
class twoclass
{
    /**
     * This method returns the current value of $name
     * 
     * @return string $name
     */
    public function showTwo()
    {
        return 'TWO';
    }
}
