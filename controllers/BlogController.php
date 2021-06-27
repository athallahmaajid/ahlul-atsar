<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use Yii;
use yii\data\SqlDataProvider;
use app\models\Post;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $posts = Yii::$app->db->createCommand('SELECT * FROM post')->queryAll();
        $data = new SqlDataProvider([
            'sql' => "SELECT * FROM post",
            "pagination" => [
                'pageSize' => 15
            ]
        ]);
        $models = $data->getModels();

        return $this->render('index', [
            'model' => $models,
            'pagination' => $data->pagination,
            'posts' => $posts
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render("login", [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
            $model = new Post();
            $error = "";
            var_dump(Yii::$app->request->post());
            if ($model->load(Yii::$app->request->post())) {
                if (!empty($_FILES['Post']['tmp_name']['picture'])) {
                    $file = UploadedFile::getInstance($model, 'picture');
                    $fp = fopen($file->tempName, 'r');
                    $content = fread($fp, filesize($file->tempName));
                    fclose($fp);
                    $model->picture = $content;
                }
                $model->author_id = Yii::$app->user->id;
                if ($model->validate() && isset($model->picture)) {
                    $model->save();
                    return $this->goHome();
                } else {
                    $error = "ada kesalahan disaat membuat post";
                }
            }
            return $this->render("create", [
                'model' => $model,
                'error' => $error
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDetail($id)
    {
        $data = new SqlDataProvider([
            'sql' => "SELECT * FROM post WHERE id=:id",
            "params" => [":id" => $id]
        ]);
        $models = $data->getModels();
        return $this->render("detail", [
            'items' => $models[0]
        ]);
    }
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTopik($topik)
    {
        $data = new SqlDataProvider([
            'sql' => "SELECT * FROM post WHERE category=:topik",
            'params' => ['topik' => $topik],
            'pagination' => [
                'pageSize' => 15
            ]
        ]);
        $models = $data->getModels();

        return $this->render('topik', [
            'model' => $models,
            'topik' => $topik
        ]);
    }

    public function actionEdit($id)
    {
        if (Yii::$app->user->isGuest) {
            $this->goHome();
        } else {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                if (!empty($_FILES['Post']['tmp_name']['picture'])) {
                    $file = UploadedFile::getInstance($model, 'picture');
                    $fp = fopen($file->tempName, 'r');
                    $content = fread($fp, filesize($file->tempName));
                    fclose($fp);
                    $model->picture = $content;
                }
                if ($model->save()) {
                    return $this->redirect(['detail', 'id' => $model->id]);
                } else {
                    $error = "ada kesalahan saat menambahkan data";
                }
            }
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->goHome();
    }
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
