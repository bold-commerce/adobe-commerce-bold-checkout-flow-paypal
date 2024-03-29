<?php
declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Block\System\Config\Form\Field;

use Bold\Checkout\Block\System\Config\Form\Field;
use Bold\Checkout\Model\ModuleVersionProvider;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Bold Checkout PayPal Flow version field.
 */
class Version extends Field
{
    protected $unsetScope = true;

    /**
     * @var ModuleVersionProvider
     */
    private $moduleVersionProvider;

    /**
     * @param Context $context
     * @param ModuleVersionProvider $moduleVersionProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        ModuleVersionProvider $moduleVersionProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->moduleVersionProvider = $moduleVersionProvider;
    }

    /**
     * @inheritDoc
     */
    protected function _renderValue(AbstractElement $element)
    {
        $version = $this->moduleVersionProvider->getVersion('Bold_CheckoutFlowPaypal');
        $element->setText($version);

        return parent::_renderValue($element);
    }
}
