@extends('layouts.main')
@section('title', 'Lista de Usuários')
@section('content')
            <h1>Lista de Usuários</h1>
            
            <div>
                <a href="./user/"><button class="btn">Adicionar novo usuário</button></a>
            </div>
            @if (session('msgTrue'))
                <p class="msgTrue">{{session('msgTrue')}}</p>
            @endif
            @if (session('msgFalse'))
                <p class="msgFalse">{{session('msgFalse')}}</p>
            @endif
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Contato</th>
                            <th>Controles</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($usuarios as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>
                                    <div class='control'>
                                        <button>
                                            <a href="./user/{{$user->id}}"><img class='icon' src="./img/edit.svg"/></a>
                                        </button>
                                        
                                        <form action="./users/{{$user->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <button type="submit"><img class='icon' src="./img/trash.svg"/></button>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                
                    </tbody>
                </table>
            </div>
@endsection