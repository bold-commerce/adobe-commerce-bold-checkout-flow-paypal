<?php

namespace Bold\CheckoutFlowPaypal\Model;

use Bold\Checkout\Api\Http\ClientInterface;

/**
 * Enable/disable PayPal Flow.
 */
class PaypalFlow
{
    private const FLOW_ENABLE_URL = '/checkout/shop/{{shopId}}/flows/%s';
    private const FLOW_DISABLE_URL = '/checkout/shop/{{shopId}}/flows/%s';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param ClientInterface $client
     * @param Config $config
     */
    public function __construct(
        ClientInterface $client,
        Config          $config
    ) {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Toggle PayPal Flow status.
     *
     * @param int $websiteId
     * @return bool
     */
    public function toggle(int $websiteId): bool
    {
        $status = $this->config->getIsPaypalFlowEnabled($websiteId);
        if (!$status) {
            $this->config->setIsInstantForDefault($websiteId);
        }

        return $status ? $this->disable($websiteId) : $this->enable($websiteId);
    }

    /**
     * Disable PayPal Flow.
     *
     * @param int $websiteId
     * @return bool
     */
    private function disable(int $websiteId): bool
    {
        try {
            $flowId = $this->config->getFlowId($websiteId);
            $url = sprintf(self::FLOW_DISABLE_URL, $flowId);
            $response = $this->client->delete($websiteId, $url, []);
            if ($response->getErrors()) {
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
        $this->config->setIsPaypalFlowEnabled($websiteId, false);

        return true;
    }

    /**
     * Enable PayPal Flow.
     *
     * @param int $websiteId
     * @return bool
     */
    private function enable(int $websiteId): bool
    {
        try {
            $flowId = $this->config->getFlowId($websiteId);
            $url = sprintf(self::FLOW_ENABLE_URL, $flowId);
            $response = $this->client->post($websiteId, $url, []);
            if ($response->getErrors()
                || !isset($response->getBody()['data']['flows'][0]['flow_id'])
                || $response->getBody()['data']['flows'][0]['flow_id'] !== $flowId) {
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }

        $this->config->setIsPaypalFlowEnabled($websiteId, true);
        $this->config->setCheckoutTypeParallel($websiteId);

        return true;
    }
}
