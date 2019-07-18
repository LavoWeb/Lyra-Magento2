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
        'Lyranetwork_Lyra/js/view/payment/method-renderer/lyra-abstract'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Lyranetwork_Lyra/payment/lyra-multi',
                lyraMultiOption: window.checkoutConfig.payment.lyra_multi.availableOptions ?
                    window.checkoutConfig.payment.lyra_multi.availableOptions[0]['key'] : null,
                lyraCcType: window.checkoutConfig.payment.lyra_multi.availableCcTypes ?
                    window.checkoutConfig.payment.lyra_multi.availableCcTypes[0]['value'] : null
            },

            initObservable: function () {
                this._super();
                this.observe('lyraCcType');
                this.observe('lyraMultiOption');

                return this;
            },

            getData: function () {
                var data = this._super();

                if (this.getEntryMode() == 2) {
                    data['additional_data']['lyra_multi_cc_type'] = this.lyraCcType();
                }

                data['additional_data']['lyra_multi_option'] = this.lyraMultiOption();

                return data;
            },

            showLabel: function () {
                return true;
            },

            getAvailableOptions: function () {
                return window.checkoutConfig.payment.lyra_multi.availableOptions;
            }
        });
    }
);