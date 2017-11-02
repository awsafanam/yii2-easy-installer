<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 09-02-2015
 * Time: 19:16
 */

namespace awsaf\installer\models;

use yii\base\Model;

class MailerForm extends Model
{
    public $host;
    public $username;
    public $password;
    public $password_confirm;
    public $port;
    public $encryption;
    public $useTransport;

    public function rules()
    {
        return [// host
            [['host'], 'string', 'max' => 128],

            // username
            [['username'], 'email'],

            // password
            [['password'], 'string', 'max' => 128],

            // password_confirm
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],

            // port
            [['port'], 'integer'],

            // encryption
            [['encryption'], 'string', 'max' => 128],

            // useTransport
            ['useTransport', 'boolean']
            ];
    }

    public function attributeLabels()
    {
        return ['host' => 'Host', 'username' => 'Email', 'password' => 'Password', 'password_confirm' => 'Password Confirm', 'port' => 'Port', 'encryption' => 'Encryption', 'useTransport' => 'Use Transport'];
    }
}