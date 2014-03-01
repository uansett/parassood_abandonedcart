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
 **/
class Parassood_Abandonedcart_Model_Cart extends Mage_Core_Model_Abstract
{

    public function getAbandonedCarts($campaignNumber)
    {
        $collection = Mage::getModel('sales/quote')->getCollection();
        // $collection->addAttributeToSelect('customer_email')
        //     ->addAttributeToSelect('customer_firstname');
        $_joinCondition = $collection->getConnection()->quoteInto("ABANDONEDCART.quote_id = main_table.entity_id", array());
        $collection->getSelect()->joinLeft(
            array('ABANDONEDCART' => $collection->getTable('parassood_abandonedcart/checkoutstage')),
            $_joinCondition,
            array()
        );

        $dayLag = 3;
        //$storeIds = $this->_getWebsiteStores($websiteCode);
        //if(!$isTest){
        $collection->getSelect()->where("DATEDIFF(CURDATE(),DATE(main_table.updated_at)) >=" . $dayLag . "");
        // }
        //else
        //{   // on test environments the day lag is actually a minute lag.
        //  $collection->getSelect()->where("-time_to_sec(timediff(main_table.created_at, now())) / 60 +300 <=" . $dayLag .
        //       " AND -time_to_sec(timediff(main_table.created_at, now() )) / 60 +300  >=" . ($dayLag-30));
        //}
        $batchNumber = 0;

        if ($campaignNumber == Parassood_Abandonedcart_Helper_Data::BATCHONE) {
            $collection->getSelect()->where("ABANDONEDCART.campaign_number NULL")
                ->where("WINBACK.is_expired <> 1");
            if ($batchNumber == Deloitte_Cheetahmail_Helper_Winback::BATCHTWO) {
                $collection->getSelect()->columns('first_promo_code', 'WINBACK');
            }
            if ($batchNumber == Deloitte_Cheetahmail_Helper_Winback::BATCHFOUR) {
                $collection->getSelect()->columns('second_promo_code', 'WINBACK');
            }

        }
        if (Mage::helper('deloitte_cheetahmail/winback')->getIsTestEnvironment()) {
            $collection->getSelect()->where("main_table.customer_email like '%winback%' OR main_table.customer_email like '%toms.com%' ");
        }
        $collection->load();
        return $collection;
    }

}