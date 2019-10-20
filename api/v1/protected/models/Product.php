<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $idBrand
 * @property string $name
 * @property string $price
 * @property integer $amount
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Brand $idBrand0
 */
class Product extends CActiveRecord
{

	public $oldAttributes;
	public $brand;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idBrand, name, price, amount', 'required'),
			array('name', 'validateName'),
			array('idBrand, amount', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>70),
			array('updated', 'safe'),
			array('id, idBrand, name, price, amount, created, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Valida se já existe um produto cadastrado com mesmo nome e marca
	 * 
	 * @return void
	 */
	public function validateName() {
		if ($this->name == $this->oldAttributes['name'] && $this->idBrand == $this->oldAttributes['idBrand']) {
			// Se não houve nenhuma alteração de nome ou marca, então não precisa validar
			return;
		}

		$alreadyExists = Product::model()->exists(
			'name = :name AND idBrand = :idBrand',
			[':name'=>$this->name, ':idBrand'=>$this->idBrand]
		);
		if ($alreadyExists) {
			$this->addError('name', 'Já existe um Produto dessa marca com o mesmo nome');
		}
	}

	public function afterFind()
	{
		$this->oldAttributes = $this->getAttributes();

		$this->brand = Yii::app()->db->createCommand('
			SELECT name FROM brand WHERE id = :id
		')->queryScalar([':id'=>$this->idBrand]);

		return parent::afterFind();
	}

	public function beforeSave()
	{
		if (!$this->isNewRecord) {
			$this->updated = date('Y-m-d H:i:s');
		}

		return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idBrand0' => array(self::BELONGS_TO, 'Brand', 'idBrand'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idBrand' => 'Brand',
			'name' => 'Name',
			'price' => 'Price',
			'amount' => 'Amount',
			'created' => 'Created',
			'updated' => 'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idBrand',$this->idBrand);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function saveModel($attributes, $validate = true)
	{
		$this->setAttributes($attributes);
		return $this->save($validate);
	}
}
