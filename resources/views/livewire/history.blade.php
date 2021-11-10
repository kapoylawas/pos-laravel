<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Transaction</h2>
                    <table class="table table-bordered table-hovered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Name Pembeli</th>
                                <th>Pembayaran</th>
                                <th>Total Bayar</th>
                                <th>Tanggal Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index=>$transaction )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaction->invoice_number }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ number_format($transaction->pay,2,',','.') }}</td>
                                <td>{{ $transaction->total }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Product Sell</h2>
                    <table class="table table-bordered table-hovered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Product</th>
                                <th>Invoice</th>
                                <th>Jumlah</th>
                                <th>Tanggal Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index=>$product )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->invoice_number	 }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
