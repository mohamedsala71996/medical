<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    

    public function update($accept)
    {
        // return auth()->user()->id;
        if (auth()->check()) {
            $user_id = auth()->user()->id;
    
            User::findOrFail($user_id)->update([
                'terms' => $accept,
            ]);
        }
    
      return  redirect(url('/posts'));
    }

}
