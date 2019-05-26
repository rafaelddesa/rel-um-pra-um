<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Cliente;
use App\Endereco;


Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes as $c){
        echo "<p>ID: ". $c->id . "</p>";
        echo "<p>nome: ". $c->nome . "</p>";
        echo "<p>telefone: ". $c->telefone . "</p>";

        //$e = Endereco::where('cliente_id', $c->id)->first();
        // No model cliente funcao cliente retornando hasOne()
        
        echo "<p>rua: ". $c->endereco->rua . "</p>";
        echo "<p>numero: ". $c->endereco->numero . "</p>";
        echo "<p>bairro: ". $c->endereco->bairro . "</p>";
        echo "<p>cidade: ". $c->endereco->cidade . "</p>";
        echo "<p>uf: ". $c->endereco->uf . "</p>";
        echo "<p>cep: ". $c->endereco->cep . "</p>";

        echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $ends = Endereco::all();
    foreach($ends as $e){
        echo "<p>ID-Cliente: ". $e->cliente_id . "</p>";

        // No model endereco funcao cliente retornando belongsTo()
        echo "<p>nome: ". $e->cliente->nome . "</p>";
        echo "<p>telefone: ". $e->cliente->telefone . "</p>";

        echo "<p>Rua: ". $e->rua . "</p>";
        echo "<p>numero: ". $e->numero . "</p>";
        echo "<p>bairro: ". $e->bairro . "</p>";
        echo "<p>cidade: ". $e->cidade . "</p>";
        echo "<p>uf: ". $e->uf . "</p>";
        echo "<p>cep: ". $e->cep . "</p>";
        echo "<hr>";
    }
});

Route::get('inserir', function () {
    $c = new Cliente();
    $c->nome = "Rafael Rodrigues";
    $c->telefone = "11 94211-5885";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Estado";
    $e->numero = 400;
    $e->bairro = "Parque Santa Tereza";
    $e->cidade = "Santa Isabel";
    $e->uf = "SP";
    $e->cep = "07500-000";
    
    $c->endereco()->save($e);

    $c = new Cliente();
    $c->nome = "Rodrigo Rodrigues";
    $c->telefone = "12 94211-5885";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Brasil";
    $e->numero = 4100;
    $e->bairro = "Parque Santa";
    $e->cidade = "Santa Isabel";
    $e->uf = "SP";
    $e->cep = "07500-000";
    
    $c->endereco()->save($e);

});

Route::get('/clientes/json', function () {
    // $clientes = Cliente::all();
    $clientes = Cliente::with(['endereco'])->get();
    return $clientes->toJson();
});

Route::get('/enderecos/json', function () {
    // $enderecos = Endereco::all();
    $enderecos = Endereco::with(['cliente'])->get();
    return $enderecos->toJson();
});