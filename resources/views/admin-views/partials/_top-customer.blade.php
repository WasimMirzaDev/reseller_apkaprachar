<!-- Header -->

<style>
    .table td {
        vertical-align: middle;
        font-weight: 500;
        text-align: center;
    }

    .table th {
        font-size: 16px;
        font-weight: 700;
    }

    .avatar-lg {
        width: 36px;
        height: 36px;
        min-width: 36px;
    }

    .badge-success {
        background-color: #a0ffa0;
        color: #04a704;
        border: 1px solid #04a704;
        padding: 6px 10px 4px;
    }

    .badge-primary {
        background-color: #a6c5fd;
        color: #003dad;
        border: 1px solid #003dad;
        padding: 6px 10px 4px;
    }

    .badge-pink {
        background-color: #fdc3fa;
        color: #a704a1;
        border: 1px solid #a704a1;
        padding: 6px 10px 4px;
    }

    ::-webkit-scrollbar {
        height: 3px;
    }
</style>

<div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="{{asset('/public/assets/back-end/img/top-customers.png')}}" alt="">
        {{translate('top_customer')}}
    </h4>
</div>
<div class="card-body">
    @if($top_customer)
        <div class="table-responsive">
            <table class="table table-striped table-hover align-items-center text-center">
                <thead>
                    <tr>
                        <th colspan="2">Customer Name</th>
                        <th>Last Order Status</th>
                        <th>Email</th>
                        <th>Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($top_customer as $key => $item)
                        @if(isset($item->customer))
                            <tr class="cursor-pointer"
                                onclick="location.href='{{route('admin.customer.view', [$item['customer_id']])}}'">
                                <td class="text-right">
                                    <img class="avatar rounded-circle avatar-lg "
                                        src="{{getValidImage(path: 'storage/app/public/profile/' . $item->customer->image, type: 'backend-profile')}}"
                                        alt="">
                                </td>
                                <td class="text-left" style="padding-left: 10px; min-width: 100px;">
                                    {{$item->customer['f_name'] ?? 'Not exist'}}
                                    <br>
                                    <small style="font-size: 13px;">lorem span</small>
                                </td>
                                <td><span class="badge badge-pill badge-success">SuccessFull</span></td>
                                <td><span class="badge badge-pill badge-primary">ABC@gmail.com</span></td></td>
                                <td><span class="badge badge-pill badge-pink"> Order : {{$item['count']}}</span></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center">
            <p class="text-muted">{{translate('no_Top_Selling_Products')}}</p>
            <img class="w-75" src="{{asset('/public/assets/back-end/img/no-data.png')}}" alt="">
        </div>
    @endif
</div>



<!-- Header -->
<!-- <div class="card-header">
    <h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">
        <img src="{{asset('/public/assets/back-end/img/top-customers.png')}}" alt="">
        {{translate('top_customer')}}
    </h4>
</div>
<div class="card-body">
    @if($top_customer)
        <div class="grid-card-wrap">
            @foreach($top_customer as $key=>$item)
                @if(isset($item->customer))
                    <div class="cursor-pointer"
                         onclick="location.href='{{route('admin.customer.view',[$item['customer_id']])}}'">
                        <div class="grid-card basic-box-shadow">
                            <div class="text-center">
                                <img class="avatar rounded-circle avatar-lg"
                                     src="{{getValidImage(path: 'storage/app/public/profile/'.$item->customer->image,type:'backend-profile')}}"
                                     alt="">
                            </div>

                            <h5 class="mb-0">{{$item->customer['f_name']??'Not exist'}}</h5>

                            <div class="orders-count d-flex gap-1">
                                <div>{{translate('orders')}} : </div>
                                <div>{{$item['count']}}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center">
            <p class="text-muted">{{translate('no_Top_Selling_Products')}}</p>
            <img class="w-75" src="{{asset('/public/assets/back-end/img/no-data.png')}}" alt="">
        </div>
    @endif
</div> -->