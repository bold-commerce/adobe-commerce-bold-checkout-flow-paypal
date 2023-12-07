<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Block\System\Config\Form\Field;

use Bold\Checkout\Block\System\Config\Form\Field;
use Bold\CheckoutFlowPaypal\Model\Config as PayPalConfig;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Model\Config;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Bold PayPal Flow status field.
 */
class Status extends Field
{
    protected $unsetScope = true;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var PayPalConfig
     */
    private $payPalConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param Config $config
     * @param PayPalConfig $payPalConfig
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context               $context,
        Config                $config,
        PayPalConfig          $payPalConfig,
        StoreManagerInterface $storeManager,
        array                 $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->payPalConfig = $payPalConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    protected function _renderValue(AbstractElement $element)
    {
        $websiteId = (int)$this->config->getWebsite() ?: (int)$this->storeManager->getWebsite(true)->getId();
        $status = $this->payPalConfig->getIsPaypalFlowEnabled($websiteId);
        $statusText = $status ?  __('PayPal Checkout Flow is enabled') :  __('PayPal Checkout Flow is disabled');
        $class = $status ? 'enabled' : 'disabled';
        $element->setText(
            sprintf('<strong class=\'%s\'>%s</strong>', $class, $statusText)
        );

        return parent::_renderValue($element);
    }
}
