<?php
namespace Oscar\HomePage\Block;

class HomeSlider extends \Magento\Framework\View\Element\Template{

    public $images = [];

    protected $fildeDriver;

    protected $directoryList;

    public function __construct(
        array $data = [],
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Filesystem\Driver\File $fileDriver,
        \Magento\Framework\Filesystem\DirectoryList $directoryList
    ){
        parent::__construct($context, $data);
        $this->fildeDriver = $fileDriver;
        $this->directoryList = $directoryList;
    }

    public function readImages(){
       
        $path = $this->directoryList->getPath('media')."/slider/";
        $files = $this->fildeDriver->readDirectory($path);
        $result = array_map(function($element){
            return str_replace("/var/www/html/magento/", "", $element);
        },$files);
        
        return $result;
    }

}