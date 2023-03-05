<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id_mahasiswa
 * @property string|null $nim
 * @property string|null $nama
 * @property int|null $id_prodi
 *
 * @property Prodi $prodi
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prodi'], 'integer'],
            [['nim', 'nama'], 'string', 'max' => 255],
            [['id_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::class, 'targetAttribute' => ['id_prodi' => 'id_prodi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mahasiswa' => 'Id Mahasiswa',
            'nim' => 'Nim',
            'nama' => 'Nama',
            'id_prodi' => 'Prodi',
        ];
    }

    /**
     * Gets query for [[Prodi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(Prodi::class, ['id_prodi' => 'id_prodi']);
    }
}
