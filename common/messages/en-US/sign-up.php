<?php
use frontend\components\HelperBase;

$support = HelperBase::getParam('supportEmail');
return [
    'form.title' => 'Sign up',
	'form.create.account' => 'Create account',

    'form.user.country' => 'Country:',
    'form.user.account.type' => 'Account type:',
    'form.user.referrer' => 'How did you know about ONTRIS ?',
    'form.user.name' => 'Username:',
    'form.user.email' => 'Email:',
    'form.user.password' => 'Password:',
    'form.user.password.repeat' => 'Repeat password:',

    'message_success' => 'Your data have been saved and confirmation link was sent to your mail. <br /><br />In order to complete the operation, please check your email for further instructions.',
    'operation_failure' => "Unfortunately during registration some errors occurred. Please, try again later. <br /><br />We appreciate it if you inform our support team <a href='mailto:$support'>$support</a> about this problem.",

    'sign.up.block.title' => 'Sign up',
    'sign.up.block.label.1' => 'Still not a member of ONTRIS ?',
    'sign.up.block.create' => 'Create account',
    'sign.up.block.text.1' => 'ONTRIS makes it possible to offer goods for transportation',
    'sign.up.block.text.2' => 'ONTRIS makes it possible for carriers to enter into a formalized cooperation',
    'sign.up.block.text.3' => 'ONTRIS offers the possibility of registering available capacity based on time and location',
    'sign.up.block.label.2' => 'Er du <strong>transportør</strong> eller <strong>speditør</strong>, kan du også:',
    'sign.up.block.text.4' => 'Registrere biler',
    'sign.up.block.text.5' => 'Registrere ture og derved få yderligere gods på bilen undervejs eller på hjemturen',
    'sign.up.block.text.6' => 'Profilere dig med antal biler, samt hvad din virksomhed ellers tilbyder',

    'reset.password.title' => 'Request password reset',
    'reset.password.text' => '<p>To reset your password, enter your email address below.</p>
<p>An email will be sent to you with a link to reset your password.</p>',
    'reset.password.send' => 'Submit',
    'reset.password.success' => 'A new password has been sent to your email.',
];
