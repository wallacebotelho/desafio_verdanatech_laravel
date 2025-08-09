@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ $ticket->title }} #{{ $ticket->id }}</span>
                        <small class="text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="card-body">


                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <strong>Status:</strong> {{ ucfirst($ticket->status) }}
                                        </div>
                                        <div>
                                            <strong>Prioridade:</strong> {{ ucfirst($ticket->priority) }}
                                        </div>
                                    </div>

                                    <p class="mt-3"><strong>Autor:</strong> {{ $ticket->user->name }}</p>
                                    <p><strong>Atribuído para:</strong>
                                        {{ $ticket->assignee ? $ticket->assignee->name : 'Ninguém' }}
                                    </p>

                                    @if (!$ticket->assignee)
                                        <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Atribuir para mim</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Descrição do chamado:</strong></label>
                            <textarea id="description" style="resize: none;" class="form-control" cols="100" rows="4" readonly disabled>{{ $ticket->description }}</textarea>
                            @if ($ticket->response)
                                <label for="response" class="form-label"><span> Atualizado por
                                        <strong>{{ $ticket->assignee->name }}</strong> em
                                        <i>{{ $ticket->updated_at->format('d/m/Y H:i') }}</i></span></label>
                                <textarea id="response" style="resize: none;" class="form-control" cols="100" rows="4" readonly disabled>{{ $ticket->response }}</textarea>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            @if (empty($ticket->response))
                                <div class="collapse" id="collapseResponse">
                                    <div class="card card-body mb-3">
                                        <form action="{{ route('tickets.response', $ticket->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="response" class="form-label"><strong>Responder:</strong></label>
                                                <textarea id="response" style="resize: none;" name="response" class="form-control" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                                <a class="btn btn-info" data-bs-toggle="collapse" href="#collapseResponse" role="button"
                                    aria-expanded="false" aria-controls="collapseResponse">
                                    Responder
                                </a>
                            @endif

                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-outline-primary me-2">Editar</a>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
