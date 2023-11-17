<?php
declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Model;

use Bold\Checkout\Api\ConfigManagementInterface;
use Bold\Checkout\Model\ConfigInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\ScopeInterface;

/**
 * PayPal Flow config model.
 */
class Config
{
    private const PATH_TYPE = 'checkout/bold_checkout_base/type';
    private const PATH_IS_PAYPAL_FLOW_ENABLED = 'checkout/bold_checkout_paypal/is_enabled';
    private const PATH_IS_INSTANT_ON_PRODUCT_PAGE_ENABLED = 'checkout/bold_checkout_paypal/is_instant_product';
    private const PATH_PAYPAL_FLOW_ID = 'checkout/bold_checkout_paypal/flow_id';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var ConfigManagementInterface
     */
    private $configManagement;

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * @var TypeListInterface
     */
    private $cacheTypeList;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param ConfigManagementInterface $configManagement
     * @param WriterInterface $configWriter
     * @param TypeListInterface $cacheTypeList
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ConfigManagementInterface $configManagement,
        WriterInterface $configWriter,
        TypeListInterface $cacheTypeList
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configManagement = $configManagement;
        $this->configWriter = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
    }

    /**
     * Get is PayPal Flow enabled.
     *
     * @param int $websiteId
     * @return bool
     * @throws LocalizedException
     */
    public function getIsPaypalFlowEnabled(int $websiteId): bool {
        return $this->configManagement->isSetFlag(
            self::PATH_IS_PAYPAL_FLOW_ENABLED,
            $websiteId
        );
    }

    /**
     * Set is PayPal Flow enabled.
     *
     * @param int $websiteId
     * @param bool $isEnabled
     * @return void
     */
    public function setIsPaypalFlowEnabled(int $websiteId, bool $isEnabled): void
    {
        $this->configWriter->save(
            self::PATH_IS_PAYPAL_FLOW_ENABLED,
            (int)$isEnabled,
            $websiteId ? ScopeInterface::SCOPE_WEBSITES : ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            $websiteId
        );
        $this->cacheTypeList->cleanType('config');
        $this->scopeConfig->clean();
    }

    /**
     * Get PayPal Flow flow_id.
     *
     * @param int $websiteId
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFlowId(int $websiteId): string
    {
        return $this->configManagement->getValue(
            self::PATH_PAYPAL_FLOW_ID,
            $websiteId
        );
    }

    /**
     * Set Bold Checkout type to "Parallel".
     *
     * @param int $websiteId
     * @return void
     */
    public function setCheckoutTypeParallel(int $websiteId): void
    {
        $this->configWriter->save(
            self::PATH_TYPE,
            ConfigInterface::VALUE_TYPE_PARALLEL,
            $websiteId ? ScopeInterface::SCOPE_WEBSITES : ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            $websiteId
        );
        $this->cacheTypeList->cleanType('config');
        $this->scopeConfig->clean();
    }

    /**
     * Get if the Instant Checkout button is enabled on Product page.
     *
     * @param int $websiteId
     * @return bool
     * @throws LocalizedException
     */
    public function isProductPageInstantCheckoutEnabled(int $websiteId): bool {
        return $this->configManagement->isSetFlag(
            self::PATH_IS_INSTANT_ON_PRODUCT_PAGE_ENABLED,
            $websiteId
        );
    }
}
