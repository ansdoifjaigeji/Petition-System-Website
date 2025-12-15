<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use App\Models\Petition;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class SignatureController extends Controller
{
    /**
     * Store a new signature for a petition.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id (Petition ID)
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        $petition = Petition::findOrFail($id);
        $petitionId = $petition->id;
        $name = null;
        $email = null;
        $userId = null;
        $rules = [
            'comment' => 'nullable|string|max:500',
        ];

        
        if (Auth::check()) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $userId = $user->id;

            $rules['email'] = [
                Rule::unique('signatures')->where(function ($query) use ($petitionId) {
                    return $query->where('petition_id', $petitionId);
                })
                ->ignore($userId, 'user_id'),
            ];

        } else {
            
            $name = $request->name;
            $email = $request->email;
            $userId = null;

            $rules['name'] = 'required|string|max:255';
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('signatures')->where(function ($query) use ($petitionId) {
                    return $query->where('petition_id', $petitionId);
                }),
            ];
        }

        
        $request->validate($rules);

        
        $signature = new Signature();
        $signature->petition_id = $petitionId;
        $signature->user_id = $userId;
        $signature->name = $name;
        $signature->email = $email;
        $signature->comment = $request->comment;

        
        try {
            $signature->save();

        } catch (\Exception $e) {
            return redirect()->route('petitions.show', $petition->id)
                ->with(
                    'error',
                    'Failed to save the signature (Database Error). Message: ' . $e->getMessage()
                );
        }

        
        return redirect()->route('petitions.show', $petition->id)
            ->with('success', 'Thank you! Your signature has been successfully added.');
    }

    /**
     * Delete the comment on a signature (only owner may delete their comment).
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id Signature ID
     * @return \Illuminate\Http\Response
     */
    public function destroyComment(Request $request, $id)
    {
        $signature = Signature::findOrFail($id);

        if (!Auth::check() || $signature->user_id !== Auth::id()) {
            return redirect()->route('petitions.show', $signature->petition_id)
                ->with('error', 'You are not authorized to delete this comment.');
        }

        $signature->comment = null;
        $signature->save();

        return redirect()->route('petitions.show', $signature->petition_id)
            ->with('success', 'Comment deleted successfully.');
    }
}
