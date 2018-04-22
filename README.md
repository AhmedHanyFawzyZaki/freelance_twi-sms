<a href="https://www.twilio.com">
  <img src="https://static0.twilio.com/marketing/bundles/marketing/img/logos/wordmark-red.svg" alt="Twilio" width="250" />
</a>

# Numbers Directory

[![Build Status](https://travis-ci.org/TwilioDevEd/employee-directory-laravel.svg?branch=master)](https://travis-ci.org/TwilioDevEd/employee-directory-laravel)

Use Twilio to accept SMS messages and turn them into queries against a database.
These are example functions on how to implement a numbers Directory, where a mobile
phone user can send sms message and an auto reply message will be sent upon receiving the incoming message.

## Deployment

1. First clone this repository to your own server and `cd` into it.

2. Open the .env file and update all the fields whose prefix is "MAIL" with your smtp email information.

3. Configure Twilio to call your webhooks from the following url: https://www.twilio.com/console/phone-numbers/incoming


### How To Demo

1. Navigate to http://yourdomain/home

2. Login using Email: ahmed.hany.fawzy4@gmail.com and password: 123456

3. You can change email address from the settings after login.

4. You can change password by following the forgot password link which appears in the login page.

5. You can manage the numbers directory & default settings after logging.


For Further information or help, please contact me on:
1. ahmed.hany.fawzy@hotmail.com
2. ahmed.hany.fawzy4@gmail.com