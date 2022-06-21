<?php
namespace Oscar\Checkout\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteFactory;

class BeforePlaceOrder implements ObserverInterface
{
   
    protected $quoteFactory;

    public function __construct(QuoteFactory $quoteFactory) {
       
        $this->quoteFactory = $quoteFactory;
    }

    public function execute(Observer $observer)
    {
        $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Laminas\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('<<<<<<Entramos al OBSERVER>>>>>>');

        $order = $observer->getOrder();
        $quoteId = $order->getQuoteId();
        $quote  = $this->quoteFactory->create()->load($quoteId);
        $order->setFactura($quote->getFactura());
    }
} 