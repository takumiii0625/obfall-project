<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class ContactsController extends Controller
{
    public function contact()
    {
        return view('contacts.contact');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:10',
            'email'    => 'required|email',
            'tel'      => 'nullable|numeric',
            'company'   => 'required',
            'contents' => 'required',
            'privacy_agree' => 'required',

        ]);
        // フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();
        return view('contacts.confirm', ['inputs' => $inputs]);
    }

    public function process(Request $request)
    {
        $action = $request->get('action', 'return');
        $input  = $request->except('action');

        if ($action === 'submit') {

            // DBにデータを保存
            //$contact = new Contact();
            //$contact->fill($input);
            //$contact->save();

            // メール送信（送信者向け）
            Mail::to($input['email'])->send(new ContactMail('mails.contact', '【OBFall株式会社】お問い合わせありがとうございます', $input));

            // メール送信（会社側向け）
            $subjectForCompany = "【" . $input['company'] . "】新しいお問い合わせがありました";
            Mail::to('h.katono@obfall.co.jp')->send(new ContactMail('mails.contact_to_company', $subjectForCompany, $input));

            return redirect()->route('complete');
        } else {
            return redirect()->route('contact')->withInput($input);
        }
    }

    public function complete()
    {
        return view('contacts.complete');
    }
}
