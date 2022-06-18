<?php

use Kreait\Firebase\Exception\Auth\RevokedIdToken;

include "config.php";

if (isset($_POST['logout_user'])) {

    if (isset($_SESSION['verified_user_id'])) {

        unset($_COOKIE['user_session']);

        try {

            $auth->revokeRefreshTokens($_SESSION['verified_user_id']);

            $verifiedIdToken = $auth->verifyIdToken($_SESSION['idTokenString'], $checkIfRevoked = true);


        } catch (RevokedIdToken $e) {


            unset($_SESSION['verified_user_id']);
            unset($_SESSION['sessionCookieString']);
            unset($_SESSION['idTokenString']);

            if (isset($_SESSION['expiry_status'])) {

                $_SESSION['status'] = "Sesssion Expired";
            } else {

                $_SESSION['status'] = "Logged out Succesfully";

            }
            $_SESSION ['status'] = "Login to accsess this page ";
            header('Location:login.php');
            echo json_encode(array('response' => 9));
        }


    }
}else{

    if (isset($_SESSION['verified_user_id'])) {

        unset($_COOKIE['user_session']);

        try {

            $auth->revokeRefreshTokens($_SESSION['verified_user_id']);

            $verifiedIdToken = $auth->verifyIdToken($_SESSION['idTokenString'], $checkIfRevoked = true);


        } catch (RevokedIdToken $e) {


            unset($_SESSION['verified_user_id']);
            unset($_SESSION['sessionCookieString']);
            unset($_SESSION['idTokenString']);

            if (isset($_SESSION['expiry_status'])) {

                $_SESSION['status'] = "Sesssion Expired";
            } else {

                $_SESSION['status'] = "Logged out Succesfully";

            }
            $_SESSION ['status'] = "Login to accsess this page ";
            header('Location:login.php');

        }


    }

}
