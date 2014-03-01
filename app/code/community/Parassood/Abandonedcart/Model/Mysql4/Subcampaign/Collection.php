<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Parassood
 * @package     Parassood_Abandonedcart
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Parassood_Abandonedcart_Model_Mysql4_Subcampaign_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('parassood_abandonedcart/subcampaign');
    }

    /**
     * Add Store Filter to sub-campaign collection.
     * @param $storeId
     * @return $this
     */
    public function addStoreFilter($storeId)
    {
        $this->addFieldToFilter('main_table.store_id', $storeId);
        return $this;
    }
}




