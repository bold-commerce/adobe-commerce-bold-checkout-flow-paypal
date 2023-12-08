<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Model\Config\Backend;

use Magento\Config\Model\ResourceModel\Config\Data;
use Magento\Config\Model\ResourceModel\Config\Data\Collection\Proxy;
use Magento\Framework\App\Cache\Type\Block;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Value;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\PageCache\Model\Cache\Type;

/**
 * Backend model for cache invalidation after PayPal configuration change.
 */
class InvalidateBlockBackend extends Value
{
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        Data $resource,
        Proxy $resourceCollection,
        array $data = []
    ) {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * @inheritDoc
     */
    public function afterSave()
    {
        if ($this->isValueChanged()) {
            $this->cacheTypeList->invalidate(Block::TYPE_IDENTIFIER);
            $this->cacheTypeList->invalidate(Type::TYPE_IDENTIFIER);
        }

        return parent::afterSave();
    }
}
