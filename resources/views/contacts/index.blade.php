<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Contacts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::user())
                    <a href="/contacts/add">
                        <x-add-contact-icon />
                    </a>
                    @endif
                    <table class="table-auto w-full border border-slate-400 text-sm shadow-sm bg-opacity-100">
                        <thead class="bg-slate-100" style="background-color: rgb(203 213 225);">
                            <tr>
                                <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                    ID</th>
                                <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                    Name</th>
                                <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                    Contact</th>
                                <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                    Email</th>
                                <th class="border border-slate-300 font-semibold p-4 text-slate-900 text-left">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr id="row_{{ $contact->id() }}" class="border border-slate-100 p-4 text-slate-500 bg-slate-50">
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                    <a href="/contacts/{{ $contact->id() }}">{{ $contact->id() }}</a>
                                </td>
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                    <a href="/contacts/{{ $contact->id() }}">{{ $contact->name }}</a>
                                </td>
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                    <a href="/contacts/{{ $contact->id() }}">{{ $contact->contact }}</a>
                                </td>
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                    <a href="/contacts/{{ $contact->id() }}">{{ $contact->email }}</a>
                                </td>
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500" style="max-width: 100px">
                                    <a href="/contacts/{{ $contact->id() }}" style="margin-right: 7px; float: left;">
                                        <x-contact-detail-icon width=24 />
                                    </a>
                                    @if (Auth::user())
                                    <a href="/contacts/{{ $contact->id() }}/edit"
                                        style="margin-right: 7px; float: left;">
                                        <x-edit-contact-icon />
                                    </a>
                                    <a href="javascript:;" title="Remove Contact" data-id="{{  $contact->id() }}"
                                        data-name="{{ $contact->name }}" class="remove-contact"
                                        style="margin-right: 7px; float: left;">
                                        <x-remove-contact-icon />
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-modal-remove-content />
    <div id="notification">
        @if (Session::has('message'))
            <x-notification-card type="{{ Session::get('status') }}" message="{{ Session::get('message') }}" />
            
        @endif
    </div>
</x-app-layout>
