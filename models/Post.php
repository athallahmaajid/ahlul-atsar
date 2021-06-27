<?php

namespace app\models;

class Post extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['picture', 'title', 'content', 'category'], 'required'],
        ];
    }
}