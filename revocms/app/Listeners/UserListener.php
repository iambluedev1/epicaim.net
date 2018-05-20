<?php
use RevoCMS\RevoCMS;
use Core\View;
use Core\Translate;

use Mail\Mail;

$rcms = RevoCMS::getInstance();

$rcms->events->listen(\Events\User\UserCreateAccountEvent::class, function($event){
    
    ob_start();
    View::autoRender(false);
    View::translate("emails");
    View::set([
        "username" => $event->getName(), 
        "url" => "https://epicaim.net/confirm/".$event->getToken()."/".md5($event->getEmail())."/".$event->getId()
    ]);
    View::render(["folder" => "_emails", "file" => "confirm_account"]);
    $content = ob_get_clean();

    $translate = new Translate();
    $translate->load(["file" => "emails"]);

    $mail = new Mail();
    $mail->addAddress($event->getEmail(), $event->getName());
    $mail->Subject = $translate->element("confirm_account", "title");
    $mail->msgHTML($content);
    $mail->send();
});

$rcms->events->listen(\Events\User\UserConfirmedEvent::class, function($event){
    ob_start();
    View::autoRender(false);
    View::translate("emails");
    View::set([
        "username" => $event->getName()
    ]);
    View::render(["folder" => "_emails", "file" => "confirmed_account"]);
    $content = ob_get_clean();

    $translate = new Translate();
    $translate->load(["file" => "emails"]);

    $mail = new Mail();
    $mail->addAddress($event->getEmail(), $event->getName());
    $mail->Subject = $translate->element("confirmed_account", "title");
    $mail->msgHTML($content);
    $mail->send();
});

$rcms->events->listen(\Events\User\UserNewPasswordEvent::class, function($event){
    ob_start();
    View::autoRender(false);
    View::translate("emails");
    View::set([
        "username" => $event->getName(), 
        "password" => $event->getPassword()
    ]);
    View::render(["folder" => "_emails", "file" => "lost_password"]);
    $content = ob_get_clean();

    $translate = new Translate();
    $translate->load(["file" => "emails"]);

    $mail = new Mail();
    $mail->addAddress($event->getEmail(), $event->getName());
    $mail->Subject = $translate->element("lost_password", "title");
    $mail->msgHTML($content);
    $mail->send(); 
});

$rcms->events->listen(\Events\Api\RedeemConfirmationEvent::class, function($event){
    ob_start();
    View::autoRender(false);
    View::translate("emails");
    View::set([
        "username" => $event->getName(), 
        "url" => "https://epicaimt.net/confirm/".$event->getToken()."/".md5($event->getEmail())."/".$event->getId()
    ]);
    View::render(["folder" => "_emails", "file" => "confirm_account"]);
    $content = ob_get_clean();

    $translate = new Translate();
    $translate->load(["file" => "emails"]);

    $mail = new Mail();
    $mail->addAddress($event->getEmail(), $event->getName());
    $mail->Subject = $translate->element("confirm_account", "title");
    $mail->msgHTML($content);
    $mail->send();   
});


$rcms->events->listen(\Events\User\UserChangePasswordEvent::class, function($event){
    ob_start();
    View::autoRender(false);
    View::translate("emails");
    View::set([
        "username" => $event->getName()
    ]);
    View::render(["folder" => "_emails", "file" => "change_password"]);
    $content = ob_get_clean();

    $translate = new Translate();
    $translate->load(["file" => "emails"]);

    $mail = new Mail();
    $mail->addAddress($event->getEmail(), $event->getName());
    $mail->Subject = $translate->element("change_password", "title");
    $mail->msgHTML($content);
    $mail->send();   
});
