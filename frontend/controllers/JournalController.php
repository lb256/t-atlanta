<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Relation;
use frontend\models\Journal;
use frontend\models\JournalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class JournalController extends Controller{

    public function behaviors(){

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex(){
        $searchModel = new JournalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(){
        $model = new Journal();

        $this->handlePostSave($model, false);

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id){
        $model = $this->findModel($id);
        //$model->author_id_arr = [1,2];
        $this->handlePostSave($model);

       return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id){
        $model = $this->findModel($id);
        $model->delete();
        if(isset($model->img_file)) {
            unlink($model->img_file);
        }

        $this->removeRel($model);
        return $this->redirect(['index']);
    }


    protected function findModel($id){
        if (($model = Journal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('no page...');
    }

    protected function handlePostSave(Journal $model, $update = true){
        if ($model->load(Yii::$app->request->post())) {
            $model->upload = UploadedFile::getInstance($model, 'upload');

            if ($model->validate()) {
                if ($model->upload) {
                    $filePath = 'uploads/'.uniqid().'-'.$model->upload->baseName . '.' . $model->upload->extension;
                    if ($model->upload->saveAs($filePath)) {
                        //нужно удалить старый файл, если это update
                        unlink($model->img_file);
                        $model->img_file = $filePath;
                    }
                }

                if ($model->save(false)) {
                    if($update) {
                        $this->removeRel($model);
                    }
                    //в случае создания записи id журнала еще не создано.
                    $this->addRel($model);

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
    }

    //добавить связи из Post, можно склеить один запрос
    protected function addRel(Journal $jrn){
        $ids = $_POST['Journal']['authors'];
        if($ids){
            foreach ($ids as $author_id) {
                $rel = new Relation();
                $rel->author_id = $author_id;
                $rel->journal_id = $jrn->id;
                $rel->save();
            }
        }
    }

    //удалить все связи перед записью новых
    protected function removeRel(Journal $jrn){
        Relation::deleteAll(['journal_id' => $jrn->id]);
    }

    public function actionValidateForm()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $model = new \frontend\models\Journal();
            if($model->load(Yii::$app->request->post()))
                return \yii\widgets\ActiveForm::validate($model);
        }
        throw new \yii\web\BadRequestHttpException('Bad request!');
    }
}
