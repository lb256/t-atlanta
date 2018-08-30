<?php

namespace frontend\models;

use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Journal extends ActiveRecord{
    public $upload;
    public $authors;

    public static function tableName(){
        return 'journals';
    }

    public function rules(){
        return [
            [['production_date'], 'safe'],
            [['production_date'],'date', 'format'=>'yyyy-m-d', 'message'=>'Введите правильно: {attribute} (xxxx-xx-xx).'],
            [['name', 'img_file', ], 'string', 'min' => 3],
            [['desc'], 'string'],
            [['upload'], 'file', 'extensions' => 'png, jpg'],
            [['production_date', 'name'], 'required', 'message'=>' не может быть пустым'],
        ];
    }


    public function attributeLabels(){
        return [
          //  'id' => 'ID',
            'name' => 'Название',
            'desc' => 'Описание',
            'img_file' => 'Картинка',
            'authors' => 'Авторы',
            'production_date' => 'Дата выпуска',
            'upload' => 'Картинка',
        ];
    }

    public function getAllAuthors(){
        return  ArrayHelper::map(Author::find()->all(), 'id', function ($model){return $model->fname.' '.$model->lname;});
    }

    public function getJournalAuthors(){
        return Relation::find()->select('author_id')->where(['journal_id' => $this->id]);
    }

    public function getJournalAuthorsArr(){
        return ArrayHelper::map(Relation::find()->where(['journal_id' => $this->id])->all(), 'id','author_id');
    }

    public function getJournalAuthorsNames(){
        return ArrayHelper::map(Author::find()->filterWhere(['in', 'id', $this->getJournalAuthors()])->all(), 'id', function ($model){return $model->fname.' '.$model->lname;});
    }
}
