define([
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'Magento_Ui/js/modal/alert'
], function ($, modalConfirm, modalAlert) {
    return function (config, element) {
        const url = config.url,
            title = config.title,
            content = config.content,
            alert = config.alert,
            enabled = config.enabled,
            toggle = () => {
                $(element).prop('disabled', true)
                new Ajax.Request(
                    url, {
                        method: 'POST',
                        parameters: {
                            'form_key': window.FORM_KEY,
                        },
                        onComplete: (transport) => {
                            if (transport.responseText.isJSON()) {
                                const response = transport.responseText.evalJSON();
                                if (response.success) {
                                    location.reload();
                                    return;
                                }
                            }
                            modalAlert({
                                content: alert
                            });
                            $(element).prop('disabled', false)
                        }
                    }
                );
            };
        $(element).click(function () {
            if (enabled) {
                toggle();
            } else {
                modalConfirm({
                    title: title,
                    content: content,
                    actions: {
                        confirm: toggle,
                        cancel: () => {
                            // Do nothing
                        }
                    }
                });
            }
        });
    }
});
