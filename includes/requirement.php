<?php

class Requirement
{
    private $type;
    private $name;
    private $extra;

    public function __construct($type = '', $name = '', $extra = '')
    {
        $this->setType($type);
        $this->setName($name);
        $this->setExtra($extra);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = strtolower($name);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param mixed $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    public function hasExtra()
    {
        return !empty($this->extra) ? 1 : 0;
    }
}