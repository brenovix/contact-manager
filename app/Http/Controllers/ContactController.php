<?php

namespace App\Http\Controllers;

use App\Entities\Contact;
use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\UnauthorizedException;

class ContactController extends Controller
{
    private $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request)
    {
        $contacts = $this->repository->getAll()->map(fn ($contact) => Contact::fromObject($contact));
        return view('contacts.index', compact('contacts'));
    }

    public function details(Request $request, int $id)
    {
        $contact = Contact::fromId($id, $this->repository);
        return view('contacts.details', compact('contact'));
    }

    public function add()
    {
        return view('contacts.add');
    }

    public function save(ContactRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact
            ];
            $this->repository->insert($data);
            Session::flash('status', 'success');
            Session::flash('message', 'Contact added successfully.');
        } catch (Exception $ex) {
            Session::flash('status', 'error');
            Session::flash('message', $ex->getMessage());
        }
        return redirect('/contacts');
    }

    public function edit(Request $request, int $id)
    {
        $contact = $this->repository->fromId($id);
        return view('contacts.update', compact('contact'));
    }

    public function update(ContactRequest $request)
    {
        try {
            $data = [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact
            ];

            $this->repository->update($data);
            Session::flash('status', 'success');
            Session::flash('message', 'Contact updated successfully.');
        } catch (Exception $ex) {
            Session::flash('status', 'error');
            Session::flash('message', $ex->getMessage());
        }
        return redirect('/contacts');
    }

    public function delete(Request $request, int $id)
    {
        try {
            return $this->repository->delete($id);
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 400);
        }
    }
}
