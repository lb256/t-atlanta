<?php

namespace frontend\models;


use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Author extends ActiveRecord{

    public static function tableName(){
        return 'authors';
    }

    public function rules(){
        return [
            [['fname', 'lname'], 'required'],
            [['fname'], 'string', 'max' => 255, 'min' => 2],
            [['lname'], 'string', 'max' => 255, 'min' => 3],
        ];
    }

    public function attributeLabels(){
        return [
            'fname' => 'Имя',
            'lname' => 'Фамилия',
        ];
    }

    public function getAuthorJournals(){
        return Relation::find()->select('journal_id')->where(['author_id' => $this->id]);
    }

    public function getAuthorJournalsNames(){
        return ArrayHelper::map(Journal::find()->filterWhere(['in', 'id', $this->getAuthorJournals()])->all(), 'id', 'name');
    }

    public function clearRel(){
        Relation::deleteAll(['author_id' => $this->id]);
    }
}
