<!DOCTYPE html>
@foreach ($product as $p)
    <input id="concept" type="hidden" value="{{ $p->productStatus }}">
    <script>
        if (document.getElementById('concept').value == 0) {
            window.location.href = "/store";
        }
    </script>
@endforeach
<html lang="en">
@include('layouts/head')
<body>
    @include('layouts/header')

    @foreach ($product as $prod)
    <input id="concept" type="hidden" value="{{ $prod->productStatus }}">
    <script>
        if (document.getElementById('concept').value == 0) {
            window.location.href = "/store";
        }
    </script>

    <div class="content-wrap head">
        <div class="content-wrapper head_text">{{$prod->productName}}</div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <span class="breadcrum">
                <a href="/">Home</a>
                 »
                <a href="/store">Store</a>
                 »
                @foreach ($categories as $category)
                    @if ($category->categoryID == $prod->productID)
                        <a href="/store?cat={{ $category->categorySlug }}">{{ $category->categoryName }}</a> »
                    @endif
                @endforeach
                {{$prod->productName}}
            </span>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <div class="productdetails">
                <img class="productimg" src="../storage/media/{{$prod->productImage}}">
            </div>
            <div class="productdetails">
                <h2>{{$prod->productName}}</h2>
                {!!$prod->productShortDescription!!}
                @foreach ($categories as $category)
                    @if ($category->categoryID == $prod->productID)
                        <p>{{ $category->categoryName }}</p>
                    @endif
                @endforeach
                @if ($prod->productSalesprice == null)
                    <div style="text-align: left;" class="productprice"><h3>€{{$prod->productPrice}}</h3></div>
                @else
                    <div style="text-align: left;" class="productprice"><h3><span class="saleprice">€{{$prod->productPrice}}</span><span>€{{$prod->productSalesprice}}</span></h3></div>
                @endif

                <div class="tab">
                    <button class="tablinks active" onclick="tabs(event, 'Lange_Beschrijving')">Beschrijving</button>
                    <button class="tablinks" onclick="tabs(event, 'Eigenschappen')">Eigenschappen</button>
                    <button class="tablinks" onclick="tabs(event, 'Beoordelingen')">Beoordelingen</button>
                  </div>

                  <div id="Lange_Beschrijving" class="tabcontent" style="display: block">
                    <p>{!!$prod->productLongDescription!!}</p>
                  </div>

                  <div id="Eigenschappen" class="tabcontent">
                    <table class="property_table">
                        @foreach ($properties as $prop)
                            @if ($prop->productID === $prod->productID)
                                @if ($prop->color !== null)
                                    <tr class="property_row">
                                        <td class="property">Kleur</td>
                                        <td class="property">{{ $prop->color }}</td>
                                    </tr>
                                @endif
                                @if ($prop->type !== null)
                                    <tr class="property_row">
                                        <td class="property">Type</td>
                                        <td class="property">{{ $prop->type }}</td>
                                    </tr>
                                @endif
                                @if ($prop->material !== null)
                                    <tr class="property_row">
                                        <td class="property">Materiaal</td>
                                        <td class="property">{{ $prop->material }}</td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </table>
                  </div>

                  <div id="Beoordelingen" class="tabcontent">
                    <p style="display: none">{{ $i = 1 }}</p>
                    @foreach ($reviews as $review)
                        @if ($review->productID === $prod->productID && $i <= 5)
                            <div class="review">
                                <div class="star_review">
                                    @for ($x = 1; $x <= 5; $x++)
                                    @if ($x <= $review->starRating)
                                        <s style="text-decoration: none;"></s>
                                    @else
                                        <s style="color:black; text-decoration: none;"></s>
                                    @endif

                                    @endfor
                                </div>
                                <span>{{$review->reviewMessage}}</span>
                                <p style="display: none">{{ $i++ }}</p>
                            </div>
                        @elseif ($review->productID === $prod->productID && $i == 6)
                            <p>Lees meer reviews</p>
                        @endif
                    @endforeach
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <form action="{{ route('post_review') }}" method="POST">
                        @csrf
                        <input type="hidden" name="p_id" value="{{$prod->productID}}">
                        <input type="hidden" name="p_slug" value="{{$prod->productSlug}}">
                        <div class="star-rating">
                            <p>Je waardering *</p>
                            <s><s><s><s><s></s></s></s></s></s>
                        </div>
                        <input name="review_star_rating" type="hidden" id="stars">
                        <p>Je beoordeling *</p>
                        <textarea name="review_message" style="width: 100%; height: 200px"></textarea>
                        <input type="submit" value="Versturen">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <h2>Gerelateerde producten:</h2>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <div class="productgrid-3">
                @foreach ($products as $p)
                    @if ($p->category_ID == $prod->category_ID && $p->productName !== $prod->productName)
                    <div class="product prodcat_{{$p->category_ID}}" id="prod_{{$p->productID}}">
                        <a class="productlink" href="{{ route('product_details', ['slug' => $p->productSlug]) }}">
                            <img class="productimage unselectable" src="../storage/media/{{$p->productImage}}" alt="{{$p->productName}}">
                            <div class="productname">{{$p->productName}}</div>
                            @if ($p->productSalesprice == null)
                                <div class="productprice">€{{$p->productPrice}}</div>
                            @else
                            <div class="productprice"><span class="saleprice">€{{$p->productPrice}}</span><span>€{{$p->productSalesprice}}</span></div>
                            @endif
                            @foreach ($categories as $c)
                                @if ($c->categoryID === $p->category_ID)
                                    <div class="productcat">{{$c->categoryName}}</div>
                                @endif
                            @endforeach
                        </a>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    @include('layouts/footer')
</body>
</html>
<script>
    const tabs = (evt, item) => {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(item).style.display = "block";
      evt.currentTarget.className += " active";
    }

    $(function() {
            $("div.star-rating > s, div.star-rating-rtl > s").on("click", function(e) {

            // remove all active classes first, needed if user clicks multiple times
            $(this).closest('div').find('.active').removeClass('active');

            $(e.target).parentsUntil("div").addClass('active'); // all elements up from the clicked one excluding self
            $(e.target).addClass('active');  // the element user has clicked on


                var numStars = $(e.target).parentsUntil("div").length+1;
                // $('.show-result').text(numStars + (numStars == 1 ? " star" : " stars!"));
                document.getElementById('stars').value = numStars;
            });
    });
</script>
