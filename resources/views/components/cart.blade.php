<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items" id="cart_count">{{ $items->count() }}</span>
    </a>

    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $items->count() }} Items</span>
            <a href="{{ route('user.cart.index') }}">View Cart</a>
        </div>
        <ul class="shopping-list">
            @foreach ($items as $item)
                <li class="item_cart">
                    <a href="#" onclick="remove({{ $item->product_id }},this)" class="remove"
                        title="Remove this item"><i class="lni lni-close"></i></a>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{ route('user.products.show', $item->product->slug) }}"><img
                                src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>
                    <div class="content">
                        <h4><a
                                href="{{ route('user.products.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                        </h4>
                        <p class="quantity">{{ $item->quantity }}x - <span
                                class="amount">{{ Currency::format($item->product->price) }}</span></p>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ Currency::format($total) }}</span>
            </div>
            <div class="button">
                <a href="{{ route('user.checkout.create') }}" class="btn animate">Checkout</a>
            </div>
        </div>
    </div>
    <!--/ End Shopping Item -->


</div>

<script src="{{ asset('assets/js/axios.min.js') }}"></script>
<script>
    function remove(id, reference) {
        axios.delete('/store/cart/' + id)
            .then(function(response) {
                // handle success
                console.log(response);
                reference.closest('.item_cart').remove();
                var span = document.getElementById('cart_count');
                span.innerText = response.data.items;
                // alert(span);
                // span.innerHTML = span.textContent;
                // $items = response.data.items;
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            })
            .finally(function() {
                // always executed
            });
    }
</script>
