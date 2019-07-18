/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/*browser:true*/
/*global define*/
define(
    [
        'jquery',
        'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-abstract',
        'Magento_Checkout/js/model/full-screen-loader'
    ],
    function ($, Component, fullScreenLoader) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Lyranetwork_Lyra/payment/lyra-gift',
                lyraCcType:  window.checkoutConfig.payment.lyra_gift.availableCcTypes ?
                    window.checkoutConfig.payment.lyra_gift.availableCcTypes[0]['value'] : null
            },

            initObservable: function () {
                this._super().observe('lyraCcType');

                return this;
            },
            
            getData: function () {
                var data = this._super();
                data['additional_data']['lyra_gift_cc_type'] = this.lyraCcType();

                return data;
            },

            showLabel: function () {
                return true;
            }
        });
    }
);
