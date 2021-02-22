<?php


namespace app\core;

/**
 * Responsible for handling login and register
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{
    public Validation $vld;

    public function __construct()
    {
        $this->vld = new Validation;
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

//            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email'], $this->userModel);
            $data['errors']['emailErr'] = $this->vld->validateEmail($data['email']);

            $data['errors']['passwordErr'] = $this->vld->validatePassword($data['password'], 6, 10);

            $data['errors']['confirmPasswordErr'] = $this->vld->confirmPassword($data['confirmPassword']);
//        var_dump($data);
//            return "Validating form";

            return $this->render('register', $data);
        endif;
    }


}