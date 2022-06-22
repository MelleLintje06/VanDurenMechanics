<!DOCTYPE html>
<html lang="en">
    @include('layouts/head')
<body>
    @include('layouts/header')

    <div class="content-wrap head">
        <div class="content-wrapper head_text">Contact</div>
    </div>

    <div class="content-wrap">
        <div class="content-wrapper">
            <div class="contact-form">
                <form action="{{ route('post_contact') }}" class="contact_form" method="POST">
                    @csrf
                    <label><p>Naam</p></label>
                    <input type="text" name="c_name" placeholder="Uw naam"></input>
                    <label><p>Email</p></label>
                    <input type="email" name="c_email" placeholder="Uw email"></input>
                    <label><p>Onderwerp</p></label>
                    <input type="text" name="c_topic" placeholder="Uw onderwerp"></input>
                    <label><p>Bericht</p></label>
                    <textarea style="width: 100%; height: 200px;" name="c_message" placeholder="Uw bericht"></textarea>

                    <input type="submit" value="Versturen">
                </form>
            </div>
        </div>
    </div>

    @include('layouts/footer')
</body>
</html>
