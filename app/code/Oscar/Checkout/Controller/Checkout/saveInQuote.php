<?php

namespace Oscar\Checkout\Controller\Checkout;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Session;
use Magento\Quote\Model\QuoteRepository;
use Oscar\Logger\Logger\Logger;

class saveInQuote extends \Magento\Framework\App\Action\Action {

    protected $checkoutSession;
    protected $quoteRepository;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        QuoteRepository $quoteRepository
    ){

        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;

        parent::__construct($context);
    }

    public function execute(){

        $post = $this->getRequest()->getPostValue();

        if ( 0 < $_FILES['file']['error'] ) {
            return 'Error: ' . $_FILES['file']['error'];
        }
        else{
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $constancia_path = BP.'/pub/media/constancias/'.$post['rfc'].'.'.$ext;
            $file_path = '/pub/media/constancias/'.$post['rfc'].'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $constancia_path);
        }
       
        $this->checkoutSession->setRfc($post['rfc']); //rfc
        $this->checkoutSession->setRs($post['rs']); //razon social

        $quoteId = $this->checkoutSession->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $quote->setFactura($post['requiereFactura']);
        $quote->setConstancia($file_path);
        $quote->save();

    }
}