<!DOCTYPE html>
<html lang="en">
    @include('layouts/head')
<body>
    @include('layouts/header')

    <div class="content-wrap head">
        <div class="content-wrapper head_text">Welkom bij Van Duren Mechanics</div>
    </div>

    <div class="content-wrap">
        <div class="content-wrapper flex-box" style="margin-left: 20px">
            <div class="productgrid-3" style="width:100%">
                @foreach ($categories as $category)
                    <div class="category">
                        <a href="/store?cat={{$category->categorySlug}}" style="text-decoration: none">
                            <img class="categoryimage" src="./storage/media/{{$category->categoryImage}}">
                            <div class="categorytitle">
                                {{$category->categoryName}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box" style="margin-left: 20px">
            <div class="w-50">
                <div style="display: block; width: 100%;">
                    <h2 class="hero-text">Neem contact met ons op!</h2>
                    <a href="{{ route('contact') }}"><button class="hero-button"><h3>Klik hier</h3></button></a>
                </div>
            </div>
            <div class="w-50">
                <div style="display: block; width: 100%;">
                    <h2 class="hero-text">Bezoek onze winkel!</h2>
                    <a href="{{ route('store') }}"><button class="hero-button"><h3>Shop hier</h3></button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box" style="margin-left: 20px">
            <h2>On Sale:</h2>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <div class="productgrid-4">
                @foreach ($products as $product)
                    @if ($product->productStatus !== 0 && $product->productQuantity > 0 && $product->productSalesprice !== null)
                        <div class="product prodcat_{{$product->category_ID}}" id="prod_{{$product->productID}}">
                            <a class="productlink" href="{{ route('product_details', ['slug' => $product->productSlug]) }}">
                                <img class="productimage unselectable" src="./storage/media/{{$product->productImage}}" alt="{{$product->productName}}">
                                <div class="productname">{{$product->productName}}</div>
                                @if ($product->productSalesprice == null)
                                    <div class="productprice">€{{$product->productPrice}}</div>
                                @else
                                <div class="productprice"><span class="saleprice">€{{$product->productPrice}}</span><span>€{{$product->productSalesprice}}</span></div>
                                @endif
                                @foreach ($categories as $category)
                                    @if ($category->categoryID === $product->category_ID)
                                        <div class="productcat">{{$category->categoryName}}</div>
                                    @endif
                                @endforeach
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        <div>
    </div>
</div>
</div>
@include('layouts/footer')
</body>
</html>
<script>
	const alert = () => {
		alert("This is a not a real webshop\nThis is a school project.");
	}

	window.onload = alert();
</script>
