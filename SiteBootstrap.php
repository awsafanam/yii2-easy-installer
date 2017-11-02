<?php
namespace awsaf\installer;

use Yii;
use yii\base\Component;

/**
 * Check If site needs installation.
 *
 * Class SiteBootstrap
 * @package awsaf\installer
 */
class SiteBootstrap extends Component {
    public function init() {
        parent::init();

        if(Yii::$app->params['installed']) {
        } else {
            if(strpos($_SERVER['REQUEST_URI'], 'installer') === false){
                Yii::$app->getResponse()->redirect(['installer/default/index']);
            }
        }
    }
}