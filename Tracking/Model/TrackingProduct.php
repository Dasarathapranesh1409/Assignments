<?php

namespace Assess\Tracking\Model;

use Magento\Framework\Model\AbstractModel;
use Assess\Tracking\Model\ResourceModel\TrackingProduct as TrackingProductResourceModel; 

class TrackingProduct extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(TrackingProductResourceModel::class); 
    }
}