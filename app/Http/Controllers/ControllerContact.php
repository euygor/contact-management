<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerContact extends Controller
{
    public function contacts(Request $request)
    {
        $contacts = User::orderBy('id', 'desc')->paginate(5);

        return view('contacts', [
            'contacts' => $contacts,
            'success' => $request->session()->get('success'),
            'warning' => $request->session()->get('warning'),
        ]);
    }

    public function registerContact(Request $request)
    {
        $dados = $request->only(['name', 'contact', 'email']);

        if ($dados && $dados['name'] && $dados['contact'] && $dados['email']) {

            $verifyContact = User::where('contact', $dados['contact'])->count();
            $verifyEmail = User::where('email', $dados['email'])->count();

            if ($verifyContact > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contato já cadastrado.',
                ]);
            }

            if ($verifyEmail > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'E-mail já cadastrado.',
                ]);
            }

            $contact = new User();
            $contact->name = $dados['name'];
            $contact->contact = $dados['contact'];
            $contact->email = $dados['email'];
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Contato cadastrado com sucesso.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Preencha todos os campos.',
            ]);
        }
    }

    public function editContact(Request $request)
    {
        $dados = $request->only(['id', 'name', 'contact', 'email']);

        if ($dados && $dados['id'] && $dados['name'] && $dados['contact'] && $dados['email']) {
            $contact = User::find($dados['id']);
            $verifyContact = User::where('contact', $dados['contact'])->count();
            $verifyEmail = User::where('email', $dados['email'])->count();

            if ($verifyContact > 0 && $contact->contact != $dados['contact']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contato já cadastrado.',
                ]);
            }

            if ($verifyEmail > 0 && $contact->email != $dados['email']) {
                return response()->json([
                    'success' => false,
                    'message' => 'E-mail já cadastrado.',
                ]);
            }

            if ($dados['name'] != $contact->name) {
                $contact->name = $dados['name'];
            }

            if ($dados['contact'] != $contact->contact) {
                $contact->contact = $dados['contact'];
            }

            if ($dados['email'] != $contact->email) {
                $contact->email = $dados['email'];
            }

            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Contato atualizado com sucesso.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Preencha todos os campos.',
            ]);
        }
    }

    public function deleteContact(Request $request, $id)
    {
        $contact = User::find($id);
        $contact->delete();

        session()->flash('success', 'Contato excluído com sucesso.');
        return redirect()->route('contacts');
    }
}
