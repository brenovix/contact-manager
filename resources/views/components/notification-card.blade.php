@props(['type' => 'info', 'message' => ''])
@php
    $color = ($type == 'success') ? 'green' : ($type == 'info' ? 'blue' : 'red')
@endphp
<div
    class="flex flex-col space-y-4 min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-3 flex justify-start items-end inset-0 z-50 outline-none focus:outline-none">
    <div class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 rounded-2xl p-3 border border-{{ $color }}-100 text-{{ $color }}-400 bg-{{ $color }}-50" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex flex-col ml-3">
                    <div class="font-medium leading-none">{{ $message }}</div>
                </div>
            </div>
        </div>
    </div>
</div>