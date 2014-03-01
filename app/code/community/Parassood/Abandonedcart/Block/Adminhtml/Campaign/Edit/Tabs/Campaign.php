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
class Parassood_Abandonedcart_Block_Adminhtml_Campaign_Edit_Tabs_Campaign extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $helper = Mage::helper('parassood_abandonedcart');
        $this->setForm($form);
        $fieldset = $form->addFieldset('edit_campaign_form', array('legend' => $helper->__('Edit Campaign')));

        $fieldset->addField('campaign_id', 'hidden', array(
            'name' => 'campaign_id',
        ));

        $fieldset->addField('campaign_name', 'text', array(
            'label' => $helper->__('Campaign Name'),
            'name' => 'campaign_name',
            'required' => true,
            'maxlength' => 80,
        ));

        $fieldset->addField('checkout_step', 'select', array(
            'label' => $helper->__('Checkout Step'),
            'name' => 'checkout_step',
            'required' => true,
            'values' => $helper->getCheckoutStageOptions()
        ));

        if (Mage::registry('current_campaign')) {
            $form->setValues(Mage::registry('current_campaign')->getData());
        }

        return parent::_prepareForm();
    }
}