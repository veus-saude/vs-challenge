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
 * Class Brand
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Brand extends Eloquent
{
	protected $fillable = [
		'name'
	];

	public function products()
	{
		return $this->hasMany(\App\Models\Product::class);
	}
}
