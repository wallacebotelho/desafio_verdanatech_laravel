@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Criar chamado</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tickets.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Título*</label>
                                <input name="title" type="text" value="{{ old('title') }}" class="form-control"
                                    id="title" placeholder="Digite o título do chamado">
                            </div>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="description">Descrição*</label>
                                <textarea name="description" class="form-control" id="description" rows="4"
                                    placeholder="Descreva o seu problema.">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status*</label>
                                <select name="status" class="form-control" id="status">
                                    @foreach ($status as $key)
                                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                            {{ $key }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="priority">Prioridade*</label>
                                <select name="priority" class="form-control" id="priority">
                                    @foreach ($priorities as $key)
                                        <option value="{{ $key }}"
                                            {{ old('priority') == $key ? 'selected' : '' }}>
                                            {{ $key }}</option>
                                    @endforeach
                                </select>
                                @error('priority')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary me-2">Criar</button>
                                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
