@extends('admin.template')

@section('titre')

@section('notice')
    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('main')
<div class="container mt-4">
    <h1 class="text-center mb-4 text-primary">Gestion des Réservations</h1>

    <style>
        /* Stylish Font */
        body {
            font-family: 'Times New Roman', serif;
        }

        .status-confirmed {
            color: #28a745; /* Green */
            font-weight: bold;
        }

        .status-cancelled {
            color: #dc3545; /* Red */
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107; /* Yellow */
            font-weight: bold;
        }

        .reservation-status {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }

        /* Table styling */
        .table {
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table thead th {
            font-weight: bold;
        }

        .table td {
            vertical-align: middle;
        }

        /* Form group spacing */
        .form-group {
            margin-bottom: 0;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom de l'Utilisateur</th>
                            <th>Événement</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->user->name ?? 'Utilisateur non disponible' }}</td>
                                <td>{{ $reservation->event->name ?? 'Événement non disponible' }}</td>
                                <td class="reservation-status
                                    @if($reservation->status === 'confirmed') status-confirmed
                                    @elseif($reservation->status === 'cancelled') status-cancelled
                                    @else status-pending
                                    @endif">
                                    {{ ucfirst($reservation->status) }}
                                </td>
                                <td>
                                    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mr-2">
                                            <select name="status" class="form-control">
                                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmer</option>
                                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Annuler</option>
                                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>En Attente</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
