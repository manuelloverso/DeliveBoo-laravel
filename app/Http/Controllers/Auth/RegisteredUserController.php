<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {



        $validated = $request->validate([
            /* user */
            'user_name' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'user_email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            /* restaurant */
            'address' => 'required|min:5|max:100',
            'restaurant_email' => 'required|min:5|max:100|unique:restaurants,restaurant_email',
            'phone_number' => 'nullable|numeric|min_digits:5|max_digits:15',
            'p_iva' => 'required|numeric|min_digits:11|max_digits:11',
            'restaurant_name' => 'required|min:3|max:50',
            'image' => 'required|image|max:6000',
            'types' => 'required|exists:types,id',
            'user_id' => 'nullable|exists:user,id',
        ]);


        /* Create the user */
        $user = User::create([
            'user_name' => $request->user_name,
            'lastname' => $request->lastname,
            'user_email' => $request->user_email,
            'password' => Hash::make($request->password),
        ]);

        /* create the restaurant */
        $validated['user_id'] = $user->id;

        $img_path = Storage::put('uploads', $validated['image']);
        $validated['image'] = $img_path;


        $restaurant = Restaurant::create([
            'restaurant_name' => $validated['restaurant_name'],
            'restaurant_slug' => Str::slug($validated['restaurant_name'], '-'),
            'address' => $validated['address'],
            'restaurant_email' => $validated['restaurant_email'],
            'phone_number' => $validated['phone_number'],
            'p_iva' => $validated['p_iva'],
            'image' => $validated['image'],
            'types' => $validated['types'],
            'user_id' => $validated['user_id'],
        ]);

        $restaurant->types()->attach($validated['types']);



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
