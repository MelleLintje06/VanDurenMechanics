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
                    <a href=" {{ route('create_products') }} "><button class="add_item">Voeg nieuw product toe</button></a>
                    <input style="float: right; width:25%;" type="text" id="myInput" onkeyup="filter()" placeholder="Filteren op namen..">
                    <table id="p_table">
                        <tr>
                            <td>Afbeelding</td>
                            <td>Naam</td>
                            <td>Categorie</td>
                            <td>Aantal</td>
                            <td>Prijs</td>
                            <td>Gemaakt door</td>
                            <td>Status</td>
                        </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td class="backend-td-img"><img class="backend-image" src="./storage/media/{{ $product->productImage }}"></td>
                            <td>
                                {{ $product->productName }}
                                <div>
                                    <a href="{{ route('product_details', ['slug' => $product->productSlug]) }}" class="backend-crud" style="color: blue;">Bekijken</a>
                                    <a href="{{ route('edit_products') }}?id={{$product->productID}}" class="backend-crud" style="color: green;">Bewerken</a>
                                    <a onclick="checkifdelete('{{ $product->productName }}', {{$product->productID}});" class="backend-crud" style="color: red; cursor: pointer;">Verwijderen</a>
                                </div>
                            </td>
                            <td>
                                @foreach ($categories as $category)
                                    @if ($category->categoryID == $product->category_ID)
                                        {{ $category->categoryName }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $product->productQuantity }}</td>
                            <td>€ {{ $product->productPrice }}</td>
                            <td>
                                @foreach ($users as $user)
                                    @if ($user->id === $product->createdBy)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if ($product->productStatus === 1)
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
            window.location.href = `/products/delete?id=${id}`;
            console.log(`${naam} was removed to the database.`);
        }
    }

    const filter = () => {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("p_table");
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
