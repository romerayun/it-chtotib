<?php

namespace App\Http\Controllers;

use App\Claim;
use App\Http\Requests\Login;
use App\Http\Requests\StoreClaim;
use App\Http\Requests\StoreSettings;
use App\Http\Requests\StoreUser;
use App\Mail\RequestMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function create() {
        return view('user.create');
    }

    public function store(StoreUser $request) {

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', "Вы успешно зарегестрированы! Ожидайте подтверждения администратора!");
    }

    public function loginForm() {
        return view('user.login');
    }

    public function login(Login $request) {

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if (Auth::user()->role_id === 0) {
                Auth::logout();
                return redirect()->back()->with('error', "У вас нет доступа, обратитесь к администратору ресурса!");
            }
            else {
                session()->flash('success', 'Вы успешно авторизованы');
                return redirect()->home();
            }
        }
        return redirect()->back()->with('error', "Неверный логин или пароль!");

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function settings() {
        return view('user.profile');
    }

    public function storeSettings(StoreSettings $request) {

        $user = Auth::user();
        $data = $request->all();
        if ($request->hasFile('photo')) {
            Storage::delete($user->photo);
            $folder = date("Y-m-d");
            $data['photo'] = $request->file('photo')->store("images/{$folder}");
        }

        $user->update($data);
        $request->session()->flash('success', 'Данные успешно обновлены 👍');
        return redirect()->back();
    }

    public function newRequest() {

        return view('user.request');
    }

    public function createRequest(StoreClaim $request) {

//        mail('romerayun@gmail.com', '123', '1231231');
//        Mail::to('romerayun@gmail.com')->send(new Mailable());
//        dd('123');
        $res = Claim::create($request->all());

        $id = '00023' . $res->id;

        Mail::to($request->email)->send(new RequestMail($res->id));

        $request->session()->flash('success', 'Ваше обращение успешно сформировано 👍 <br>Номер для отслеживания статуса обращения - <b>IT-' . $id . '</b>.<br>Подробная информация отправлена на Вашу электронную почту 📤');

        return back();
    }

//    public function sendRequest() {
//        Mail::to('romerayun@gmail.com')->send(new RequestMail());
//        return view('user.send');
//    }

}
