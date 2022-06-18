<?php


use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\JWT\Error\IdTokenVerificationFailed;

include "config.php";


if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];
    $idTokenString = ' ';
    $oneWeek = new \DateInterval('P7D');
    $cookie_name = 'user_session';


    try {
        $user = $auth->getUserByEmail("$email");
        try {

            $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);

            $_SESSION['try'] = 'Sucesss';

            echo json_encode(array('response' => 0));
            try {
                $idTokenString = $signInResult->idToken();

                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->claims()->get('sub');
                $_SESSION['verified_user_id'] = $uid;
                $_SESSION['idTokenString'] = $idTokenString;

                $user = $auth->getUser($uid);
                try {
                    $sessionCookieString = $auth->createSessionCookie($idTokenString, $oneWeek);
                    $_SESSION['sessionCookieString'] = $sessionCookieString;
                    setcookie($cookie_name, $sessionCookieString, time() + (86400 * 7), "/"); // 86400 = 1 day


                }catch (\Kreait\Firebase\Auth\CreateSessionCookie\FailedToCreateSessionCookie $e){
                    echo json_encode(array('response' => $e->getMessage()));
                }

            } catch (IdTokenVerificationFailed $e) {
                echo json_encode(array('response' => 7));
            }
        } catch (FailedToSignIn $e) {
            echo json_encode(array('response' => $e->getMessage()));
        }


    } catch (InvalidArgumentException $e) {

        echo json_encode(array('response' => $e->getMessage()));

    } catch (UserNotFound) {
        echo json_encode(array('response' => 2));

    }

}




