<?php
namespace common\components;

use Yii;
use yii\base\Component;
use frontend\models\MailQueue;
use frontend\components\HelperBase;
use frontend\components\HelperMandrill;
use yii\helpers\Url;

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
    public static function sendConfirmationLink(\common\models\User $user)
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
     * Send notification to site admin about a new user
     * @param User $model
     * @return bool
     */
    /*private function _notifyAdminAboutNewUser(User $model)
    {
        $siteAdmins = User::model()->getSiteAdmins();
        $mailParams = Utility::getConfig('mailing')['admin_new_user_notification']['en'];
        $subj = $mailParams['subject'];

        $profilePlainLink = str_replace('http://', 'http://dashboard.', Utility::getHomeUrl()) . '/admin/members/view/uid/' . $model->id .'.html';
        $profileHtmlLink = CHtml::link('view', $profilePlainLink);

        $emailPlain = $model->email;
        $emailHtml = CHtml::mailto($emailPlain, $emailPlain);

        // body with plain text
        $msgPlain = str_replace(
            ['{admin_name}', '{user_name}', '{user_email}', '{link}'],
            ['admin', $model->full_name, $emailPlain, $profilePlainLink],
            file_get_contents($mailParams['plain'])
        );

        // body with html text
        $msgHtml = str_replace(
            ['{admin_name}', '{user_name}', '{user_email}', '{link}'],
            ['admin', $model->full_name, $emailHtml, $profileHtmlLink],
            file_get_contents($mailParams['html']));

        foreach ($siteAdmins as $admin) {
            MailQueue::model()->put(
                $admin['email'],
                $admin['full_name'],
                $subj,
                $msgPlain,
                Utility::prepareHtmlEmail($msgHtml, $admin['full_name']),
                [MandrillHelper::$TAG_ADMIN_NOTIFICATION],
                1
            );
        }
        return true;
    }*/
}