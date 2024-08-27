

@extends('frontend.layout')

@section('content')
 <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 1.25rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .item-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .input-group-text {
            min-width: 200px; /* Ensure the text fits well */
        }
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Votre Panier</h4>

            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($panier->isEmpty())
                    <div class="alert alert-warning">Votre panier est vide.</div>
                @else
                    <ul class="list-group mb-4" id="cart-items">
                        @foreach ($panier as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($item->attributes->image) }}" alt="Image de l'événement" class="item-image">

                                    <div>
                                        <h5 class="mb-1">{{ $item->name }}</h5>
                                        <small>{{ $item->quantity }} x {{ $item->price }} DH</small>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="mr-2 update-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control quantity-input" aria-label="Quantité" data-item-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Ajouter le nombre de tickets souhaité</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-sm mt-2">Mettre à jour</button>
                                    </form>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mt-2" onclick="return confirmDelete()">Supprimer</button>
                                    </form>
                                </div>
                                <script>

                                </script>
                            </li>
                            <script>

                            </script>
                        @endforeach
                    </ul>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Total :</h4>
                        <h4 id="total">{{$total}} DH</h4>
                    </div>

                    <a href="{{ route('checkout.index', ['id' => $panier->first()->id]) }}" class="btn btn-success">Passer à la caisse</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JS for updating total -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItems = document.querySelectorAll('#cart-items .list-group-item');
            const totalElement = document.getElementById('total');

            function updateTotal() {
                let total = 0;
                cartItems.forEach(item => {
                    const priceElement = item.querySelector('[id^="item-price-"]');
                    const quantityInput = item.querySelector('.quantity-input');
                    const price = parseFloat(priceElement.textContent);
                    const quantity = parseInt(quantityInput.value);
                    total += price * quantity;
                });
                totalElement.textContent = total.toFixed(2) + ' DH';
            }

            cartItems.forEach(item => {
                const quantityInput = item.querySelector('.quantity-input');
                quantityInput.addEventListener('input', updateTotal);
            });

            updateTotal(); // Initial calculation
        });
        function confirmDelete() {
            return confirm('Êtes-vous sûr de vouloir supprimer cet événement ? ');
        }
            </script>




@endsection

