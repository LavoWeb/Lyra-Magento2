2.4.1, 2019-07-01:
- Bug fix: wrong WSDL URL since v2.4.0.

2.4.0, 2019-06-17:
- Bug fix: consider UNDER_VERIFICATION as a success status for refund transactions.
- Fix IPN URL CSRF verification for compatibility with Magento 2.3.x versions.
- [embedded] Added payment with embedded fields option using REST API.
- [paypal] Added PayPal submodule.
- Possibility to enable payment by alias.
- Added backend buttons to refuse or accept orders in case of suspected fraud.
- Added backend button to validate payment of pending orders.
- Improve payment in iframe mode display.
- Possibility to not send cart data when not mandatory.
- Send Magento user name and IP to gateway for backend WS operations.
- Added specific error message for chargebacks refund.
- Fix some plugin translations.
- Do not send cart if it contains too much different items (more than 85).

2.3.2, 2018-12-24:
- Bug fix: get the correct means of payment when selection on site is enabled.
- [paypal] Bug fix: error when refunding a PayPal payment.
- Fix new signature algorithm name (HMAC-SHA-256).
- Send Magento phone number as vads\_cell\_phone (required for some payment means).
- Update payment means logos.
- Improve iframe mode interface.
- Save transaction UUID in order payment details.
- Added Spanish translation.
- Improve error message after a failed payment.

2.3.1, 2018-07-06:
- [shatwo] Enable HMAC-SHA-256 signature algorithm by default.
- Ignore spaces at the beginning and the end of certificates on return signature processing.

2.3.0, 2018-05-23:
- Enable signature algorithm selection (SHA-1 or HMAC-SHA-256).
- Improve backend configuration screen.

2.2.0, 2018-03-19:
- Display card brand user choice if any in backend order details.

2.1.4, 2018-03-08:
- Bug fix: Check value type in logo uploader to avoid a PHP warning during import data from configuration files.
- Bug fix: Added the component load order in etc/module.xml to avoid an exception during Magento installation using comand-line interface.
- [technical] Manage enabled/disabled features by plugin variant.