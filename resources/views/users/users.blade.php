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
                    <table>
                        <tr>
                            <td>Afbeelding</td>
                            <td>Naam</td>
                            <td>Email</td>
                            <td>Gemaakt op</td>
                            <td>Gewijzigd op</td>
                        </tr>
                    @foreach ($gebruikers as $user)
                        <tr>
                            @if ($user->userProfile !== null)
                                <td class="backend-td-img"><img class="backend-image" src="./storage/media/{{$user->userProfile}}"></td>
                            @else
                                <td class="backend-td-img"><img class="backend-image" src="./storage/media/ezgif.com-gif-maker.jpg"></td>
                            @endif
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
