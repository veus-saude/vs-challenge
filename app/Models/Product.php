<?php

/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 *
 * Date: Wed, 28 Aug 2019 00:56:59 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $brand_id
 * @property int $qty
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Brand $brand
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	protected $casts = [
		'price' => 'float',
		'brand_id' => 'int',
		'qty' => 'int'
	];

	protected $fillable = [
		'name',
		'price',
		'brand_id',
		'qty'
	];

	public function brand()
	{
		return $this->belongsTo(\App\Models\Brand::class);
	}
}
