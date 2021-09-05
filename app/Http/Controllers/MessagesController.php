<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = auth()->user();
            $messages = Messages::where('user_one', '=', $user->id)
                            ->orWhere('user_two', '=', $user->id)
                            ->orderBy('updated_at', 'desc');

            return response()->json([
                'messages' => $messages
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong please contact administrator',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            // TODO ADD MESSAGE

            return response()->json([
                'messages' => $messages
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong please contact administrator',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        $detail = $messages->detail;

        return response()->json([
            'messages' => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }

    public function all()
    {
        try {
            $messages = Messages::all()->orderBy('updated_at', 'desc');

            return response()->json([
                'messages' => $messages
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong please contact administrator',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
