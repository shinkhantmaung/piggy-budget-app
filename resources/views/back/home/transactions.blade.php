<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Transactions</h2>
        <a href="{{url('transaction')}}" class="link">View All</a>
    </div>
    <div class="transactions">
        @foreach ($transactions as $item)
            <!-- item -->
            <a href="{{route('transaction.show',$item['id'])}}" class="item">
                <div class="detail">
                    <img src="assets/img/sample/brand/2.jpg" alt="img" class="image-block imaged w48">
                    
                    <div>
                        <strong>{{$item['title']}}</strong>
                        <p>{{$item['type']}}</p>
                    </div>
                </div>
                <div class="right">
                    @if ($item['type']=='income')
                        <div class="price text-success">+ {{number_format($item['amount'],2)}} Ks</div>
                    @else
                        <div class="price text-danger"> - {{number_format($item['amount'],2)}} Ks</div>
                    @endif              
                </div>
            </a>
            <!-- * item -->            
        @endforeach

    </div>
</div>