<?php

namespace Task\Feedback\Model\ResourceModel\Feedback;

use Task\Feedback\Model\Feedback as Feedback;
use Task\Feedback\Model\ResourceModel\Feedback as FeedbackResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Feedback::class, FeedbackResourceModel::class);
    }
}