<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Model\Config\Source;

use Magento\Bundle\Model\Product\Type as BundleType;
use Magento\Catalog\Model\Product\Type;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType;
use Magento\Downloadable\Model\Product\Type as DownloadableType;
use Magento\GiftCard\Model\Catalog\Product\Type\Giftcard as GiftcardType;
use Magento\GroupedProduct\Model\Product\Type\Grouped as GroupedType;

/**
 * Field source for product type multiselect.
 */
class ProductTypeSource implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    private $additionalProductTypes;

    /**
     * @param array $additionalProductTypes
     */
    public function __construct(array $additionalProductTypes = [])
    {
        $this->additionalProductTypes = $additionalProductTypes;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $result = [
            ['value' => Type::TYPE_SIMPLE, 'label' => __('Simple Products')],
            ['value' => Type::TYPE_VIRTUAL, 'label' => __('Virtual Products')],
            ['value' => DownloadableType::TYPE_DOWNLOADABLE, 'label' => __('Downloadable Products')],
            ['value' => GroupedType::TYPE_CODE, 'label' => __('Grouped Products')],
            ['value' => ConfigurableType::TYPE_CODE, 'label' => __('Configurable Products')],
            ['value' => BundleType::TYPE_CODE, 'label' => __('Bundle Products')],
        ];
        if (class_exists(GiftcardType::class)) {
            $result[] = ['value' => GiftcardType::TYPE_GIFTCARD, 'label' => __('Gift Cards')];
        }
        foreach ($this->additionalProductTypes as $typeValue => $typeLabel) {
            $result[] = ['value' => $typeValue, 'label' => __($typeLabel)];
        }

        return $result;
    }
}
