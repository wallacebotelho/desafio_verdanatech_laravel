<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    protected $status = [
        'Aberto',
        'Em Andamento',
        'Fechado'
    ];

    protected $priorities = [
        'Baixo',
        'Média',
        'Alta',
        'Urgente'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::query()->orderBy('id', 'desc');
        // Se usuário fez uma busca no campo search, ele aplica o filtro
        if (request('search')) {
            $search = request('search');
            $tickets->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $tickets = $tickets->paginate(5)->appends(['search' => request('search')]);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = $this->status;
        $priorities = $this->priorities;

        return view('tickets.create', [
            'status' => $status,
            'priorities' => $priorities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'status' => 'required|in:' . implode(',', $this->status),
            'priority' => 'required|in:' . implode(',', $this->priorities),
        ];

        $messages = [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título deve ter no máximo :max caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.',
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade selecionada é inválida.',
        ];

        $request->validate($rules, $messages);

        $ticket = new Ticket($request->all());
        $ticket->user_id = auth()->id(); // Define o usuário autenticado como criador do ticket
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Chamado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {


        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /** Attribution for assigneed */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assignee_id' => 'required|exists:users,id',
        ], [
            'assignee_id.required' => 'O responsável é obrigatório.',
            'assignee_id.exists' => 'O responsável selecionado é inválido.',
        ]);

        dd($request->all());
    }
}
