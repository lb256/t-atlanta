<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Relation extends ActiveRecord
{

    public static function tableName(){
        return 'relations';
    }

    public function rules(){
        return [
            [['author_id', 'journal_id'], 'default', 'value' => null],
            [['author_id', 'journal_id'], 'integer'],
        ];
    }

}
