@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $ticket->title }} #{{ $ticket->id }}</div>
                    <div class="card-body">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 d-flex flex-column gap-2">
                                    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                                    <p><strong>Autor:</strong> {{ $ticket->user->name }}</p>
                                    <p><strong>Atribuído para:</strong>
                                        {{ $ticket->assignee ? $ticket->assignee->name : 'Ninguém' }}</p>
                                        <form action="{{ route('tickets.assign') }}">
                                        @csrf
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        <div class="form-group">
                                            <label for="assignee_id">Atribuir para:</label>
                                            <select name="assignee_id" id="assignee_id" class="form-control">
                                                <option value="">Selecione um usuário</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $ticket->assignee_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                </div>
                                <div class="col-md-6 d-flex flex-column gap-2">
                                    <p><strong>Título:</strong> {{ $ticket->title }}</p>
                                    <p><strong>ID:</strong> {{ $ticket->id }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Descrição do chamado:</strong></label>
                            <textarea id="description" style="resize: none;" class="form-control" cols="100" rows="4" readonly disabled>{{ $ticket->description }}</textarea>
                        </div>
                        <p>Status: {{ $ticket->status }}</p>
                        <p>Prioridade: {{ $ticket->priority }}</p>
                        <p>Criado em: {{ $ticket->created_at }}</p>
                        <p>Atualizado em: {{ $ticket->updated_at }}</p>
                        <div class="form-group mt-3">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
