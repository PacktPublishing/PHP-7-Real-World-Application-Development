<?php
declare(strict_types=1);
/**
 * This shows more than one class per file
 * 
 * This is not considered a best practice
 *
 */
class Name
{
    
    protected $name = '';
    
    /**
     * This method returns the current value of $name
     * 
     * @return string $name
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    /**
     * This method sets the value of $name
     * 
     * @param string $name
     * @return name $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}

/**
 * This is the second definition
 * 
 * Now the file no longer represents a single logical purpose
 * This makes long term maintenance more difficult
 * Also, the filename no longer matches the class name because there are 2 classes
 * This will mess up autoloading
 *
 */
class Address
{
    
    protected $address = '';
    
    /**
     * This method returns the current value of $address
     * 
     * @return string $address
     */
    public function getAddress() : string
    {
        return $this->address;
    }
    
    /**
     * This method sets the value of $address
     * 
     * @param string $address
     * @return address $this
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }
}
