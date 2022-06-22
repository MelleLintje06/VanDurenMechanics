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
                        @foreach ($product as $prod)
                        <form action="/products/edit" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input class="input_files" type="hidden" name="p_id" value="{{$prod->productID}}">
                            <label><div>Productnaam</div>
                                <input class="input_files" onkeyup="createslug(this.value)" type="text" name="p_name" value="{{$prod->productName}}">
                                <input class="input_files" id="p_slug" type="hidden" name="p_slug" value="{{$prod->productSlug}}">
                            </label>
                            <label><div>Prijs</div>
                                <input class="input_files" type="text" name="p_price" value="{{$prod->productPrice}}">
                            </label>
                            <label><div>Sale Prijs</div>
                                <input class="input_files" type="text" name="p_saleprice" value="{{$prod->productSalesprice}}">
                            </label>
                            <label><div>Aantal</div>
                                <input class="input_files" type="number" name="p_quantity" value="{{$prod->productQuantity}}">
                            </label>
                            <label><div>Merk</div>
                                <input class="input_files" type="text" name="p_brand" value="{{$prod->productBrand}}">
                            </label>
                            <label><div>Korte Beschrijving (mag HTML bevatten)</div>
                                <textarea class="input_files" style="height: 200px;" type="text" name="p_sd">
                                    {{$prod->productShortDescription}}
                                </textarea>
                            </label>
                            <label><div>Lange Beschrijving (mag HTML bevatten)</div>
                                <textarea class="input_files" style="height: 200px;" type="text" name="p_ld">
                                    {{$prod->productLongDescription}}
                                </textarea>
                            </label>
                            <label><div>Eigenschappen</div>
                                <div>
                                    @foreach ($property as $pp)
                                        <p>Kleur:</p>
                                        <input class="input_files" type="text" name="pp_color" value="{{ $pp->color }}">
                                        <p>Type:</p>
                                        <input class="input_files" type="text" name="pp_type" value="{{ $pp->type }}">
                                        <p>Materiaal:</p>
                                        <input class="input_files" type="text" name="pp_material" value="{{ $pp->material }}">
                                    @endforeach
                                </div>
                            </label>
                            <label><div>Afbeelding</div>
                                <input class="input_files" type="file" accept="image/png, image/jpeg, image/jpg" name="p_img" value="../../media/{{$prod->productImage}}">
                            </label>
                            <label><div>Categorie</div>
                                <select class="input_files" name="p_cat">
                                    @foreach ($categories as $cat)
                                        @if ($cat->categoryID === $prod->category_ID)
                                            <option selected value="{{$cat->categoryID}}">{{$cat->categoryName}}</option>
                                        @else
                                            <option value="{{$cat->categoryID}}">{{$cat->categoryName}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </label>
                            <label><div>Gemaakt door</div>
                                <select class="input_files" name="p_mb">
                                    @foreach ($users as $user)
                                    @if ($user->id === $prod->createdBy)
                                        <option selected value="{{ $user->id }}">{{$user->name}}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </label>
                            <label><div>Status</div>
                                <select class="input_files" name="p_status">
                                    <option value="0">Concept</option>
                                    @if ($prod->productStatus === 0)
                                        <option value="1">Gepubliceerd</option>
                                    @else
                                        <option value="1" selected>Gepubliceerd</option>
                                    @endif

                                </select>
                            </label>

                            <label>
                                <input class="input_files" style="margin-top: 10px; border: 1px solid black; cursor: pointer;" type="submit" value="Publiceren">
                            </label>
                        </form>
                        @endforeach
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
    }z
</script>
