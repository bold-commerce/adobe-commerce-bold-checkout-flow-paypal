<?php

namespace Bold\CheckoutFlowPaypal\Plugin\Checkout\Model\InitOrderFromQuote;

use Bold\Checkout\Model\Order\InitOrderFromQuote;
use Bold\CheckoutFlowPaypal\Model\Config;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Api\Data\CartInterface;

/**
 * Update flow_id to use PayPal flow if functionality enabled.
 */
class UpdateFlowPlugin
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * Update flow_id to use PayPal flow if functionality enabled.
     *
     * @param InitOrderFromQuote $subject
     * @param CartInterface $quote
     * @param string|null $flowId
     * @return array
     * @throws LocalizedException
     */
    public function beforeInit(InitOrderFromQuote $subject, CartInterface $quote, string $flowId = null): array
    {
        $websiteId = (int)$quote->getStore()->getWebsiteId();
        if ($this->config->getIsPaypalFlowEnabled($websiteId)) {
            $flowId = $this->config->getFlowId($websiteId);
        }

        return $flowId ? [$quote, $flowId] : [$quote];
    }
}
