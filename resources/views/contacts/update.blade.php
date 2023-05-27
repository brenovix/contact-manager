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
                    <form method="POST" action="{{ route('contact.update', ['id' => $contact->id]) }}">
                        @csrf
                        @if (isset($contact))
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        <input type="hidden" name="id" value="{{ $contact->id ?? '' }}">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $contact->name ?? ''}}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ $contact->email ?? ''}}" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Contact -->
                        <div class="mt-4">
                            <x-input-label for="contact" :value="__('Contact')" />
                            <x-text-input id="contact" class="block mt-1 w-full" value="{{ $contact->contact ?? ''}}" type="text" name="contact" required />
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ml-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>