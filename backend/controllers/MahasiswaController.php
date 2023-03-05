<?php

namespace backend\controllers;

use common\models\Mahasiswa;
use common\models\MahasiswaSearch;
use common\models\Prodi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\helpers\ArrayHelper;
//use backend\models\ProdiController;
/**
 * MahasiswaController implements the CRUD actions for Mahasiswa model.
 */
class MahasiswaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Mahasiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MahasiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mahasiswa model.
     * @param int $id_mahasiswa Id Mahasiswa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_mahasiswa)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_mahasiswa),
        ]);
    }

    /**
     * Creates a new Mahasiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Mahasiswa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_mahasiswa' => $model->id_mahasiswa]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mahasiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_mahasiswa Id Mahasiswa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_mahasiswa)
    {
        $model = $this->findModel($id_mahasiswa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_mahasiswa' => $model->id_mahasiswa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mahasiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_mahasiswa Id Mahasiswa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_mahasiswa)
    {
        $this->findModel($id_mahasiswa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mahasiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_mahasiswa Id Mahasiswa
     * @return Mahasiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_mahasiswa)
    {
        if (($model = Mahasiswa::findOne(['id_mahasiswa' => $id_mahasiswa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
