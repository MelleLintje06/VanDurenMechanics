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
                    <input style="float: right; width:25%;" type="text" id="myInput" onkeyup="filter()" placeholder="Filteren op naam en onderwerp..">
                    <table id="m_table">
                        <tr>
                            <td></td>
                            <td>Naam</td>
                            <td>Onderwerp</td>
                        </tr>
                    @foreach ($contacts as $contact)
                        <tr style="height: 80px;">
                            <td style="width: 60px;">
                            @if ($contact->formRead === 0)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 80%; padding-left: 15px">
                                    <path d="M256 352c-16.53 0-33.06-5.422-47.16-16.41L0 173.2V400C0 426.5 21.49 448 48 448h416c26.51 0 48-21.49 48-48V173.2l-208.8 162.5C289.1 346.6 272.5 352 256 352zM16.29 145.3l212.2 165.1c16.19 12.6 38.87 12.6 55.06 0l212.2-165.1C505.1 137.3 512 125 512 112C512 85.49 490.5 64 464 64h-416C21.49 64 0 85.49 0 112C0 125 6.01 137.3 16.29 145.3z"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 80%; padding-left: 15px">
                                    <path d="M493.6 163c-24.88-19.62-45.5-35.37-164.3-121.6C312.7 29.21 279.7 0 256.4 0H255.6C232.3 0 199.3 29.21 182.6 41.38c-118.8 86.25-139.4 101.1-164.3 121.6C6.75 172 0 186 0 200.8v263.2C0 490.5 21.49 512 48 512h416c26.51 0 48-21.49 48-47.1V200.8C512 186 505.3 172 493.6 163zM303.2 367.5C289.1 378.5 272.5 384 256 384s-33.06-5.484-47.16-16.47L64 254.9V208.5c21.16-16.59 46.48-35.66 156.4-115.5c3.18-2.328 6.891-5.187 10.98-8.353C236.9 80.44 247.8 71.97 256 66.84c8.207 5.131 19.14 13.6 24.61 17.84c4.09 3.166 7.801 6.027 11.15 8.478C400.9 172.5 426.6 191.7 448 208.5v46.32L303.2 367.5z"/>
                                </svg>
                            @endif
                            </td>
                            <td>
                                {{ $contact->formName }}
                                <div>
                                    <a href="{{ route('message') }}?id={{$contact->formID}}" class="backend-crud" style="color: blue;">Bekijken</a>
                                    <a onclick="checkifdelete('{{ $contact->formTopic }}', {{$contact->formID}});" class="backend-crud" style="color: red; cursor: pointer;">Verwijderen</a>
                                </div>
                            </td>
                            <td>
                                @if ($contact->formRead === 0)
                                    <span style="font-weight: bold;">{{ $contact->formTopic }}</span>
                                @else
                                    <span>{{ $contact->formTopic }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const checkifdelete = (naam, id) => {
        if (confirm(`Weet u zeker dat u ${naam} wilt verwijderen?`)) {
            window.location.href = `/message/delete?id=${id}`;
            console.log(`${naam} was removed in the database.`);
        }
    }

    const filter = () => {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("m_table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            td2 = tr[i].getElementsByTagName("td")[2];
            if (td || td2) {
                txtValue = td.textContent || td.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || i == 0) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
