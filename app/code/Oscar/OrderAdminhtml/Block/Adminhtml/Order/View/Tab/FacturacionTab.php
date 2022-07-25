<?php

namespace Oscar\OrderAdminhtml\Block\Adminhtml\Order\View\Tab;

class FacturacionTab extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
   protected $_template = 'order/view/tab/datos_facturacion.phtml';
   /**
    * @var \Magento\Framework\Registry
    */
   private $_coreRegistry;

   /**
    * View constructor.
    * @param \Magento\Backend\Block\Template\Context $context
    * @param \Magento\Framework\Registry $registry
    * @param array $data
    */
   public function __construct(
       \Magento\Backend\Block\Template\Context $context,
       \Magento\Framework\Registry $registry,
       array $data = []
   ) {
       $this->_coreRegistry = $registry;
       parent::__construct($context, $data);
   }

   /**
    * Retrieve order model instance
    * 
    * @return \Magento\Sales\Model\Order
    */
   public function getOrder()
   {
       return $this->_coreRegistry->registry('current_order');
   }
   /**
    * Retrieve order model instance
    *
    * @return int
    *Get current id order
    */
   public function getOrderId()
   {
       return $this->getOrder()->getEntityId();
   }

   /**
    * Retrieve order increment id
    *
    * @return string
    */
   public function getOrderIncrementId()
   {
       return $this->getOrder()->getIncrementId();
   }
   /**
    * Retrieve order fatura
    *
    * @return string
    */
    public function getOrderFactura()
    {
        $factura = $this->getOrder()->getData('factura');
        if($factura == 1){
            return 'Si';
        }
        return 'No';
    }

     /**
    * Retrieve order vat_number
    *
    * @return string
    */
   public function getOrderRFC()
   {
       $billing_address = $this->getOrder()->getBillingAddress();
       $rfc = $billing_address->getVatId();
       return $rfc;
   }

    /**
    * Retrieve order company_id
    *
    * @return string
    */
    public function getOrderCompany()
    {
        $billing_address = $this->getOrder()->getBillingAddress();
        $razon_social = $billing_address->getCompany();
        return $razon_social;
    }

    /**
    * Retrieve constancia file by vat_number
    *
    * @return string
    */
    public function getConstanciaFile()
    {
        $constancia = $this->getOrder()->getData('constancia');
        echo '<a href="'.$constancia.'">Constancia</a>';
    }
   /**
    * {@inheritdoc}
    */
   public function getTabLabel()
   {
       return __('Datos de Facturación');
   }

   /**
    * {@inheritdoc}
    */
   public function getTabTitle()
   {
       return __('Datos de Facturación');
   }

   /**
    * {@inheritdoc}
    */
   public function canShowTab()
   {
       return true;
   }

   /**
    * {@inheritdoc}
    */
   public function isHidden()
   {
       return false;
   }
}