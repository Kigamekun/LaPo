<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <br>
    <br>
    <br>
    <div class="container">
        <div class="d-flex justify-content-end"><button class=" btn btn-success">
                Your Point : {{ Auth::user()->points }}
            </button></div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">

                <div class="d-flex flex-wrap gap-5">
                    @foreach (DB::table('items')->get() as $item)
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $item->price }} points</h6>
                                <a href="{{ route('transaction.make', ['id' => $item->id]) }}" class="card-link">Buy</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transaction Code</th>
                            <th scope="col">Item</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (DB::table('transactions')->get() as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->transaction_code }}</td>
                                <td>{{ DB::table('items')->where('id',$item->item_id)->first()->name }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (!is_null(Session::get('message')))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: @json(Session::get('status')),
                title: @json(Session::get('status')),
                html: @json(Session::get('message')),
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif

</x-app-layout>
