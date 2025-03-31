@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý Khuyến mãi</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Loại giảm giá</th>
                            <th>Giá trị</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>
                                    @if($promotion->discount_type == 'percentage')
                                        Giảm {{ $promotion->discount_value }}%
                                    @else
                                        Giảm {{ number_format($promotion->discount_value) }}đ
                                    @endif
                                </td>
                                <td>
                                    @if($promotion->min_order_amount)
                                        Đơn tối thiểu: {{ number_format($promotion->min_order_amount) }}đ<br>
                                    @endif
                                    @if($promotion->max_discount_amount)
                                        Giảm tối đa: {{ number_format($promotion->max_discount_amount) }}đ
                                    @endif
                                </td>
                                <td>
                                    {{ $promotion->start_date->format('d/m/Y') }} -
                                    {{ $promotion->end_date->format('d/m/Y') }}
                                </td>
                                <td>
                                    @if($promotion->end_date < now())
                                        <span class="badge bg-secondary">Hết hạn</span>
                                    @elseif($promotion->start_date > now())
                                        <span class="badge bg-info">Sắp diễn ra</span>
                                    @else
                                        <span class="badge bg-success">Đang diễn ra</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $promotions->links() }}
            </div>
        </div>
    </div>
@endsection