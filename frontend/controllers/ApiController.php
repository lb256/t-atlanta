<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Relation;
use frontend\models\Journal;
use frontend\models\Author;
use yii\web\Controller;
use yii\helpers\ArrayHelper;


class ApiController extends Controller
{
    public function actionIndex(){
        $answer = '0';
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['id'])){
                $answer = $this->getJournal();
            }else{
                $answer = $this->getAll();
            }
        }elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
            $answer = $this->setJournal();
        }elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $answer = $this->delJournal();
        }

        echo $answer;
    }

    protected function getJournal(){
        $journal = Journal::find()->where(['id' => $_GET['id']])->one();
        if(isset($journal)) {
            return json_encode(ArrayHelper::toArray($journal, ['Journal']), JSON_UNESCAPED_UNICODE);
        }
        return '0';
    }

    protected function getAll(){
        $journals = Journal::find()->all();
        foreach ($journals as $journal){
            $relations = Relation::find()->select('author_id')->where(['journal_id' => $journal->id]);
            $authors = Author::find()->filterWhere(['in', 'id', $relations])->all();
            $journals_arr[] = ['journal' => ArrayHelper::toArray($journal, ['Journal']), 'authors' => ArrayHelper::toArray($authors, ['Author'])];

        }
        return json_encode($journals_arr, JSON_UNESCAPED_UNICODE);
    }

    protected function setJournal(){
        $res = Journal::updateAll(['name' => $_REQUEST['name'], 'desc' => $_REQUEST['desc'], 'production_date' => $_REQUEST['production_date'] ],  ['like', 'id', $_REQUEST['id']]);
        return json_encode('ok');
    }

    protected function delJournal(){
        Journal::deleteAll(['id' => $_REQUEST['id']]);
        Relation::deleteAll(['journal_id' => $_REQUEST['id']]);
        return json_encode('ok');
    }
}