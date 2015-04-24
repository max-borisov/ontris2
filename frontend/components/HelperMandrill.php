<?php
namespace frontend\components;

//use frontend\components\HelperBase;

class HelperMandrill
{
//    public static $TAG_PASSWORD_RESET               = 'password-reset';
//    public static $TAG_PASSWORD_RECOVERY            = 'password-recovery';
//    public static $TAG_NOTIFICATION_PASSWORD_UPDATE = 'notification-password-update';
//    public static $TAG_NOTIFICATION_PAGE_UPDATE     = 'notification-page-update';
//    public static $TAG_NOTIFICATION_OFFER_REQUEST   = 'notification-offer-request';
//    public static $TAG_SIGNUP_CONFIRM               = 'signup-confirm';
//    public static $TAG_SEND_INVITATION              = 'send-invitation';
//    public static $TAG_ORDER_NOTIFICATION           = 'order-notification';
//    public static $TAG_PENDING_ORDER_NOTIFICATION   = 'pending-order-notification';
//    public static $TAG_POD_NOTIFICATION             = 'pod-notification';
//    public static $TAG_ADMIN_NOTIFICATION           = 'admin-notification';

    public static $RECIPIENT_STATUS_SENT        = 'sent';
    public static $RECIPIENT_STATUS_QUEUED      = 'queued';
    public static $RECIPIENT_STATUS_SCHEDULED   = 'scheduled';
    public static $RECIPIENT_STATUS_REJECTED    = 'rejected';
    public static $RECIPIENT_STATUS_INVALID     = 'invalid';

    /**
     * Init component for emails
     *
     * @return Mandrill
     */
    public static function init()
    {
        $config = HelperBase::getParam('mandrill');
        $component = new \Mandrill($config['apiKey']);
        $component->debug = $config['debug'];
        return $component;
    }
}