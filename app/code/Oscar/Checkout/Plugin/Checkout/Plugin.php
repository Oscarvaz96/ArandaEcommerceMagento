<?php
namespace Oscar\Checkout\Plugin\Checkout;

class Plugin
{
    
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    )
    {
        //RFC
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['vat_id']['label'] = 'RFC (Solo si requiere factura)';
        //Razón Social
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['company']['label'] = 'Razón Social (Solo si requiere factura)';
        return $jsLayout;
    }
}
