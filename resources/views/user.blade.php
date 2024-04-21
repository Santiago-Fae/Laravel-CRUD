@extends('layouts.main')
@section('title', 'Cadastro de usuário')
@section('content')

<?php 
 $user = !empty($user) ? $user : false;
 ?>
<h1><?php echo $user ? "Alteração de usuário" : "Cadastro de usuário"; ?></h1>
<form action="/users<?php echo $user ? ('/' . $user->id) : ''; ?>" method="POST">
    @csrf
    @method('POST')
    <div class="formEdit">
        <div >
            <label>Nome:</label>
            <input type="text" id='name' name='name' placeholder='Nome' class="inp" value="<?php echo $user ? $user->name : ''; ?>"/>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" id='email' name='email' placeholder='Email' class="inp" value="<?php echo $user ? $user->email : ''; ?>"/>
        </div>
        <div>
            <label>Telefone:</label>
            <input type="text" name='contact' id='contact' placeholder='Telefone' class="inp"  value="<?php echo $user ? $user->contact : ''; ?>"/>
        </div>

        <div>
            <div>
                <button class="btnAdd" type='submit'>
                    <?php echo $user ? "Editar" : "Cadastrar"; ?>
                </button>
            </div>

        </div>
    </div>
</form>

@if (session('msgFalse'))
    <p class="msgFalse">{{session('msgFalse')}}</p>
@endif
<div>
<a href="/">
    <button class="btnBack">
        Voltar
    </button>
</a>
@endsection