<x-app-layout>
    @include('layouts/head')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Van Duren Mechanics') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/styles.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <form action="{{ route('post_product') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <label><div>Productnaam</div>
                                <input class="input_files" onkeyup="createslug(this.value)" type="text" name="p_name">
                                <input class="input_files" id="p_slug" type="hidden" name="p_slug">
                            </label>
                            <label><div>Prijs</div>
                                <input class="input_files" type="text" name="p_price">
                            </label>
                            <label><div>Sale Prijs</div>
                                <input class="input_files" type="text" name="p_saleprice">
                            </label>
                            <label><div>Aantal</div>
                                <input class="input_files" type="number" name="p_quantity">
                            </label>
                            <label><div>Merk</div>
                                <input class="input_files" type="text" name="p_brand">
                            </label>
                            <label><div>Korte Beschrijving (mag HTML bevatten)</div>
                                <textarea class="input_files" style="height: 200px;" type="text" name="p_sd"></textarea>
                            </label>
                            <label><div>Lange Beschrijving (mag HTML bevatten)</div>
                                <textarea class="input_files" style="height: 200px;" type="text" name="p_ld"></textarea>
                            </label>
                            <label><div>Categorie</div>
                                <select class="input_files" name="p_cat">
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->categoryID }}">{{$cat->categoryName}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label><div>Gemaakt door</div>
                                <select class="input_files" name="p_cb">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label><div>Afbeelding</div>
                                <input class="input_files" type="file" accept="image/png, image/jpeg, image/jpg" name="p_img">
                            </label>
                            <label><div>Status</div>
                                <select class="input_files" name="p_status">
                                    <option value="0">Concept</option>
                                    <option value="1">Gepubliceerd</option>
                                </select>
                            </label>

                            <label>
                                <input class="input_files" style="margin-top: 10px; border: 1px solid black; cursor: pointer;" type="submit" value="Publiceren">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const createslug = (value) => {
        var text = value.toLowerCase();
        text = text.replace(/\s+/g, '-');
        document.getElementById('p_slug').value = text;
    }
</script>
