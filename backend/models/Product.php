<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property string $name
 * @property string $createdBy
 * @property int $manufacturer_id
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string $price
 *
 * @property CategoryProduct[] $categoryProducts
 * @property Manufacturer $manufacturer
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'createdBy', 'manufacturer_id', 'short_description', 'description', 'image', 'price'], 'required'],
            [['createdBy'], 'integer'],
            [['manufacturer_id'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name', 'short_description', 'image'], 'string', 'max' => 255],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'manufacturer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'name' => 'Name',
            'manufacturer_id' => 'Manufacturer ID',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'image' => 'Image',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryProducts()
    {
        return $this->hasMany(CategoryProduct::className(), ['product_id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['manufacturer_id' => 'manufacturer_id']);
    }
}
