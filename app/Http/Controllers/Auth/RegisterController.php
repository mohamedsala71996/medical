<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['nullable', 'date'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'face_id_card' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'back_id_card' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
    
        ]);
    }

    protected function create(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->type = $data['type'];
        $user->phone = $data['phone'];
        // $user->latitude = $data['latitude'];
        // $user->longitude = $data['longitude'];    
        $user->date_of_birth = $data['date_of_birth'];
        $user->password = Hash::make($data['password']);
        $user->is_approved = $data['is_approved'];

        if (isset($data['face_id_card'])) {
            $faceIdPath = $data['face_id_card']->store('id_cards', 'public');
            $user->face_id_card = $faceIdPath;
        }

        if (isset($data['back_id_card'])) {
            $backIdPath = $data['back_id_card']->store('id_cards', 'public');
            $user->back_id_card = $backIdPath;
        }

        $user->save();

        $user->location()->create([
            'latitude'=>$data['latitude'],
            'longitude'=>$data['longitude'],
            'status' =>'active',

        ]);

        return $user;
    }

    public function register(Request $request)
    {
    //    return $request;
        $this->validator($request->all())->validate();

        $data = $request->except('face_id_card','back_id_card');

        if ($request->hasFile('face_id_card')) {
            $data['face_id_card'] = $request->file('face_id_card');
        }

        if ($request->hasFile('back_id_card')) {
            $data['back_id_card'] = $request->file('back_id_card');
        }
        if ($request->type == 1) {
            $data['is_approved'] = 1;
        } else {
            $data['is_approved'] = 0;
        }
        $user = $this->create($data);

        if ($user->type == 1) {
            $this->guard()->login($user);
            return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
        }

        return redirect()->route('login')->with('message', __('The card will be reviewed as soon as possible'));
    }
}
