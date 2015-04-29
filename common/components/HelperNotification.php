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
     * Send activation hash to user's email
     *
     * @param $model Users data
     * @return bool
     */
    public static function sendConfirmationLink(\common\models\User $user)
    {
        /*$mailParams = Utility::getConfig('mailing')['confirm_signup'][Utility::getAppLang()];
        $user = $model->attributes;
        $subj = $mailParams['subject'];
        // confirmation url
        $confUrl = Utility::setDomainLang(Utility::getHomeUrl(), Utility::getAppLang()) . '/users/activate/' . $user['hash'];
        // confirmation link
        $confLink = CHtml::link($confUrl, $confUrl);
        // support email address
        $infoEmailPlain = Utility::getConfig('mailing')['info'];
        // Contact phone
        $infoPhonePlain = Utility::getConfig('contactPhone');

        // Insert plain email footer
        $msgPlain = str_replace(
            '{footer}',
            file_get_contents(dirname($mailParams['plain']) . '/footer_plain.tpl'),
            file_get_contents($mailParams['plain']));

        // body with plain text
        $msgPlain = str_replace(
            ['{user}', '{confUrl}', '{infoEmail}', '{infoPhone}'],
            [$user['full_name'], $confUrl, $infoEmailPlain, $infoPhonePlain], $msgPlain);

        // body with html text
        $msgHtml = str_replace(
            ['{user}', '{confUrl}'],
            [$user['full_name'], $confLink],
            file_get_contents($mailParams['html']));

        // Prepare html email by inserting email body into html template.
        $msgHtml = Utility::prepareHtmlEmail($msgHtml, $model->full_name);*/

        /*return MailQueue::model()->put(
            $user['email'],
            $user['full_name'],
            $subj,
            $msgPlain,
            $msgHtml,
            [MandrillHelper::$TAG_SIGNUP_CONFIRM],
            1
        );*/

        $mailer = Yii::$app->mailer;
        $confirmationUrl = Url::to(['/user/confirmation', 'token' => $user->confirmation_token]);
        /* @var $msg \common\components\mandrill\Message */
        $msg = $mailer->compose(HelperBase::getAppLang() . '/signUpConfirmation', [
            'confirmationUrl' => $confirmationUrl
        ]);
        echo $emailBody = $msg->getHtmlBody();
//        Variable::dump($emailBody);

        /*return MailQueue::add([
            'to_email'  => $user->email,
            'to_name'   => $user->username,
            'subject'   => Yii::t('email-subject', 'signup_confirmation'),
            'message_plain' => 'Hello boy',
            'message_html'  => '<strong>Hello boy</strong>',
            'tags'  => [HelperMandrill::$TAG_SIGNUP_CONFIRMATION],
        ]);*/
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