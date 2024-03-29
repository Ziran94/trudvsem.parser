<?php

namespace app\models;

use Yii;
use function Codeception\Lib\retrieveBaseUrl;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $postIndex
 * @property int $status
 *
 * @property Contacts[] $contacts
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['status'], 'integer'],
            [['code', 'postIndex'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'name' => 'Регион',
            'postIndex' => 'Post Index',
            'status' => '',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::class, ['idRegion' => 'id']);
    }

    public static function getCodes()
    {
        $codes = self::find()->where(["status" => 1])->asArray()->all();
        return array_column($codes, "code");
    }

    public function toggleStatus()
    {
        if ($this->status == 0)
            $this->status = 1;
        else{
            $this->status = 0;
        }
        $this->save();
    }

    public static function getId($code){
        return self::find()->where(["code" => $code])->select("id")->asArray()->one()["id"];
    }
}
