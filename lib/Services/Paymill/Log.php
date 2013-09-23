<?php

class Services_Paymill_Log
{
    /**
     * Magic setter to avoid the use of arrays
     * 
     * @param mixed $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (is_array($value)) {
            throw new Exception('Use primitve datatypes.');
        }
        
        $this->$name = $value;
    }
    
    /**
     * Magic getter to avoid the access of undefined vars
     * @param type $name
     * @return null
     */
    public function __get($name)
    {
        if (isset($this->$name))
        {
            return $this->$name;
        }
        
        return null;
    }
    
    /**
     * Fill the model with the given json data
     * @param string $json
     */
    public function fill($json)
    {
        $data = json_decode($json, true);
        
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
    }
    
    /**
     * To array
     * 
     * @return array
     */
    public function toArray()
    {
        $data = array();
        foreach ($this as $key => $value) {
            $data[$key] = $value;
        }
        
        return $data;
    }
    
    /**
     * To json
     * 
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}