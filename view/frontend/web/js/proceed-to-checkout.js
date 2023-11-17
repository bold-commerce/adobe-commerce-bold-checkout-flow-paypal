define([
    'jquery',
    'Magento_Customer/js/model/authentication-popup',
    'Magento_Customer/js/customer-data'
], function (
    $,
    authenticationPopup,
    customerData
) {
    'use strict';

    return function (config, element) {
        $(element).click(function (event) {
            var cart = customerData.get('cart'),
                customer = customerData.get('customer');
            event.preventDefault();
            event.stopImmediatePropagation();
            if (!customer().firstname && cart().isGuestCheckoutAllowed === false) {
                authenticationPopup.showModal();
                return false;
            }
            $(element).attr('disabled', true);
            const form = $(config.productFormSelector);
            const loader = $('body').loader(
                {
                    icon: config.loaderIcon
                }
            );
            form.submit(() => {
                location.href = config.checkoutUrl
            });
            if (form.validation('isValid')) {
                loader.loader('show');
                form.submit();
            } else {
                $(element).attr('disabled', false);
            }
        });
    };
});
