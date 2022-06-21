<?php

namespace Oscar\Checkout\Controller\Checkout;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\LayoutFactory;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session;
use Magento\Quote\Model\QuoteRepository;

class saveInQuote extends \Magento\Framework\App\Action\Action {

    protected $resultForwardFactory;
    protected $layoutFactory;
    protected $cart;
    protected $checkoutSession;
    protected $quoteRepository;

    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        LayoutFactory $layoutFactory,
        Cart $cart,
        Session $checkoutSession,
        QuoteRepository $quoteRepository
    ){
        $this->resultForwardFactory = $resultForwardFactory;
        $this->layoutFactory = $layoutFactory;
        $this->cart = $cart;
        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;

        parent::__construct($context);
    }

    public function execute(){
        $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Laminas\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('<<<<<<Entramos al controller>>>>>>');


        $checkVal = $this->getRequest()->getParam('checkVal');
        $logger->info($checkVal);
        $quoteId = $this->checkoutSession->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $quote->setFactura($checkVal);
        $quote->save();
        $logger->info('Salimos del controller');
    }
}