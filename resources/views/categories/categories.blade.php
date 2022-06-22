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
                    <a href="{{ route('create_cat') }}"><button class="add_item">Voeg nieuwe categorie toe</button></a>
                    <input style="float: right; width:25%;" type="text" id="myInput" onkeyup="filter()" placeholder="Zoek voor namen..">
                    <table id="c_table">
                        <tr>
                            <td>Afbeelding</td>
                            <td>Naam</td>
                            <td>Aantal Producten</td>
                            <td>Gemaakt door</td>
                            <td>Status</td>
                        </tr>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="backend-td-img"><img class="backend-image" src="./storage/media/{{ $category->categoryImage }}"></td>
                            <td>
                                {{ $category->categoryName }}
                                <div>
                                    <a href="/store?cat={{$category->categorySlug}}" class="backend-crud" style="color: blue;">Bekijken</a>
                                    <a href="{{ route('edit_cat') }}?id={{$category->categoryID}}" class="backend-crud" style="color: green;">Bewerken</a>
                                    <a onclick="checkifdelete('{{ $category->categoryName }}', '{{$category->categoryID}}');" class="backend-crud" style="color: red; cursor:pointer;">Verwijderen</a> {{-- href="{{ route('delete_cat') }}?id={{ $category->categoryID }}"  --}}
                                </div>
                            </td>
                            <td>
                                <span style="display: none;">{{ $i = 0 }}</span>
                                @foreach ($products as $prod)
                                    @if ($prod->category_ID == $category->categoryID)
                                        <span style="display: none;">{{ $i++}}</span>
                                    @endif
                                @endforeach
                                {{ $i }}
                            </td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($user->id === $category->createdBy)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if ($category->categoryStatus === 1)
                                    Gepubliceerd
                                @else
                                    Concept
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
            window.location.href = `/categories/delete?id=${id}`;
            console.log(`${naam} was removed to the database.`);
        }
    }

    const filter = () => {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("c_table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1 || i == 0) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
