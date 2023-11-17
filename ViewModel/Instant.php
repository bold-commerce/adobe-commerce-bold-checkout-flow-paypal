<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\ViewModel;

use Bold\Checkout\Block\Onepage\Button;
use Bold\CheckoutFlowPaypal\Model\Config;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * View Model for Instant Checkout button.
 */
class Instant implements ArgumentInterface
{
    const PRODUCT_FORM_SELECTOR = '#product_addtocart_form';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var Repository
     */
    private $assetRepository;

    /**
     * @param Config $config
     * @param StoreManagerInterface $storeManager
     * @param RequestInterface $request
     * @param UrlInterface $url
     * @param Repository $assetRepository
     */
    public function __construct(
        Config                $config,
        StoreManagerInterface $storeManager,
        RequestInterface      $request,
        UrlInterface          $url,
        Repository            $assetRepository
    ) {
        $this->config = $config;
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->url = $url;
        $this->assetRepository = $assetRepository;
    }

    /**
     * Render Instant Checkout button on Product page.
     *
     * @return bool
     * @throws LocalizedException
     */
    public function enabledOnProductPage(): bool
    {
        $websiteId = (int)$this->storeManager->getWebsite()->getId();

        return $this->config->getIsPaypalFlowEnabled($websiteId)
            && $this->config->isProductPageInstantCheckoutEnabled($websiteId);
    }

    /**
     * Get parallel checkout url.
     *
     * @return string
     */
    public function getCheckoutUrl(): string
    {
        return $this->url->getUrl(
            'checkout',
            [
                '_secure' => $this->request->isSecure(),
                Button::KEY_PARALLEL => true,
            ]
        );
    }

    /**
     * Get Product form selector.
     *
     * @return string
     */
    public function getProductFormSelector(): string
    {
        return self::PRODUCT_FORM_SELECTOR;
    }

    /**
     * Get ULR for loader image.
     *
     * @return string
     */
    public function getLoaderIcon(): string
    {
        return $this->assetRepository->getUrl('images/loader-2.gif');
    }
}
