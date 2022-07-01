<?php 
namespace Oscar\Checkout\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

class EmailsHelper extends AbstractHelper{

    const TO_EMAIL_FACTURACION = 'ventasit@a0especiales.com';
    const FROM_EMAIL = 'contacto@a0especiales.com';

    protected $transportBuilder;

    protected $inlineTranslation;

    protected $storeManager;


    /**
    * @param \Magento\Framework\App\Helper\Context $context
    * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
    * @param \Magento\Store\Model\StoreManagerInterface $storeManager
    */
    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
    }

    public function sendEmail($template_id, array $vars){
        try{
            $storeId = $this->storeManager->getStore()->getId();

            $this->inlineTranslation->suspend();

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($template_id, $storeScope)
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($vars)
            ->setFrom(['email' => self::FROM_EMAIL, 'name' => 'Facturacion'])
            ->addTo(self::TO_EMAIL_FACTURACION)
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();

        }catch(\Exception $e){
            throw new \Exception($e);
        }
    }
}