$checksum = new Paymill\Models\Request\Checksum();
$checksum
    ->setChecksumType(\Paymill\Models\Request\Checksum::TYPE_PAYPAL) // Checksum type
    ->setAmount(4200) // e.g. "4200" for 42.00 EUR
    ->setCurrency('EUR') // Alpha-3 country code
    ->setDescription('My transaction description') // Optional
    ->setShippingAddress(array( // Optional - Shipping address
        'name'                    => 'John Doe',
        'street_address'          => 'Example street 1',
        'street_address_addition' => '45 floor', // Optional
        'postal_code'             => '12345', // Optional
        'city'                    => 'Munich',
        'state'                   => 'Bavaria', // Optional
        'country'                 => 'DE',  // Alpha-2 country code
        'phone'                   => '0123 456789' // Optional
    ))
    ->setBillingAddress(array( // Optional - Billing address
        'name'                    => 'John Doe',
        'street_address'          => 'Example street 1',
        'street_address_addition' => '45 floor', // Optional
        'postal_code'             => '12345', // Optional
        'city'                    => 'Munich',
        'state'                   => 'Bavaria', // Optional
        'country'                 => 'DE',  // Alpha-2 country code
        'phone'                   => '0123 456789' // Optional
    ))
    ->setItems(array( // Optional - Shopping cart items
        array(
            'name' => 'Product orange', // Optional
            'description' => 'An orange product', // Optional
            'item_number' => 'PROD1OR', // Optional
            'url' => 'http://www.example.com/orange-product', // Optional
            'amount' => 50, // Price of a single product in cent, e.g. "50" for 0,50 €
            'quantity' => 2
        ),
        array(
            'name' => 'Product blue', // Optional
            'description' => 'A blue product', // Optional
            'item_number' => 'PROD3BL', // Optional
            'url' => 'http://www.example.com/blue-product', // Optional
            'amount' => 70, // Price of a single product in cent, e.g. "50" for 0,50 €
            'quantity' => 1
        )
    ))
    ->setShippingAmount(300) // Optional - Shipping costs in cent, e.g. "50" for 0,50 €
    ->setHandlingAmount(250) // Optional - Other handling costs in cent, e.g. "50" for 0,50 €
    ->setReturnUrl('http://www.example.com/checkout/success') // Required for e.g. PayPal - Valid return URL
    ->setCancelUrl('http://www.example.com/checkout/canceled') // Required for e.g. PayPal - Valid cancel URL
    ->setFeeAmount(420) // Optional - Unite fees in cent, e.g. "50" for 0,50 €
    ->setFeeCurrency('EUR') // Optional - Unite fee currency
    ->setFeePayment('pay_3af44644dd6d25c820a8') // Optional - Unite payment ID
;

$response = $request->create($checksum);
