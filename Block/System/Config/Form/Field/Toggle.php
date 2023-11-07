<?php
declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Block\System\Config\Form\Field;

use Bold\Checkout\Block\System\Config\Form\Field;
use Bold\CheckoutFlowPaypal\Model\Config;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Button;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Toggle PayPal Flow button field.
 */
class Toggle extends Field
{
    protected $unsetScope = true;
    protected $_template = 'Bold_CheckoutFlowPaypal::system/config/form/field/toggle.phtml';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param Config $config
     * @param FormKey $formKey
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        FormKey $formKey,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->formKey = $formKey;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    /**
     * Get button html code.
     *
     * @return string
     * @throws LocalizedException
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(Button::class)
            ->setData(
            [
                'id' => 'paypal_flow_toggle',
                'label' => __($this->getLabel()),
            ]
        );

        return $button->toHtml();
    }

    /**
     * Get button label.
     *
     * @return string
     */
    private function getLabel(): string
    {
        return $this->isEnabled() ? 'Disable' : 'Enable';
    }

    /**
     * Get button link url.
     *
     * @return string
     * @throws LocalizedException
     */
    public function getToggleUrl(): string
    {
        $websiteId = $this->getWebsiteId();

        return $this->getUrl('bold_paypal/toggle', ['website' => $websiteId]);
    }

    /**
     * Is PayPal Flow currently enabled.
     *
     * @return bool
     * @throws LocalizedException
     */
    public function isEnabled(): bool
    {
        $websiteId = $this->getWebsiteId();

        return $this->config->getIsPaypalFlowEnabled($websiteId);
    }

    /**
     * Get website id.
     *
     * @return int
     * @throws LocalizedException
     */
    private function getWebsiteId(): int
    {
        return (int)($this->getRequest()->getParam('website')
            ?? $this->storeManager->getWebsite(true)->getId()
        );
    }
}
