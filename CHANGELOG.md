
next release 
===================
  * Modify license information
  * Create testsuites, modify travis, remove ant build


v2.4.0 / 2013-08-07 
===================

  * Add tests and refactor paymentprocessor
  * Add composer install to travis.yml
  * Remove not required tests, add autoloading to tests
  * Fixed missing assignment
  * PM-497 : marked deprecated Unittests as todo for upcoming adjustment
  * Improve ant target descriptions
  * Add PHP 5.5 to travis build environment
  * Added missing extra cURL parameters for proxy support.
  * Merge pull request #32 from perusio/master
  * * Coding style usage of single quotes fix.
  * * Better JSON decoding capabilities detection.
  * * Add extra cURL options to the HTTP client constructor.
  * * Minor fixes for testing enabled extensions.
  * fixed _createTransaction
  * Merge changes from "A fix for missing response_code in case of an error." and adjust Unittests
 

v2.3.0 / 2013-07-16
===================

  * PM-421 : improved workflow for direct transactions and improved tests
  * PM-420 : fixed condition
  * PM-420 :changed differentAmount to preAuthAmount and fix logic
  * PM-400 setter added and differentAmount now used
  * PM-389 : updated workflow and added possibility to capture
  * PM-369 :fixed inconsistency of return
  * PM-366 add optional source to transaction


v2.2.3 / 2013-06-27
===================

  * Adjust Test for merge: https://github.com/paymill/paymill-php/pull/27
  * Merge pull request #27 from stoilkov/master
  * PM-332 : fixed issue without using the constructor
  * transmit true http status code when API error occurs
  * PM-332 : Deleted 3DSecure-Fallback and adjust interfacename
  * PM-324 : Added getLastResponse() and ToArray()
  * PM-324 : Better naming, moved PaymentProcessor classes and added namespaces
  * PM-324 : Fixed Logger is'nt optional issue
  * - Deleted Coupons
  * - Implement PaymentProcessor - Improved PaymentProcessor - Added Unittest for PaymentProcessor
  

v2.2.2 / 2013-06-08 
===================

  * Add secure env variable  to travis.yml
  * Added return value
  * Added todo comment to remind of the missing unit tests
  * Added a getResonse() function to the Base class, allowing all child elements to get the last full response as an array.


v2.2.1 / 2013-05-30 
===================

  * Update README.md, trigger Travis CI manually
  * Update README.md, add Travis CI indicator
  * Merge pull request #20 from menthol/master
  * Until PHP 5.5, PHP as no way to force TLS 1.0 certificates.
  * Fixed "Insecure cURL flag" https://github.com/Paymill/Paymill-PHP/issues/15


v2.2.0 / 2013-03-28 
===================

  * Better cleanup of test web hooks
  * Added web hook tests
  * PM-83 PHP Wrapper erweitern für Response Code - done
  * Remove build icon
  * Remove dependency on api.paymill.com
  * Add Webhooks.php


v2.1.1 / 2013-01-24 
===================

  * Fixed payments test expiry year
  * Fixed Preauth inheritence
  * Merge pull request #13 from gazoakley/master
  * First attempt at test script
  * Update require_once()
  * Remove duplicate methods from preauth service
  * Add preauthorization service


v2.1.0 / 2012-11-28 
===================

  * Change default api url to .com domain
  * Improve error reporting on failed curl requests


v2.0.0 / 2012-11-14
===================

  * Update readme for v2
  * Merge v2 and v1 repository


v1.0.0 / 2012-10-23
===================

  * Add travis ci status in README.md
  * Started with travis
