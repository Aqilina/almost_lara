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

    public function login()
    {
        //have ability to change layout
//        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isGet()) :
            $this->setLayout('auth');

            $data = [
                'name'      => '',
                'email'     => '',
                'password'  => '',
                'confirmPassword' => '',
                'errors' => [
                    'nameErr'      => '',
                    'emailErr'     => '',
                    'passwordErr'  => '',
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


}