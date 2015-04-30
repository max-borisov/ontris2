<?php
namespace common\components;

use Yii;
use yii\base\Component;
use frontend\models\MailQueue;
use frontend\components\HelperBase;
use frontend\components\HelperMandrill;
use yii\helpers\Url;
use common\models\User;

use frontend\components\Variable;

class HelperNotification extends Component
{
    /**
     * Send email with confirmation link
     *
     * @param \common\models\User $user
     * @return bool
     * @throws \yii\base\Exception
     */
    public static function sendConfirmationLink(User $user)
    {
        $mailer = Yii::$app->mailer;
        $confirmationUrl = Url::toRoute(['/user/confirmation', 'token' => $user->confirmation_token], true);
        $message = $mailer->compose(HelperBase::getAppLang() . '/signUpConfirmation', [
            'confirmationUrl' => $confirmationUrl
        ]);
        $emailBody = $message->getHtmlBody();

        return MailQueue::add([
            'to_email'     => $user->email,
            'to_name'      => $user->username,
            'subject'      => Yii::t('email-subject', 'signup_confirmation'),
            'message_html' => $emailBody,
            'tags'         => [HelperMandrill::$TAG_SIGNUP_CONFIRMATION],
            'priority'     => MailQueue::PRIORITY_HIGH,
        ]);
    }

    /**
     * Notify site admins about new users
     *
     * @param User $user New user
     * @return bool
     * @throws \yii\base\Exception
     */
    public static function notifyAdminAboutNewUser(User $user)
    {
        $mailer = Yii::$app->mailer;
        $admins = User::getAdmins();
        $userProfileUrl = HelperBase::getDashboardBaseUrl() . '/admin/members/view/uid/' . $user->id . '.html';
        $message = $mailer->compose('en/notifyAdminAboutNewUser', [
            'userName'       => $user->username,
            'userEmail'      => $user->email,
            'userProfileUrl' => $userProfileUrl,
        ]);
        $emailBody = $message->getHtmlBody();

        foreach ($admins as $admin) {
            MailQueue::add([
                'to_email'     => $admin['email'],
                'to_name'      => $admin['username'],
                'subject'      => Yii::t('email-subject', 'notify_admin_about_new_user'),
                'message_html' => $emailBody,
                'tags'         => [HelperMandrill::$TAG_ADMIN_NOTIFICATION],
                'priority'     => MailQueue::PRIORITY_LOW,
            ]);
        }

        return true;
    }
}