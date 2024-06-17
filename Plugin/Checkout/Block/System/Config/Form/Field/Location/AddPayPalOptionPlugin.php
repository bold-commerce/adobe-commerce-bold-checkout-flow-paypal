<?php
declare(strict_types=1);

namespace Bold\CheckoutFlowPaypal\Plugin\Checkout\Block\System\Config\Form\Field\Location;

use Bold\Checkout\Block\System\Config\Form\Field\Location;

/**
 * Add PayPal-specific Life element options.
 */
class AddPayPalOptionPlugin
{
    /**
     * Add PayPal-specific Life element options.
     *
     * @param Location $subject
     * @param array $result
     * @return array
     */
    public function afterGetSourceOptions(Location $subject, array $result): array
    {
        return array_merge(
            $result,
            [
                [
                    'label' => '(PayPal Checkout Flow only) On the additional information page',
                    'value' => 'paypal_additional_information',
                ],
            ]
        );
    }
}
