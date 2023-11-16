# PayPal Checkout Flow

This extension replaces all other Bold-hosted Checkout Flows with the PayPal Checkout Flow.

## Table of Contents

- [PayPal Checkout Flow](#paypal-checkout-flow)
  - [Table of Contents](#table-of-contents)
  - [Prerequisites](#prerequisites)
    - [Check Bold Checkout Integration version](#check-bold-checkout-integration-version)
      - [Composer](#composer)
      - [Adobe Commerce admin page](#adobe-commerce-admin-page)
    - [Update versions \< 1.1.23](#update-versions--1123)
  - [Installation](#installation)
  - [Usage and Configuration](#usage-and-configuration)
    - [Enable the PayPal Checkout Flow](#enable-the-paypal-checkout-flow)
    - [Disable the PayPal Checkout Flow](#disable-the-paypal-checkout-flow)
  - [Documentation](#documentation)
  - [Support](#support)

## Prerequisites

**Install and configure Bold Checkout on your Adobe Commerce store:**

- [Bold-hosted](https://developer.boldcommerce.com/guides/platform-integration/adobe-commerce/installation)
- [Self-hosted](https://developer.boldcommerce.com/guides/platform-integration/adobe-commerce/self-hosted-checkout)

### Check Bold Checkout Integration version

The Adobe Commerce Bold Checkout Integration extension version must be >= `1.1.23`.

There are two ways to check the extension version: using a Composer command, or through the Adobe Commerce admin page post-installation.

#### Composer

   Run the following command to return your extension version.

   ```
   composer show bold-commerce/module-checkout | grep versions
   ```

#### Adobe Commerce admin page

1. In the Adobe Commerce admin, navigate to **Stores** > **Configuration**.
2. In the **Scope** drop-down menu at the top of the page, select **Main Website**.
  * **Note:** This drop-down is titled **Store View** in Adobe Commerce versions earlier than 2.4.
3. In the left-hand menu of the **Configuration** page, navigate to **Sales** > **Checkout**.
4. Expand the **Bold Checkout Integration** section and find the **Version** field.

### Update versions < 1.1.23

If your version is earlier than `1.1.23`, run the following Composer command:

```
composer require bold-commerce/module-checkout:">=1.1.23"
```

## Installation

Install and enable the extension on your store with the following commands:

1. Install the Bold Checkout Flow PayPal extension:

  ```
  composer require bold-commerce/module-checkout-flow-paypal
  ```

2. Enable the extension:

  ```
  php bin/magento module:enable Bold_CheckoutFlowPaypal
  ```
   
3. Compile and deploy the extension:

  ```
  php bin/magento setup:upgrade
  php bin/magento setup:di:compile
  php bin/magento setup:static-content:deploy -f
  ```

4. Flush the Magento cache before continuing:

  ```
  php bin/magento cache:flush
  ```
   
## Usage and Configuration

### Enable the PayPal Checkout Flow

After installing the extension, enable the PayPal Checkout Flow from your Adobe Commerce admin.

1. In the Adobe Commerce admin, navigate to **Stores** > **Configuration**.
2. In the **Scope** drop-down menu at the top of the page, select **Main Website**.
  * **Note:** This drop-down is titled **Store View** in Adobe Commerce versions earlier than 2.4.
3. In the left-hand menu of the **Configuration** page, navigate to **Sales** > **Checkout**.
4. Expand the **Bold Checkout PayPal Integration** section.
5. If the **Is PayPal Checkout Flow Enabled?** field is set to **No**, click the **Enable** button.
6. Click **OK** in the confirmation pop-up.
7. Once the page reloads, **Is PayPal Checkout Flow Enabled?** is set to **Yes**.
8. Click **Save Config**. The flow is successfully enabled for your store.

**NOTE:** The PayPal Checkout Flow uses the `Bold_Checkout` extension's "Parallel Checkout" Checkout type. Enabling the PayPal Checkout Flow in the Adobe Commerce admin changes the store's **Bold Checkout Type** to "Parallel".

### Disable the PayPal Checkout Flow

The **Disable** button allows you to deactivate the PayPal Checkout Flow. 

1. In the Adobe Commerce admin, navigate to **Stores** > **Configuration**.
2. In the **Scope** drop-down menu at the top of the page, select **Main Website**.
  * **Note:** This drop-down is titled **Store View** in Adobe Commerce versions earlier than 2.4.
3. In the left-hand menu of the **Configuration** page, navigate to **Sales** > **Checkout**.
4. Expand the **Bold Checkout PayPal Integration** section.
5. If the **Is PayPal Checkout Flow Enabled?** field is set to **Yes**, click the **Disable** button.
6. Once the page reloads, **Is PayPal Checkout Flow Enabled?** is set to **No**.
7. Click **Save Config**.

**NOTE:** The **Bold Checkout Type** is still set to "Parallel" after disabling the PayPal Checkout Flow. Remember to change your Bold Checkout Type to previous settings if necessary.

## Documentation

- [Bold Commerce Developer Documentation - Adobe Commerce](https://developer.boldcommerce.com/guides/platform-integration/adobe-commerce/overview)
- [Bold Commerce Help Center - Adobe Commerce](https://support.boldcommerce.com/hc/en-us/categories/16190946964756-Checkout)

## Support

If you have any questions, reach out to the [Bold Customer Success team](https://support.boldcommerce.com/hc/en-us/requests/new?ticket_form_id=132106).
