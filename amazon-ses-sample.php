<?php


// Replace path_to_sdk_inclusion with the path to the SDK as described in 
// http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html
define('REQUIRED_FILE','vendor/autoload.php'); 
                                                  
// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
define('SENDER', ' intern@mail.api-central.net');           

$email="umesh15109@iiitd.ac.in";
// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
define('RECIPIENT', $email);    

// Specify a configuration set. If you do not want to use a configuration
// set, comment the next line, and line 67.
//define('CONFIGSET','ConfigSet');

// Replace us-west-2 with the AWS Region you're using for Amazon SES.
define('REGION','us-west-2'); 

define('SUBJECT','Amazon SES test (AWS SDK for PHP)');

define('HTMLBODY','<h1>AWS Amazon Simple Email Service Test Email</h1>'.
                  '<p>This email was sent with <a href="https://aws.amazon.com/ses/">'.
                  'Amazon SES</a> using the <a href="https://aws.amazon.com/sdk-for-php/">'.
                  'AWS SDK for PHP</a>.</p>');
define('TEXTBODY','This email was send with Amazon SES using the AWS SDK for PHP.');

define('CHARSET','UTF-8');

require REQUIRED_FILE;

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

$client = SesClient::factory(array(
    'version'=> 'latest',
    'credentials' => array(
        'key'    => 'AKIAILAA5BMHJI4W6KRA',
        'secret' => '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',
    ),     
    'region' => REGION
));

try {
     $result = $client->sendEmail([
    'Destination' => [
        'ToAddresses' => [
            RECIPIENT,
        ],
    ],
    'Message' => [
        'Body' => [
            'Html' => [
                'Charset' => CHARSET,
                'Data' => HTMLBODY,
            ],
			'Text' => [
                'Charset' => CHARSET,
                'Data' => TEXTBODY,
            ],
        ],
        'Subject' => [
            'Charset' => CHARSET,
            'Data' => SUBJECT,
        ],
    ],
    'Source' => SENDER,
    // Comment or remove the following line if you are not using a configuration set
    //'ConfigurationSetName' => CONFIGSET,
]);
     $messageId = $result->get('MessageId');
     echo("Email sent! Message ID: $messageId"."\n");

} catch (SesException $error) {
     echo("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
}

?>