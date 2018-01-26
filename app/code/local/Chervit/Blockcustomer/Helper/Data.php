<?php

class Chervit_Blockcustomer_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @param $dataOne
     * @param $dataTwo
     * @return int
     */
    public function calculateHours($dataOne, $dataTwo)
    {
        $dateStart = new DateTime($dataOne);
        $dateEnd = new DateTime($dataTwo);
        $diff = $dateEnd->diff($dateStart);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);

        return $hours;
    }
}