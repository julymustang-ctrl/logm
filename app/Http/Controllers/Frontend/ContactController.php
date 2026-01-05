<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Get admin email from settings or use default
        $adminEmail = Setting::where('key', 'contact_email')->value('value') 
            ?? 'info@logas.com.tr';

        try {
            // Send email
            Mail::send('emails.contact', [
                'data' => $validated
            ], function ($message) use ($validated, $adminEmail) {
                $message->to($adminEmail)
                        ->subject('İletişim Formu: ' . $validated['subject'])
                        ->replyTo($validated['email'], $validated['name']);
            });

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.'
                ]);
            }

            return redirect()->back()->with('success', 'Mesajınız başarıyla gönderildi.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mesaj gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Mesaj gönderilirken bir hata oluştu.')
                ->withInput();
        }
    }
}
