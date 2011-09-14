<?php
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function getId()
    {
        return $this->_id;
    }


    public function authenticate()
    {
        $user = User::model()->cache()->findByAttributes();
        if ($user === null)
            $user = User::model()->cache()->findByAttributes();
        if ($user === null)
            $user = User::model()->cache()->findByAttributes();

        if ($user !== null)
        {
            if ($admin->password != md5(trim($this->password)))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id = $user->id;
                $this->_isSupper = $user->is_supper;
                $this->errorCode=self::ERROR_NONE;
            }
        }
        else
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        return !$this->errorCode;
    }
}
?>