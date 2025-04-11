<div class="row mb-30">
    <div class="col-sm">
        <nav class="navbar navbar-expand-xl navbar-dark bg-dark navbar-demo" style="border-radius:5px;    background: rgb(63, 151, 119);
                                            background: linear-gradient(
                                                330deg,
                                                rgb(89, 182, 205) 56%,
                                                rgb(38, 177, 205) 100%
                                                );">
            <div class="collapse navbar-collapse" id="navbarSupportedColor1">
                <ul class="navbar-nav">
                    <li id="delivered" class="nav-item">
                        <a id="head-input-total" class="nav-link delivered text-white">Tổng Số Tiền
                            Đã
                            Thanh Toán:
                            <span id="inputTotal">{{number_format($total)}}đ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <table class="table table-hover w-100 display">
                <thead id="header-member">
                    <tr>
                        <th>STT</th>
                        <th>Hình Ảnh</th>
                        <th>Họ Tên</th>
                        <th>Lượng Đơn</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody id="top-member">
                    @if($topMembers==[])
                    <tr class="odd">
                        <td valign="top" colspan="6" class="text-center dataTables_empty">Danh sách
                            trống</td>
                    </tr>
                    @else
                    <p class="d-none">{{$i=1}}</p>
                    @foreach($topMembers as $member)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img class="avatar-xl circle" style="width:50px;height:50px"
                                src="{{env('APP_URL')}}/upload/avatar_users/{{$member['user']['image']}}">
                        </td>
                        <td>{{$member['user']['full_name']}}</td>
                        <td>{{$member['quantity_bill']}}</td>
                        <td>{{number_format($member['total_bill'])}}đ</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
