<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property string $id
 * @property string $idResume
 * @property string $fio
 * @property int|null $age
 * @property int|null $salary
 * @property string|null $positionName
 * @property string|null $phone
 * @property string|null $email
 * @property int $idRegion
 * @property int $firstPublishedDate
 * @property int $publishedDate
 * @property string $genderType
 * @property string $demands
 * @property int $status
 *
 * @property Regions $idRegion0
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idResume', 'fio', 'idRegion'], 'required'],
            [['age', 'salary', 'idRegion', 'firstPublishedDate', 'publishedDate', 'status'], 'integer'],
            [['demands'], 'string'],
            [['id', 'idResume', 'fio', 'positionName'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 100],
            [['genderType'], 'string', 'max' => 10],
            [['id'], 'unique'],
            [['idRegion'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['idRegion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idResume' => 'Id Resume',
            'fio' => 'Fio',
            'age' => 'Age',
            'salary' => 'Salary',
            'positionName' => 'Position Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'idRegion' => 'Id Region',
            'firstPublishedDate' => 'First Published Date',
            'publishedDate' => 'Published Date',
            'genderType' => 'Gender Type',
            'demands' => 'Demands',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[IdRegion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegion0()
    {
        return $this->hasOne(Regions::class, ['id' => 'idRegion']);
    }

    public function addCandidate($candidate){

        $this->id = $candidate->cv->id;
        $this->idResume = $candidate->cv->candidateId;
        $this->fio = $candidate->cv->fio;
        $this->age = (!empty($candidate->candidate->age)) ? $candidate->candidate->age : null;
        $this->salary = (!empty($candidate->cv->salary)) ? $candidate->cv->salary : null;
        $this->positionName = (!empty($candidate->cv->positionName)) ? $candidate->cv->positionName : null;
        $this->idRegion = Regions::getId($candidate->candidate->regionCode);
        $this->firstPublishedDate = (!empty($candidate->cv->firstPublishedDate)) ? $candidate->cv->firstPublishedDate : null;
        $this->publishedDate = (!empty($candidate->cv->publishedDate)) ? $candidate->cv->publishedDate : null;
        $this->genderType = (!empty($candidate->candidate->genderType->key)) ? $candidate->candidate->genderType->key : null;
        $this->demands = (!empty($candidate->cv->workExperiences[0]->demands)) ? $candidate->cv->workExperiences[0]->demands : null;
        $this->save();

    }

    public static function getIds(){

        $resume_ids = [];

        foreach (self::find()->asArray()->select("id")->all() as $item){
            $resume_ids[] = $item["id"];
        }

        return $resume_ids;

    }

    private function checkEmpty($field){
        return (!empty($field)) ? $field : null;
    }

}
