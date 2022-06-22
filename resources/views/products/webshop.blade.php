<!DOCTYPE html>
<html lang="en">
    @include('layouts/head')
<body>
    @include('layouts/header')

    <div class="content-wrap head">
        <div class="content-wrapper head_text">Store</div>
    </div>

    <div class="content-wrap">
        <div class="content-wrapper flex-box" style="margin-left: 20px">
            <h2>Onze Producten</h2>
        </div>
    </div>
    <div class="content-wrap">
        <div class="content-wrapper flex-box">
            <div class="productgrid-3">
                @foreach ($products as $product)
                    @if ($product->productStatus !== 0 && $product->productQuantity > 0)
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
            <div class="productfilters">
                <h3>Filter(s):</h3>
                @foreach ($categories as $category)
                    @if ($category->categoryStatus !== 0)
                        <div class="flex-box productfilter" id="cat_{{$category->categoryID}}">
                            <input class="productfilter_item {{$category->categorySlug}}" type="checkbox" onclick="productfilter()" name="{{$category->categoryName}}" value="{{$category->categoryID}}">
                            <div class="categoryname">{{$category->categoryName}}</div>
                        </div>
                    @endif
                @endforeach
                <div class="resetfilterdiv">
                    <button class="resetfilters" onclick="resetfilter()">Reset Filter(s)</button>
                </div>
            </div>
        <div>
    </div>
</div>
<p class="filtercat" style="display: none;">{{ request()->get('cat') }}</p>
</div>
@include('layouts/footer')
</body>
</html>
<script>
    const GetItem = () => {
    var list = document.getElementsByTagName("p");
    for (let item of list) {
        document.querySelectorAll(`.productfilter_item`).forEach(filter => {
            filter.classList.forEach(classes => {
                if(classes === item.innerText) {
                    filter.checked = true;
                }
            })
        })
    }
    productfilter();
}

window.onload = GetItem();

</script>
