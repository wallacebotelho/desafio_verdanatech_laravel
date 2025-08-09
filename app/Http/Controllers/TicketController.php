<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    protected $status = [
        'Aberto',
        'Em Andamento',
        'Fechado'
    ];

    protected $priorities = [
        'baixo' => 'Baixo',
        'medio' => 'Médio',
        'alto' => 'Alto',
        'urgente' => 'Urgente'
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
    public function store(Request $request, Ticket $ticket)
    {

        $rules = $ticket->rules();
        $messages = $ticket->messages();

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
        $users = User::all();

        return view('tickets.show', compact('ticket', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', [
            'ticket' => $ticket,
            'status' => $this->status,
            'priorities' => $this->priorities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $rules = $ticket->rules();
        $messages = $ticket->messages();

        $request->validate($rules, $messages);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Chamado excluído com sucesso!');
    }

    /** Attribution for assigneed */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assignee_id' => 'exists:users,id',
        ], [
            'assignee_id.exists' => 'O responsável selecionado é inválido.',
        ]);

        $ticket->assignee_id = auth()->id();
        $ticket->status = 'Em Andamento';
        $ticket->save();

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Chamado atribuído com sucesso!');
    }

    /** Respond to a ticket */
    public function respond(Request $request, Ticket $ticket)
    {

        $ticket->response = $request->input('response');
        $ticket->save();

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Resposta enviada com sucesso!');
    }
}
