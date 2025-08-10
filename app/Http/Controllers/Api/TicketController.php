<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $query = Ticket::query();

            if(request()->has('status')) {
                $query->where('status', request()->input('status'));
            }

            if(request()->has('user_id')) {
                $query->where('user_id', request()->input('user_id'));
            }

            $tickets = $query->get();

            return response()->json($tickets, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve calls: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
