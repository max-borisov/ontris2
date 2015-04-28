<?php
use frontend\components\HelperBase;

$support = HelperBase::getParam('supportEmail');
return array (
    'form.title' => 'Brugere',
	'form.title.user.edit' => 'Rediger bruger',

    'user.email.not.found' => 'Der er ingen bruger med E-mail-adresse.',

    'user.invite.link' => 'Inviter ny bruger',
    'user.invite.title' => 'Inviter ny bruger',
    'user.invite.contact' => 'Kontaktperson:',
    'user.invite.message' => 'Besked:',
	'user.invite.email' => 'Email:',
    'user.invite.send' => 'Send invitation',
    'user.invite.back' => 'Tilbage',
    'user.edit.back' => 'Tilbage',
    'user.invite.admin.icon' => 'Der er tre slags brugere til hver virksomhed. Repræsentanten for virksomheden, der opretter profilen og vil fremgå i databasen som super administrator. Det vil i praksis sige, det kun er ham som kan slette virksomheden igen, ligesom han kan oprette brugere i systemet. Han kan dog oprette med-administratorer.
En administrator i systemet vil blive adviseret om gods, når der registreres gods fra et givent ansvarsområde, samt en notifikation, hvis normal brugere ikke har responderet på en ordre.
Intervallet er 10 minutter for en hastetransport og 30 minutter for en normal transport.',
    'user.edit.profile.back' => 'Tilbage',
    'user.edit.btn' => 'Opdater',
    'user.edit.profile' => 'Opdater profil',
    'user.invite.success' => 'Invitation er blevet sendt.',
    'user.invite.failure' => 'Desværre, dit invitation ikke blevet sendt. Venligst, prøv lidt senere.',
    'user.invite.email.busy' => 'Den angivne e-mail {email} er allerede registerd i systemet. Angiv venligst en anden e-mail-adresse.',
	'user.invite.no.answer' => 'Ubesvarede invitationer',
    'user.inviter.user' => 'Invitationen',

    'user.activation.success' => 'Din konto er aktiveret og du kan nu logge ind:',
    'user.activation.failure' => "Din konto kunfne ikke't blive aktiveret. <br /> <br /> Prøv venligst igen senere eller kontakt med support team <a href='mailto:$support'>$support</a>.",
    'user.reactivate.account.title' => 'Aktiver konto',
    'user.reactivate.account.msg' => 'For at aktivere kontoen, skal du indtaste din e-mailadresse og tryk på send-knappen. <br /> Aktiveringslink vil blive sendt til din e-mail og derefter.',
    'user.reactivate.account.success' => 'Aktiveringslink er blevet sendt til din e-mail.',
    'user.reactivate.account.failure' => "Desværre kunne vi ikke sendt til dig med bekræftelse link. Prøv venligst igen senere. <br /> <br /> Hvis du stadig har priblems, bedes du informere vores supportteam <a href='mailto:$support'>$support</a> om dette problem.",

    'user.edit.success' => 'Bruger info er blevet opdateret.',
    'user.profile.success' => 'Din profil er blevet opdateret.',

    'user.no.basic.data' => 'For at få adgang til siden, skal du besøge og udfylde {link} oplysninger.',
    'link.basic.data' => 'Stamdata',

    'title.user.page' => 'Bruger',
    'form.user.basic.data' => 'Firmanavn:',
    'form.user.update.pass.title' => 'Opdater adgangskode:',
    'form.user.password.current' => 'Nuværende adgangskode:',
    'form.user.password.new' => 'Ny adgangskode:',
    'user.password.forgot' => 'Glemt Password ?',
    'form.user.area' => 'Arbejdsområdet:',

    'user.area.title' => 'Arbejdsområdet',
    'user.area.import' => 'Importer',
    'user.area.export' => 'Eksporter',
    'user.area.add' => '+ Ny land',
    'user.mobile' => 'Telefon:',
    'user.admin' => 'Administrator:',
    'user.news' => 'Nyhedsbrev:',
    'user.phone' => 'Telefon:',
    'user.account.type' => 'Medlemstype:',
    'user.login.time' => 'Sidste log ind:',
    'user.account.update' => 'Sidst opdateret:',
    'msg.invitation.sent' => 'Invitation sendt:',
    'msg.invitation.accepted' => 'Invitation sendt:',
    'msg.account.updated' => 'Konto opdateret:',

    'user.has.cars' => 'Har biler:',
    'user.has.trips' => 'Har ture:',
    'user.has.orders' => 'Har ordrer:',
    'user.has.cargo' => 'Har ladning:',

	'user.link.view' => 'View bruger',
	'user.link.edit' => 'Edit bruger',
	'user.link.remove' => 'Fjerne bruger',
    'user.link.area.remove' => 'Remove area',

    'user.msg.no.inv' => 'Der er ingen brugere relateret til selskabet.',

    'profile.page.title' => 'Profil',
    'profile.page.btn.update' => 'Rediger',
    'profile.view.link' => 'se profil',

    'form.btn.save' => 'Gemme ændringerne',
);
