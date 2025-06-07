<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactManagementController extends Controller
{
    // List all contacts
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('backend.admin-contact.index', compact('contacts'));
    }

    // Update status (e.g., mark as processed)
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = $request->input('status');
        $contact->save();
        return redirect()->route('admin.contact.index')->with('success', 'Contact updated!');
    }

    // Delete a contact
    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect()->route('admin.contact.index')->with('success', 'Contact deleted!');
    }
}