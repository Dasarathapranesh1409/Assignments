<?php
namespace Assess\Tracking\Model\ResourceModel\TrackingProduct;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    

    protected function _construct()
{
    $this->_init(
        \Assess\Tracking\Model\TrackingProduct::class,
        \Assess\Tracking\Model\ResourceModel\TrackingProduct::class
    );
}

}