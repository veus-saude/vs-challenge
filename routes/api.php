<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ok', function (){
    return ['status' => true];
});

Route::namespace('api')->name('api.')->group(function (){
    Route::prefix('produtos')->group(function (){

        Route::get('/create', [ProdController::class, 'create'])->name('criar_produto');

        Route::get('/', [ProdController::class, 'index'])->name('todos_produtos');
        Route::get('/{id}', [ProdController::class, 'show'])->name('visualizar_um_produto');
        Route::get('/{id}/edit', [ProdController::class, 'edit'])->name('editar_produto');

        Route::post('/', [ProdController::class, 'store'])->name('salvar_produto');
        Route::put('/{id}', [ProdController::class, 'update'])->name('atualizar_produto');
        Route::delete('/{id}', [ProdController::class, 'destroy'])->name('deletar_produto');

    });

});
