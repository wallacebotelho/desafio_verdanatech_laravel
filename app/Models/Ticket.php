<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'user_id',
        'assignee_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function rules(){
        return [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'status' => 'required|in:Aberto,Em Andamento,Fechado',
            'priority' => 'required|in:Baixo,Médio,Alto,Urgente',
            'assignee_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título deve ter no máximo :max caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.',
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade selecionada é inválida.',
        ];
    }
}
