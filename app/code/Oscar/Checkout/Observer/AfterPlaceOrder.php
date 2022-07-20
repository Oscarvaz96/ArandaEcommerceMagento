<?php
namespace Oscar\Checkout\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Oscar\Checkout\Helper\EmailsHelper;
use Oscar\Logger\Logger\Logger;

class AfterPlaceOrder implements ObserverInterface{

    protected $emailsHelper;

    public function __construct(EmailsHelper $emailsHelper){
        $this->emailsHelper = $emailsHelper;
    }

    public function execute(Observer $observer){
    
        $order = $observer->getOrder();
    
        $factura = $order->getFactura();
        //Si require factura
        if($factura == 1){
            try{
                //Billing Address Information
                $billing_address = $order->getBillingAddress();
                $rfc = $billing_address->getVatId();
                $order_id = $order->getIncrementId();
                $company_name = $billing_address->getCompany();
                $name = $billing_address->getFirstname()." ".$billing_address->getLastname();
                $email = $billing_address->getEmail();

                //Email Options
                $template_id = 'requiere_factura';
                $vars = [
                    'customer' =>$name,
                    'email' => $email,
                    'order_id' => $order_id,
                    "company_name" => $company_name,
                    'rfc' => $rfc
                ];
                $this->emailsHelper->sendEmail($template_id,$vars);

            }catch(\Exception $e){
                throw new \Exception($e);
            }
        }
    }

}