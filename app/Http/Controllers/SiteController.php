<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        return view('contact');
    }

    public function updateChat()
    {
        $mensagens = Chat::query("SELECT * FROM (SELECT * FROM chats ORDER BY id DESC LIMIT 150) Var1 ORDER BY id ASC")->get();
        return view('ajax/chat',  compact('mensagens'));
    }

    public function sendChat(Request $request)
    {
        if (strlen($request['msg']) > 0) {
            if (Auth::user() != null) {
                $data['message'] = $request['msg'];
                $data['user_id'] = Auth::user()->id;

                Chat::create($data);

                $retorno['status'] = "SUCESSO";
            } else {
                $retorno['status'] = "ERRO";
                $retorno['mensagem'] = "Você precisa estar logado para enviar uma mensagem!";
            }
        } else {
            $retorno['status'] = "ERRO";
            $retorno['mensagem'] = "Você deve escrever uma mensagem para enviar!";
        }

        echo json_encode($retorno);
    }

    public function sendContact(Request $request)
    {
        Mail::send('contact', array(
            'email' => $request->email,
            'name' => $request->name,
            'msg' => $request->message,
        ), function ($message) use ($request) {
            $message->to($request->email);
            $message->from('vinicius.corbelli@CompuTech.com.br', 'Vinícius Corbelli');
        });

        return redirect()->route('contact')->with('success', true);
    }
}
