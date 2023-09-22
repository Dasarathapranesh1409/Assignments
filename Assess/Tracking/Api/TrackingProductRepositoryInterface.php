<?php
namespace Assess\Tracking\Api;

interface TrackingProductRepositoryInterface
{
   /**
     * @param int|null $pageId
     * @return \Assess\Tracking\Api\ProductDataInterface[]
     */
    public function getApiData(int $pageId = null);


   /**
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     *  @return \Assess\Tracking\Api\ProductDataInterface[]
     */
    public function save(string $sku, int $quoteId, int $customerId = null);


  /**
     * @param int $id
     * @return \Assess\Tracking\Api\ProductDataInterface[]
     */
    public function getById(int $id);

     /**
     * @param string $id
     * @param string $sku
     * @param int $quoteId
     * @param int $customerId
     * @return \Assess\Tracking\Api\ProductDataInterface[]
     */
    public function update(int $id, string $sku, int $quoteId, int $customerId = null);

  /**
     * @param string $id
     * @return \Assess\Tracking\Api\ProductDataInterface[]
     */

    public function delete(int $id);
}