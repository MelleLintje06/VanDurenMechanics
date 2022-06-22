<x-app-layout>
    @include('layouts/head')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Van Duren Mechanics') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($message as $m)
                        <div style="border-bottom: 1px solid black;">
                        <p>Naam: {{ $m->formName }}</p>
                        <p>Email: <a href="mailto:{{$m->formEmail}}">{{ $m->formEmail }}</a></p>
                        <p style="border-top: 1px solid black; height: 30px; padding-top: 5px">
                            Onderwerp: <span style="font-weight: bold;">{{ $m->formTopic }}</span>
                        </p>
                        </div>
                        <div style="margin-top: 10px;">
                            <p>Bericht:</p>
                            <p>{{ $m->formMessage}}</p>
                        </div>

                        <form action="/messages" method="POST">
                            @csrf
                            <input type="hidden" name="c_id" value="{{ $m->formID}}">
                            <input type="submit" style="margin-top: 30px; border: 3px solid black; padding: 10px; cursor: pointer;" value="Terug naar berichten">
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
