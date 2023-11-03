<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Plugin\Checkout\Model\GetParallelCheckoutTemplate;

use Bold\Checkout\Model\GetParallelCheckoutTemplate;
use Bold\CheckoutFlowPaypal\Model\Config;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Replace the standard parallel checkout button with the PayPal-branded one.
 */
class PaypalTemplatePlugin
{
    private const PAYPAL_CHECKOUT_TEMPLATE = 'Bold_CheckoutFlowPaypal::cart/paypal_button.phtml';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Config $config
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Config                $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
    }

    /**
     * Replace the standard parallel checkout button with the PayPal-branded one.
     *
     * @param GetParallelCheckoutTemplate $subject
     * @param callable $proceed
     * @return string
     * @throws LocalizedException
     */
    public function aroundGetTemplate(GetParallelCheckoutTemplate $subject, callable $proceed)
    {
        $websiteId = (int)$this->storeManager->getWebsite()->getId();

        return $this->config->isPaypalFlowEnabled($websiteId)
            ? self::PAYPAL_CHECKOUT_TEMPLATE
            : $proceed();
    }
}
