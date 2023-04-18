<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserNote
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $note = Note::findOrFail($request->id);
        
        if ( $note->user_id != $currentUser->id ) {
            return response()->json(['message' => 'data tidak ditemukan']); 
        }

        return $next($request);
    }
}
