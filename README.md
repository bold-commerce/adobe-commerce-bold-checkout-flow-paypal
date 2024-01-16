# PayPal Checkout Flow

This extension replaces all other Bold-hosted Checkout Flows with the PayPal Checkout Flow.

## Table of Contents

- [Supported features](#supported-features)
- [Constraints](#constraints)
- [Prerequisites](#prerequisites)
  - [Check Bold Checkout Integration version](#check-bold-checkout-integration-version)
    - [Composer](#composer)
    - [Adobe Commerce admin page](#adobe-commerce-admin-page)
  - [Update versions \< 1.1.23](#update-versions--1123)
- [Installation](#installation)
- [Usage and Configuration](#usage-and-configuration)
  - [Enable the PayPal Checkout Flow](#enable-the-paypal-checkout-flow)
    - [(Optional) Configure "Buy Now with PayPal"](#optional-configure-buy-now-with-paypal-on-product-pages)
  - [Verify PayPal Checkout Flow](#verify-paypal-checkout-flow)
  - [Disable the PayPal Checkout Flow](#disable-the-paypal-checkout-flow)
- [Documentation](#documentation)
- [Support](#support)
 
## Supported features

Supported features include:

- PayPal payment options including:
  - [PayPal Smart Payment Buttons](https://developer.paypal.com/docs/checkout/standard/integrate/) (PayPal, Pay Later, credit and debit)
  - Apple Pay
  - “Buy now with PayPal” button for product pages.
- Customization
  - [Custom CSS](/guides/checkout/css)
  - [Lightweight Frontend Experience (LiFE) elements](/guides/checkout/life)
- Discount codes
- Shipping rules
- Tax rules

## Constraints

**CAUTION:** Bold currently supports one Bold-hosted Checkout flow in use at a time. Activating the PayPal Checkout Flow disables any currently enabled Bold-hosted Checkout flows.

The PayPal Checkout Flow extension does not support the following features:

- Advanced credit/debit card configuration
- Buy Online, Pickup In Store (BOPIS) functionality
- Third-party plugins
- Loyalty programs and store credits
- Gift card payments
- Shipping to multiple addresses

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

If your PayPal business account admin requires a phone number from customers, you must also require a phone number in the Bold Checkout and Adobe Commerce admins. Check if your PayPal business account requires phone numbers with the following instructions:

1. In your PayPal business account admin, navigate to **Account Settings**. Click **Website Payments**.
1. Next to **Website Preferences**, click **Update**.
1. View the **Contact telephone number** setting.

If the **Contact telephone number** setting is **On (required field)**, set your Bold Checkout and Adobe store admins to require customer phone numbers at checkout.

**Bold Checkout:**

1. In the Bold Checkout admin, navigate to **Settings** > **General Settings**.
1. In the **Checkout Process** section, toggle the **Phone Number** setting on.
1. Click **Save**.

**Adobe Commerce:**

1. In the Adobe Commerce admin, navigate to **Stores** > **Configuration**.
1. In the **Scope** drop-down menu at the top of the page, select **Main Website**.
   * **Note:** This drop-down is titled **Store View** in Adobe Commerce versions earlier than 2.4.
1. In the left-hand menu of the **Configuration** page, navigate to **Customers** > **Customer Configuration**.
1. Expand the **Name and Address Options** section.
1. Set the **Show Telephone** field to **Required**.
1. Click **Save Config**.
   
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
7. Once the page reloads, **Is PayPal Checkout Flow Enabled?** is set to **Yes**. The flow is successfully enabled for your store.

**NOTE:** The PayPal Checkout Flow uses the `Bold_Checkout` extension's "Dual Checkout" Checkout type. Enabling the PayPal Checkout Flow in the Adobe Commerce admin changes the store's **Bold Checkout Type** to "Dual".

#### (Optional) Configure "Buy now with PayPal" on product pages

The extension allows merchants to add a "buy now" button to products based on product type. (Read more about product types on the [Adobe Commerce Experience League](https://experienceleague.adobe.com/docs/commerce-admin/catalog/products/product-create.html).)

By default, this functionality is enabled but not configured. To configure **Buy now with PayPal** for products, you must select which products show the button.

1. In the **Bold Checkout PayPal Integration** section, ensure **Enable for Product Page** is set to **Yes**.
1. Ensure **Use Default** is not selected for **Enable for Product Types**.
1. Select the desired type of product to show the **Buy now with PayPal** button.
1. Click **Save Config**.

To disabled **Buy now with PayPal** for products, you must set the **Enable for Product Page** field to **No**.

1. In the **Bold Checkout PayPal Integration** section, ensure **Use Default** is not selected for **Enable for Product Page**.
1. In the **Enable for Product Page** field, select **No** in the drop down menu.
1. Click **Save Config**.

### Verify PayPal Checkout Flow

Now that the PayPal Checkout Flow is enabled, verify the extension works by checking out in your store.

1. Navigate to your Adobe Commerce store.
1. Add a product to your cart.
1. Click the cart icon to expand checkout options. Two options display: **Proceed with Checkout** and **Checkout with PayPal**.
1. Click the **Checkout with PayPal** button.
1. Checkout with any of the available options.

### Disable the PayPal Checkout Flow

The **Disable** button allows you to deactivate the PayPal Checkout Flow. 

1. In the Adobe Commerce admin, navigate to **Stores** > **Configuration**.
2. In the **Scope** drop-down menu at the top of the page, select **Main Website**.
  * **Note:** This drop-down is titled **Store View** in Adobe Commerce versions earlier than 2.4.
3. In the left-hand menu of the **Configuration** page, navigate to **Sales** > **Checkout**.
4. Expand the **Bold Checkout PayPal Integration** section.
5. If the **Is PayPal Checkout Flow Enabled?** field is set to **Yes**, click the **Disable** button.
6. Once the page reloads, **Is PayPal Checkout Flow Enabled?** is set to **No**.

**NOTE:** The **Bold Checkout Type** is still set to "Dual" after disabling the PayPal Checkout Flow. Remember to change your Bold Checkout Type to previous settings if necessary.

## Documentation

- [Bold Commerce Developer Documentation - Adobe Commerce](https://developer.boldcommerce.com/guides/platform-integration/adobe-commerce/overview)
- [Bold Commerce Help Center - Adobe Commerce](https://support.boldcommerce.com/hc/en-us/categories/16190946964756-Checkout)

## Support

If you have any questions, reach out to the [Bold Customer Success team](https://support.boldcommerce.com/hc/en-us/requests/new?ticket_form_id=132106).
