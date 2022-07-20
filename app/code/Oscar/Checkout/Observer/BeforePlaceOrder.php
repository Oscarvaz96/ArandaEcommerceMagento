<?php
namespace Oscar\Checkout\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteFactory;
use Magento\Checkout\Model\Session;
use Oscar\Logger\Logger\Logger;

class BeforePlaceOrder implements ObserverInterface
{
   
    protected $quoteFactory;

    protected $checkoutSession;

    public function __construct(QuoteFactory $quoteFactory, Session $checkoutSession) {
       
        $this->quoteFactory = $quoteFactory;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();
        $quoteId = $order->getQuoteId();
        $quote  = $this->quoteFactory->create()->load($quoteId);
        if($quote->getFactura() == 1){
            $order->setFactura($quote->getFactura());
            $order->setConstancia($quote->getConstancia());
            $order->getBillingAddress()->setVatId($this->checkoutSession->getRfc());
            $order->getBillingAddress()->setCompany($this->checkoutSession->getRs());

        }
       
    }
} 