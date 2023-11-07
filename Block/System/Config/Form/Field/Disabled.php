<?php
declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Block\System\Config\Form\Field;

use Bold\Checkout\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Read only field.
 */
class Disabled extends Field
{
    protected $unsetScope = true;

    /**
     * @inheritDoc
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setDisabled('disabled');

        return $element->getElementHtml();
    }
}
