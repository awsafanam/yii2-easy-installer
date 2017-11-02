<?php
namespace awsaf\installer\models;

use Yii;
use yii\base\Model;

/**
 * GeneralForm holds all required General settings.
 */

class GeneralForm extends Model
{
    public $adminEmail;

    public function rules()
    {
        return [
            ['adminEmail', 'required'],
            ['adminEmail', 'email']
        ];
    }

    public function attributeLabels()
    {
        return ['adminEmail' => 'Admin Email'];
    }
}