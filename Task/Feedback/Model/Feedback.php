<?php

namespace Task\Feedback\Model;


use Magento\Framework\Model\AbstractModel;
use Task\Feedback\Model\ResourceModel\Feedback as ResourceModel;

class Feedback extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);

    }

}