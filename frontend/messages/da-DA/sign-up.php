<?php
use frontend\components\HelperBase;

$support = HelperBase::getParam('supportEmail');
return [
    'form.title' => 'Tilmelding',
    'form.from.title' => 'Hvor har du hørt om ONTRIS ?',
    'form.create.account' => 'Opret konto',

    'form.user.country' => 'Land:',
    'form.user.account.type' => 'Kontotype:',
    'form.user.referrer' => 'Hvor har du hørt om ONTRIS ?',
    'form.user.name' => 'Brugernavn:',
    'form.user.email' => 'Email:',
    'form.user.password' => 'Adgangskode:',
    'form.user.password.repeat' => 'Gentag password:',

    'operation_success' => 'Dine data er blevet gemt og bekræftelse link blev sendt til din mail. <br /><br />For at fuldføre handlingen, bedes du tjekke din e-mail for yderligere anvisninger.',
    'operation_failure' => "Desværre under registreringen nogle fejl opstod. Please, prøv igen senere. <br/><br/>Vi sætter pris på det, hvis du informerer vores supportteam <a href='mailto:$support'>$support</a> om dette problem.",

    'sign.up.block.title' => 'Tilmelding',
    'sign.up.block.label.1' => 'Oprettelsen tager et splitsekund. Skulle det vise sig ikke at være noget for din virksomhed alligevel,  kan du blot slette din konto igen.',
    'sign.up.block.create' => 'Opret konto',
    'sign.up.block.text.1' => 'Forudfyldte felter ved de mest gængse registreringer',
    'sign.up.block.text.2' => 'Oversigt over alle virksomhedens registreringer',
    'sign.up.block.text.3' => 'Importering af leverandører',
    'sign.up.block.label.2' => 'Er du <strong>transportør</strong> eller <strong>speditør</strong>, kan du også:',
    'sign.up.block.text.4' => 'Registrere biler',
    'sign.up.block.text.5' => 'Registrere ture og derved få yderligere gods på bilen undervejs eller på hjemturen',
    'sign.up.block.text.6' => 'Profilere dig med antal biler, samt hvad din virksomhed ellers tilbyder',

    'reset.password.title' => 'Glemt adgangskode',
    'reset.password.text' => 'For at nulstille din adgangskode, skal du indtaste din e-mail adresse nedenfor.',
    'reset.password.send' => 'Indsend',
    'reset.password.success' => 'Et nyt kodeord er blevet sendt til din e-mail.',
];
