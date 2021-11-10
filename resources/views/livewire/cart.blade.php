<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-3">
                        <h2 class="font-weight-bold">Product List</h2>
                    </div>
                    <div class="col-md-9">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search Product....">
                    </div>
                </div>
                <br>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/images/'.$product->image) }}" alt="product" style="object-fit:cover;width:100%;height:125px">
                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-weight-bold">{{ $product->name }}</h6>
                                    <h6 class="text-center font-weight-bold">Rp. {{ number_format($product->price,2,',','.') }}</h6>
                                    <button wire:click="addItem({{ $product->id }})" class="btn btn-primary btn-sm btn-block">Buy</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <h2 class="text-center font-weight-bold text-danger">No Product</h2>
                        </div>
                    @endforelse
                </div>
            </div>
            <div style="display:flex;justify-content:center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">
                    Cart 
                </h2>
                <p class="text-danger font-weight-bold">
                    @if(session()->has('error'))
                        {{ session('error') }}
                    @endif
                </p>
                <table class="table table-sm table-bordered table-striped table-hovered">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Jumlah</th>
                            <th>Price</th>
                            <th>*</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($carts as $index=>$cart)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cart['name'] }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" style="padding:7px 10px" wire:click="increaseItem('{{$cart['rowId']}}')"><i class="fas fa-plus"></i></button>
                                        {{$cart['qty']}}
                                    <button class="btn btn-info btn-sm" style="padding:7px 10px"  wire:click="decreaseItem('{{$cart['rowId']}}')"><i class="fas fa-minus"></i></button>
                                </td>
                                <td>Rp. {{ number_format($cart['price'],2,',','.') }}</td>
                                <td>
                                    <button href="#" wire:click="removeItem('{{ $cart['rowId'] }}')" class="font-weight-bold text-danger" style="font-size:13px;cursor:pointer">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5"> <h6 class="text-center">Empty Cart</h6> </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="font-weight-bold">Cart Summary</h4>
                <h5 class="font-weight-bold">Sub Total: Rp. {{ number_format($summary['sub_total'],2,',','.') }}</h5>
                <h5 class="font-weight-bold">Tax: Rp. {{ number_format($summary['pajak'],2,',','.') }}</h5>
                <h5 class="font-weight-bold">Total: Rp. {{ number_format($summary['total'],2,',','.') }}</h5>
                {{-- <div>
                    <button wire:click="enableTax" class="btn btn-info btn-block">Add Pajak</button>
                    <br>
                    <button wire:click="disableTax" class="btn btn-danger btn-block">Remove Pajak</button>
                </div> --}}
                <div class="form-group mt-4">
                    <input type="number" wire:model="payment" class="form-control" id="payment" placeholder="Input customer payment amount">
                    <input type="hidden" id="total" value="{{$summary['total']}}">
                  </div>
    
                    <form wire:submit.prevent="handleSubmit">
                        <div>
                            <label >Payment</label>
                            <h1 id="paymentText" wire:ignore>Rp. 0</h1>
                        </div>
    
                        <div>
                            <label >kembalian</label>
                            <h1 id="kembalianText" wire:ignore>Rp. 0</h1>
                        </div>
                    
                        <div class="mt-4">
                            <button wire:ignore type="submit" id="saveButton" disabled class="btn btn-success btn-block" id="saveButton"><i class="fas fa-save fa-lg"></i> Save Transaction</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@push('script-custom')

<script>
    payment.oninput = () => {
        const paymentAmount = document.getElementById("payment").value
        const totalAmount = document.getElementById("total").value
        const kembalian = paymentAmount - totalAmount
        document.getElementById("kembalianText").innerHTML = `Rp ${rupiah(kembalian)} ,00`
        document.getElementById("paymentText").innerHTML = `Rp ${rupiah(paymentAmount)} ,00`
        const saveButton =  document.getElementById("saveButton")
        if(kembalian < 0){
            saveButton.disabled = true
        }else{
            saveButton.disabled = false
        }
    }
    const rupiah = (angka) => {
        const numberString = angka.toString()
        const split = numberString.split(',')
        const sisa = split[0].length % 3
        let rupiah = split[0].substr(0, sisa)
        const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)
        if(ribuan){
            const separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }
        return split[1] != undefined ? rupiah + ',' + split[1] : rupiah
    }
</script>
    
@endpush