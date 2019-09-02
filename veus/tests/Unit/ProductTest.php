<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\Products;

class ProductTest extends TestCase
{
    public function testIndex()
    {
		$produto = new Products;
        $this->assertJson($produto->index());
    }
	
	public function testShow()
    {
		$produto = new Products;
        $this->assertJson($produto->show(1));
    }
	
}
