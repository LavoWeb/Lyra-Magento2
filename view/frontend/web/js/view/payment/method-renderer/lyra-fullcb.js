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
                template: 'Lyranetwork_Lyra/payment/lyra-fullcb',
                lyraFullcbOption: window.checkoutConfig.payment.lyra_fullcb.availableOptions ?
                    window.checkoutConfig.payment.lyra_fullcb.availableOptions[0]['key'] : null
            },

            initObservable: function () {
                this._super().observe('lyraFullcbOption');
                return this;
            },

            getData: function () {
                var data = this._super();
                data['additional_data']['lyra_fullcb_option'] = this.lyraFullcbOption();

                return data;
            },

            getAvailableOptions: function () {
                return window.checkoutConfig.payment.lyra_fullcb.availableOptions;
            }
        });
    }
);