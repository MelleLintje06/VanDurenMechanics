<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\User;
use App\Models\contact;

class messageController extends Controller
{
    // Zet het contactformulier dat een bezoeker heeft ingevuld in de database en stuurt de bezoeker door naar contact
    public function postcontact(Request $request) {
        $contact = new contact();
        $contact->formName = $request->input('c_name');
        $contact->formEmail = $request->input('c_email');
        $contact->formTopic = $request->input('c_topic');
        $contact->formMessage = $request->input('c_message');
        $contact->formRead = 0;
        $contact->save();
        return redirect('/contact');
    }

    // Toont lijst met berichten van bezoekers in de backend
    public function messages() {
        $messages = contact::all();
        return view('messages', ['contacts'=> $messages]);
    }

    // Toont details van een bericht zodat de eigenaar er meer over kan lezen
    public function message(Request $request) {
        $id = $request->input('id', '');
        if ($id !== '' && $id !== null) {
            $message = contact::where('formID', 'like', $id)->get();
            return view('message', ['message'=> $message]);
        }
        else {
            return redirect('/messages');
        }
    }

    // Zodra de eigenaar op terug naar berichten klikt wordt er een update gedaan dat het bericht is gelezen
    public function updatemessage(Request $request) {
        $m = contact::where('formID', 'like', $request->input('c_id'))->first();
        $m->formRead = 1;
        $m->update();
        return redirect('/messages');
    }

    // Verwijderd het bericht van de bepaalde bezoeker
    public function deletemessage(Request $id) {
        $mess_id = $id->input('id', '');
        if ($mess_id !== '') {
            contact::where('formID', $mess_id)->delete();
        }
        return redirect('/messages');
    }
}
