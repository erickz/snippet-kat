<?php

class useRequirements
{
    private $name;
    private $arrayList;

    public function __construct($name = '', $arrayList = [])
    {
        $this->setName($name);
        $this->setArrayList($arrayList);
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
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getArrayList($organizeArray = FALSE)
    {
        if ($organizeArray){
            return $this->organizeRequirementsByKey();
        }

        return $this->arrayList;
    }

    /**
     * @param mixed $requirements
     */
    public function setArrayList($arrayList)
    {
        foreach ($arrayList as $asset)
        {
            $this->arrayList[] = new Requirement($asset['type'], $asset['name'], isset($asset['extra']) ? $asset['extra'] : '');
        }

        $this->organizeRequirementsByKey();
    }

    /**
     *
     * @return Array
     */
    public function organizeRequirementsByKey()
    {
        $organizedRequirements = [];

        $requirements = $this->getArrayList();

        if (! $requirements){
            return [];
        }

        foreach ($requirements as $require)
        {
            if (! isset($organizedRequirements[$require->getType()])){
                $organizedRequirements[$require->getType()] = [];
            }

            $organizedRequirements[$require->getType()][] = $require;
        }

        return $organizedRequirements;
    }
}