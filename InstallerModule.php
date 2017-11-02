<?php

namespace awsaf\installer;

use Yii;
/**
 * installer module definition class
 */
class InstallerModule extends \yii\base\Module
{

    public $sqlFile = '';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'awsaf\installer\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if(Yii::$app->params['installed']) {
            return Yii::$app->getResponse()->redirect(['/']);
        }
    }
}
