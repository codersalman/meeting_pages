<?php

include "config.php";
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\FailedToVerifySessionCookie;



if(isset($_COOKIE['user_session'])) {

    if (isset( $_SESSION['idTokenString'])) {
        try {

            $sessionCookieString = $_COOKIE['user_session'];
            $idTokenString = $_SESSION['idTokenString'];

            try {
                $verifiedSessionCookie = $auth->verifySessionCookie($sessionCookieString);

                try {
                    $verifiedIdToken = $auth->verifyIdToken($idTokenString);

                } catch (\Lcobucci\JWT\Token\InvalidTokenStructure) {

                    $_SESSION ['expiry_status'] = "Token Expired/Invalid. Login again";
                    exit();

                } catch (InvalidArgumentException $e) {

                    echo 'The token could not be parsed: ' . $e->getMessage();

                    $_SESSION ['expiry_status'] = "Token Expired/Invalid. Login again";
                    exit();
                }

            } catch (FailedToVerifySessionCookie $e) {
                $_SESSION ['expiry_status'] = "User Session Expired/Invalid. Login again";
                header('Location:logout.php');
                exit();
            }
        } catch (Exception) {
            $_SESSION ['expiry_status'] = "User Session Expired/Invalid. Login again";
            header('Location:logout.php');
            exit();

        }
    }else{

        $_SESSION ['status'] = "Login to accsess this page ";
        header('Location:login.php');
        exit();

    }

}