<?php

class Candidate extends useRequirements
{
    public function __construct($name = '', array $arrayList = [])
    {
        parent::__construct($name, $arrayList);
    }

    /**
     * Return wether the candidate possess the given asset type
     *
     * @return boolean
     */
    public function hasAssetType($type = '')
    {
        foreach ($this->getArrayList() as $asset)
        {
            if ($asset->getType() == $type){
                return 1;
            }
        }

        return 0;
    }

    /**
     * Return wether the candidate possess the given asset
     *
     * @return boolean
     */
    public function hasAsset($requirement = '')
    {
        foreach ($this->getArrayList() as $asset)
        {
            if ($asset->getName() == $requirement->getName()){

                if ($requirement->hasExtra()){

                    if ($asset->getExtra() != $requirement->getExtra()) {
                        continue;
                    }
                }

                return 1;
            }
        }

        return 0;
    }

    /**
     * Check if the candidate assets match the requirements
     *
     * @param $requirements
     */
    public function matchRequirements($requirements)
    {
        //If there are no requirements, then return 1
        if (! $requirements){
            return 1;
        }

        $assetsCandidate = $this->getArrayList();
        $nRequirements = count($requirements);
        $nMatchesByType = [];

        foreach ($requirements as $type => $assets)
        {
            //Check first the candidate has the given type as asset
            if (! $this->hasAssetType($type)){
                continue;
            }

            foreach ($assets as $asset){
                if ($this->hasAsset($asset)){

                    if (! isset($nMatchesByType[$asset->getType()])){
                        $nMatchesByType[$asset->getType()] = 0;
                    }

                    $nMatchesByType[$asset->getType()] = 1;
                    break;
                }
            }
        }

        return count($nMatchesByType) >= $nRequirements ? 1 : 0;
    }
}