<?php

declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Controller\Adminhtml\Toggle;

use Bold\CheckoutFlowPaypal\Model\PaypalFlow;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Enable/disable PayPal Flow.
 */
class Index extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Bold_Checkout::paypal';

    /**
     * @var PaypalFlow
     */
    private $flow;

    /**
     * @var JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @param Context $context
     * @param PaypalFlow $flow
     * @param JsonFactory $jsonResultFactory
     */
    public function __construct(
        Action\Context        $context,
        PaypalFlow            $flow,
        JsonFactory           $jsonResultFactory
    ) {
        parent::__construct($context);
        $this->flow = $flow;
        $this->jsonResultFactory = $jsonResultFactory;
    }

    /**
     * Enable/disable PayPal Flow.
     *
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $websiteId = (int)$this->getRequest()->getParam('website');
        $flowUpdated = $this->flow->toggle($websiteId);
        $data = ['success' => $flowUpdated];
        $result = $this->jsonResultFactory->create();
        $result->setData($data);

        return $result;
    }
}
