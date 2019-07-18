/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (Component, rendererList) {
        'use strict';
        rendererList.push(
            {
                type: 'lyra_standard',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-standard'
            },
            {
                type: 'lyra_multi',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-multi'
            },
            {
                type: 'lyra_gift',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-gift'
            },
            {
                type: 'lyra_choozeo',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-choozeo'
            },
            {
                type: 'lyra_fullcb',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-fullcb'
            },
            {
                type: 'lyra_sepa',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-sepa'
            },
            {
                type: 'lyra_paypal',
                component: 'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-paypal'
            }
        );

        /** Add view logic here if needed */
        return Component.extend({});
    }
);