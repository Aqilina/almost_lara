<?php


namespace app\core;



// this is a class to validate different inputs and data

class Validation
{
    private $password;
    // private $errors = []
    // checks if server request is post
    // @return boolean


    // check if every array value is empty
    // @return boolean
    public function ifEmptyArr($arr)
    {
        // check if all values of array is empty
        foreach ($arr as $errorValue) {
            if (!empty($errorValue)) {
                return false;
            }
        }
        return true;
    }
    /**
     * validates empty field 1212121
     *
     * @param array $data
     * @param string $field
     * @param string  $fieldDisplayName
     * @return void
     */
    public function ifEmptyFieldWithReference(&$data, $field, $fieldDisplayName)
    {
        $fieldError = $field . 'Err';
        // Validate Name
        if (empty($data[$field])) {
            // empty field
            $data['errors'][$fieldError] = "Please enter Your $fieldDisplayName";
        }
    }

    /**
     * check if given sting is empty returns message if empty.
     *
     * @param string $field
     * @param string $msg
     * @return string
     */
    public function validateEmpty($field, $msg)
    {
        return empty($field) ? $msg : '';
    }

    /**
     * if field is empty we return message, else we return empty string.
     *
     * @param string $field
     * @return string
     */
    public function validateName($field)
    {
        // Validate Name
        if (empty($field)) return "Please enter your Name";

        if (!preg_match("/^[a-z ,.'-]+$/i", $field)) return "Name must only contain Name characters";

        return ''; //falsy
    }

    public function validateEmail($field, &$userModel = null)
    {
        // validate empty
        if (empty($field)) return "Please enter Your Email";

        // check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        if ($userModel !== null) {
            // if email already exists
            if ($userModel->findUserByEmail($field)) return 'Email already taken';
        }

        return '';
    }

    public function validateLoginEmail($field, &$userModel)
    {
        // validate empty
        if (empty($field)) return "Please enter Your Email";

        // check email format
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Please check your email";

        // if email already exists
        if (!$userModel->findUserByEmail($field)) return 'Email not found';

        return '';
    }

    public function validatePassword($passField, $min, $max)
    {
        // validate empty
        if (empty($passField)) return "Please enter a password";

        // save password for later
        $this->password = $passField;

        // if pass length is les then min
        if (strlen($passField) < $min) return "Password must be more than $min characters length";

        // if pass length is more then max
        if (strlen($passField) > $max) return "Password must be less than $max characters length";

        // check password strength
        if (!preg_match("#[0-9]+#", $passField)) return "Password must contain at least one number";

        if (!preg_match("#[a-z]+#", $passField)) return "Password must include at least one letter!";

        if (!preg_match("#[A-Z]+#", $passField)) return "Password must include at least one Capital letter!";

        // if (!preg_match("#\W+#", $passField)) return "Password must include at least one symbol!";

        return '';
    }

    public function confirmPassword($repeatField)
    {
        // validate empty
        if (empty($repeatField)) return "Please repeat a password";

        if (!$this->password) return 'no password saved';

        if ($repeatField !== $this->password) return "Password must match";

        return '';
    }
}
