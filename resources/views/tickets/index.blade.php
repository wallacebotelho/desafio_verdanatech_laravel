@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lista de chamados</div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex">
                            <form method="GET" action="{{ route('tickets.index') }}" class="d-flex me-2">
                                <input type="text" class="form-control me-2" name="search" placeholder="Digite o título ou descrição..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-success">
                                    Buscar
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Atribuído para</th>
                                    <th scope="col">Criado em</th>
                                    <th scope="col">Atualizado em</th>
                                    <th scope="col col-md-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ $ticket->assignee ? $ticket->assignee->name : '-' }}</td>
                                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $ticket->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">Ver</a>
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este chamado?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($tickets->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum chamado encontrado.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <nav aria-label="Page navigation">
                            {{ $tickets->links('pagination::bootstrap-4') }}
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
