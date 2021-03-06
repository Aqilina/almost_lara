<?php


namespace app\core;

use app\model\UserModel;

/**
 * Responsible for handling login and register
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{
    public Validation $vld;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->vld = new Validation;
        $this->userModel = new UserModel();
    }

    public function login(Request $request)
    {
        //have ability to change layout
//        $this->setLayout('auth');

        if ($request->isGet()) :
            $this->setLayout('auth');

            $data = [
                'email' => '',
                'password' => '',
                'errors' => [
                    'emailErr' => '',
                    'passwordErr' => '',
                ]
            ];

            return $this->render('login', $data);
        endif;

//        ---------------------------------------------------------------------------------------------------
        if ($request->isPost()) :
            //PRAVALYTA SU getBody().
            $data = $request->getBody();

            //VALIDACIJA
            $data['errors']['emailErr'] = $this->vld->validateLoginEmail($data['email'], $this->userModel);
            $data['errors']['passwordErr'] = $this->vld->validateEmpty($data['password'], 'Please enter your password');

            //JEI NERA KLAIDU
            if ($this->vld->ifEmptyArr($data['errors'])) {
                // no errors
                // email was found and password was entered
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // create session
                    // password match

                    $this->createUserSession($loggedInUser);
                    $request->redirect('/posts');
                } else {
                    $data['errors']['passwordErr'] = 'Wrong password or email';
                    // load view with errors
                    return $this->render('login', $data);
                }
            }
            endif;
                return $this->render('login', $data);
    }

//------------------------------------------------------------------------------------------------------------------------
    public function register(Request $request)
    {
        if ($request->isGet()) :
            $this->setLayout('auth');

            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr' => '',
                    'emailErr' => '',
                    'passwordErr' => '',
                    'confirmPasswordErr' => '',
                ],
                'currentPage' => 'register'
            ];

            return $this->render('register', $data);
        endif;
//-------------------------------------------------------------------------------------------------
        if ($request->isPost()) :

            //request is post and we need to pull user data
            //PRAVALYTA SU getBody().
            $data = $request->getBody();


            $data['errors']['nameErr'] = $this->vld->validateName($data['name']);

            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);
//            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);

            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 6, 10);

            $data['errors']['confirmPasswordErr'] = $this->vld->confirmPassword($data['confirmPassword']);
//        var_dump($data);
//            return "Validating form";

            // if no errors
            if ($this->vld->ifEmptyArr($data['errors'])) :


                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    // success user added
                    // set flash msg
//                    flash('register_success', 'You have registered successfully');
                    $request->redirect('/login');
                } else {
                    die('Something went wrong in adding user to db');
                }
            endif;
            return $this->render('register', $data);
        endif;
    }

    /**
     * if we have user, we save it data in session
     * @param $userRow
     */
    public function createUserSession($userRow)
    {
        $_SESSION['user_id'] = $userRow->id;
        $_SESSION['user_email'] = $userRow->email;
        $_SESSION['user_name'] = $userRow->name;
    }

    public function logout(Request $request)
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy();

        $request->redirect('/');
    }



}