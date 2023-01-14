<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\RelatorioController;

/**
 * -> view
 */
Route::get('/', [RelatorioController::class, 'index']);


/**
 * -> fornecedor
 */
Route::get('/fornecedores', [FornecedorController::class, 'index']);
Route::post('/fornecedores/inserir', [FornecedorController::class, 'insert_fornecedor'])->name('inserir');
Route::post('/fornecedores/alterar', [FornecedorController::class, 'update_fornecedor'])->name('alterar');
Route::get('/fornecedores/deletar/{id}', [FornecedorController::class, 'delete_fornecedor']);

/**
 * -> produtos
 */
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::post('/produtos/inserir', [ProdutoController::class, 'insert_product'])->name('inserir');
Route::post('/produtos/alterar', [ProdutoController::class, 'update_product'])->name('alterar');
Route::get('/produtos/deletar/{id}', [ProdutoController::class, 'delete_product']);


?>