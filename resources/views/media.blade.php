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
                    <div class="productgrid-6">
                        @foreach($media as $key => $name)
                            @if ($name !== '.gitignore')
                                <div style="cursor: pointer" class="media_item" onclick="openmodal('{{$name}}')">
                                    <img onchange="getMeta(this)" class="media_img" src="../storage/{{ $name }}" alt="" title="" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span onclick="closemodal()" class="close">&times;</span>
                            <div style="display: flex">
                                <div style="width:50%"><img id="modal_img"></div>
                                <div style="width:50%; display: flex; align-items: center;">
                                    <div>
                                        <p id="modal_name"></p>
                                        <p id="modal_type"></p>
                                        <p id="modal_size"></p>
                                        <p id="modal_link"></p>
                                        <button style="border: 1px solid black; width: 100%;" onclick="copyLink()">Kopieer link</button>
                                        <a id="watch_img" target="_blank" style="color: blue;">Bekijk afbeelding</a>
                                        <a id="delete_img" style="color: red;">Verwijder afbeelding</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    var modal = document.getElementById("myModal");
    const openmodal = (item) => {
        var naam = item.replace('media/','');

        // console.log(locatie)
        document.getElementById("modal_img").src = "./storage/" + item;

        // console.log(document.getElementById("modal_  img").toDataURL());
        document.getElementById("modal_name").innerText = `Bestandnaam: ${naam}`;
        document.getElementById("modal_type").innerText = `Type: `;
        document.getElementById("modal_size").innerText = `Bestandgrootte: `;
        document.getElementById("modal_link").innerText = `URL: http://localhost:8000/storage/media/${naam}`;
        document.getElementById("watch_img").href = `http://localhost:8000/storage/media/${naam}`;
        document.getElementById("delete_img").href = `#`;

        modal.style.display = "block";
    }

    const closemodal = () => {
        modal.style.display = "none";
    }

    const copyLink = () => {
        var modallink = document.getElementById('modal_link').innerText;
        var link = modallink.replace('URL: ', '');
        navigator.clipboard.writeText(link);
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
