<?php

namespace awsaf\installer\controllers;

use awsaf\installer\helpers\SystemCheck;
use awsaf\installer\helpers\Configuration;
use awsaf\installer\models\DatabaseForm;
use awsaf\installer\models\GeneralForm;
use awsaf\installer\models\MailerForm;
use Yii;
use yii\web\Controller;
use yii\db\Connection;

/**
 * Default controller for the `installer` module
 *
 * Class DefaultController
 * @package awsaf\installer\controllers
 */
class DefaultController extends Controller
{
    public $layout = 'setup';
    /**
     * Renders the index view for the module
     *
     * (Step 1)
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Prerequisites action checks application requirement using the SystemCheck
     * Library
     *
     * (Step 2)
     */
    public function actionPrerequisites()
    {
        $checks = SystemCheck::getResults();

        $hasError = FALSE;
        foreach ($checks as $check) {
            if ($check['state'] == 'ERROR')
                $hasError = TRUE;
        }

        // Render template
        return $this->render('prerequisites', ['checks' => $checks, 'hasError' => $hasError]);
    }

    /**
     * Set Database config.
     *
     * (Step 3)
     * @return mixed
     */
    public function actionDatabase()
    {
        $success = FALSE;
        $errorMsg = '';

        $form = new DatabaseForm();
        if ($form->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($form);
            }


            if ($form->validate()) {
                $dsn = "mysql:host=" . $form->hostname . ";dbname=" . $form->database;
                // Create Test DB Connection
                Yii::$app->set('db', [
                    'class'    => Connection::className(),
                    'dsn'      => $dsn,
                    'username' => $form->username,
                    'password' => $form->password,
                    'charset'  => 'utf8'
                ]);

                try {
                    Yii::$app->db->open();
                    // Check DB Connection
                    if ($this->checkDbConnection()) {
                        // Write Config
                        $config['class'] = Connection::className();
                        $config['dsn'] = $dsn;
                        $config['username'] = $form->username;
                        $config['password'] = $form->password;
                        $config['charset'] = 'utf8';


                        Configuration::set('db', $config);
                        $name = (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'data.sql');
                        $data = file_get_contents($name);
                        Yii::$app->db->createCommand($data)->execute();

                        $success = TRUE;

                        return $this->redirect(Yii::$app->urlManager->createUrl(['installer/default/mailer']));
                    } else {
                        $errorMsg = 'Incorrect configuration';
                    }
                } catch (Exception $e) {
                    $errorMsg = $e->getMessage();
                }
            }
        }

        return $this->render('database', ['model' => $form, 'success' => $success, 'errorMsg' => $errorMsg]);
    }

    /**
     * Set Mail Config
     *
     * (Step 4)
     *
     * @return mixed
     */
    public function actionMailer()
    {
        $mailer = new MailerForm();

        if ($mailer->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($mailer);
            }
            if(Yii::$app->request->post('submit') == 'skip') {
                // Write Config
                $config['class'] = 'yii\swiftmailer\Mailer';
                $config['useFileTransport'] = true;

                Configuration::set('mail', $config);

                return $this->redirect(Yii::$app->urlManager->createUrl(['installer/default/general']));
            } else {
                if ($mailer->validate()) {
                    if ($mailer->useTransport === '0') $mailer->useTransport = FALSE; else
                        $mailer->useTransport = TRUE;

                    // Write Config
                    $config['class'] = 'yii\swiftmailer\Mailer';
                    $config['useFileTransport'] = $mailer->useTransport;
                    $config['transport']['class'] = 'Swift_SmtpTransport';
                    $config['transport']['host'] = $mailer->host;
                    $config['transport']['username'] = $mailer->username;
                    $config['transport']['password'] = $mailer->password;
                    $config['transport']['port'] = $mailer->port;
                    $config['transport']['encryption'] = $mailer->encryption;

                    Configuration::set('mail', $config);

                    return $this->redirect(Yii::$app->urlManager->createUrl(['installer/default/general']));
//                    return $this->render('welcome');
                }

            }
        }

        return $this->render('mailer', ['model' => $mailer]);
    }
    /**
     * Set General Settings
     *
     * (Step 5)
     * @return array|string|\yii\web\Response
     */
    public function actionGeneral()
    {
        $setting = new GeneralForm();

        if ($setting->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($setting);
            }
            if ($setting->validate()) {
                // Write Config
                $params = $setting->getAttributes();
                $params['installed'] = true;

                Configuration::set('params', $params);

                return $this->render('welcome');
            }
        }

        return $this->render('general', ['model' => $setting]);
    }
    /**
     * The init action imports the database structure & initial data
     */
    public function actionWelcome()
    {
        return $this->render('welcome');
    }

    private function checkDbConnection()
    {
        try {
            Yii::$app->db->isActive;

            return TRUE;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
