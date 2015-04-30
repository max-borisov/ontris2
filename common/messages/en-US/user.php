<?php
use frontend\components\HelperBase;

$support = HelperBase::getParam('supportEmail');
return [
    'form.title' => 'Users',
	'form.title.user.edit' => 'Edit user',

    'user.email.not.found' => 'There is no user with given email address.',

    'user.invite.link' => 'Invite a new user',
    'user.invite.title' => 'Invite a new user',
    'user.invite.contact' => 'Contact:',
    'user.invite.message' => 'Message:',
    'user.invite.email' => 'Email:',
    'user.invite.send' => 'Send invitation',
    'user.invite.back' => 'Back to users',
    'user.invite.admin.icon' => 'There are three types of users for each company. The representative of the company that set up the profile and will appear in the database as a super administrator. In practice, this means only he can erase the company again, and he can create users in the system. He can, however, create the Administrators.
An administrator of the system will be advised of the goods after the goods is recorded from a given area of ​​responsibility, as well as a notification if normal users have not responded to an order.
The interval is 10 minutes for an accelerated transport and 30 minutes for normal transport.',
    'user.edit.back' => 'Back to users',
    'user.edit.profile.back' => 'Back',
    'user.edit.btn' => 'Update user',
    'user.edit.profile' => 'Update profile',
    'user.invite.success' => 'Invitation has been sent.',
    'user.invite.failure' => 'Sorry, your invitation haven\'t been sent. Please, try a bit later.',
    'user.invite.email.busy' => 'The specified email {email} has already been registered in the system. Please, specify another email address.',
    'user.invite.no.answer' => 'Unanswered invitations',
    'user.inviter.user' => 'Inviter',

    'email.confirmation.success' => 'Your account has been activated.<br /><br />Now you are able to login into system.',
    'email.confirmation.error' => "Your account couldn't be activated.<br /><br />Please try again later or contact with support team <a href='mailto:$support'>$support</a>.",
    'user.reactivate.account.title' => 'Activate account',
    'user.reactivate.account.msg' => 'In order to activate account, please enter your email address and press submit button.<br />The activation link will be send to your email then.',
    'user.reactivate.account.success' => 'Activation link has been sent to your email.',
    'user.reactivate.account.failure' => "Unfortunately we could not sent to you email with confirmation link. Please, try again later. <br /><br />If you still having priblems, please inform our support team <a href='mailto:$support'>$support</a> about this problem.",

    'user.edit.success' => 'User info has been updated.',
    'user.profile.success' => 'Your profile has been updated.',

    'user.no.basic.data' => 'In order to get access to the page, please, visit and fill in {link} information.',
    'link.basic.data' => 'Basic data',

    'title.user.page' => 'User',
    'form.user.basic.data' => 'Company:',
    'form.user.update.pass.title' => 'Update password:',
    'form.user.password.current' => 'Current password:',
    'form.user.password.new' => 'New password:',
    'user.password.forgot' => 'Forgot Password ?',
    'form.user.area' => 'Working area:',

    'user.area.title' => 'Working area',
    'user.area.import' => 'Import',
    'user.area.export' => 'Export',
    'user.area.add' => '+ New country',
    'user.mobile' => 'Mobile:',
    'user.admin' => 'Administrator:',
    'user.news' => 'Newsletter:',
    'user.phone' => 'Phone:',
    'user.account.type' => 'Account type:',
    'user.login.time' => 'Last login time:',
    'user.account.update' => 'Last update:',
    'msg.invitation.sent' => 'Invitation sent:',
    'msg.invitation.accepted' => 'Invitation accepted:',
    'msg.account.updated' => 'Account updated:',

    'user.has.cars' => 'Has cars:',
    'user.has.trips' => 'Has trips:',
    'user.has.orders' => 'Has orders:',
    'user.has.cargo' => 'Has cargo:',

	'user.link.view' => 'View user',
	'user.link.edit' => 'Edit user',
	'user.link.remove' => 'Remove user',
	'user.link.area.remove' => 'Remove area',

    'user.msg.no.inv' => 'There are no users related to the company.',

    'profile.page.title' => 'Profile',
    'profile.page.btn.update' => 'Update',
    'profile.view.link' => 'view profile',

    'form.btn.save' => 'Save the changes',
];
