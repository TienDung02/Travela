
@extends('backend.layouts.layout')
@section('title', 'Admin Package Management')
@section('content')
<div class="container mx-auto py-4">
    <!-- PLACES -->
    <div class="mb-10">
        <div class="flex justify-between items-center mb-3">
            <h2 class="">Destinations</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#placeModal" onclick="openPlaceModal()">Add Destination</button>
        </div>
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Country</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($places as $place)
                    <tr>
                        <td class="px-4 py-2">{{ $place->name }}</td>
                        <td class="px-4 py-2">{{ $place->country }}</td>
                        <td class="px-4 py-2">{{ $place->desc }}</td>
                        <td class="px-4 py-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#placeModal"
                                onclick="openPlaceModal({{ $place->toJson() }})">Edit</button>
                            <form action="{{ route('admin.place.destroy', $place->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this destination?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- TOURS -->
    <div class="mb-10">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-xl font-bold">Tours</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tourModal" onclick="openTourModal()">Add Tour</button>
        </div>
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Hotel</th>
                        <th class="px-4 py-2">Rental</th>
                        <th class="px-4 py-2">Tour Guide</th>
                        <th class="px-4 py-2">Places</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tours as $tour)
                    <tr>
                        <td class="px-4 py-2">{{ $tour->name }}</td>
                        <td class="px-4 py-2">{{ $tour->price }}</td>
                        <td class="px-4 py-2">{{ $tour->hotel }}</td>
                        <td class="px-4 py-2">{{ $tour->rental }}</td>
                        <td class="px-4 py-2">{{ $tour->tour_guide }}</td>
                        <td class="px-4 py-2">
                            @if(isset($tourPlaces[$tour->id]))
                                @foreach($tourPlaces[$tour->id] as $placeId)
                                    @php $place = $places->firstWhere('id', $placeId); @endphp
                                    @if($place)
                                        <span class="badge bg-info text-dark">{{ $place->name }}</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#tourModal"
                                onclick="openTourModal({{ $tour->toJson() }}, {{ json_encode($tourPlaces[$tour->id] ?? []) }})">Edit</button>
                            <form action="{{ route('admin.tour.destroy', $tour->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this tour?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- PACKAGES -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-xl font-bold">Packages</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="openPackageModal()">Add Package</button>
        </div>
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 table table-bordered bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Tour</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                    <tr>
                        <td class="px-4 py-2">{{ $package->name }}</td>
                        <td class="px-4 py-2">{{ $package->tour->name ?? '' }}</td>
                        <td class="px-4 py-2">{{ $package->price }}</td>
                        <td class="px-4 py-2">{{ $package->desc }}</td>
                        <td class="px-4 py-2">
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#packageModal"
                                onclick="openPackageModal({{ $package->toJson() }})">Edit</button>
                            <form action="{{ route('admin.package.destroy', $package->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this package?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Place Modal -->
<div class="modal fade" id="placeModal" tabindex="-1" aria-labelledby="placeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Place form content goes here -->
            <form id="placeForm" method="POST" action="{{ route('admin.place.store') }}">
                @csrf
                <input type="hidden" name="_method" id="placeFormMethod" value="POST">
                <input type="hidden" name="id" id="placeId">
                <div class="modal-header">
                    <h5 class="modal-title" id="placeModalLabel">Destination</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body space-y-4">
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name" id="placeName" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Country</label>
                        <input type="text" name="country" id="placeCountry" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Description</label>
                        <textarea name="desc" id="placeDesc" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tour Modal -->
<div class="modal fade" id="tourModal" tabindex="-1" aria-labelledby="tourModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tourForm" method="POST" action="{{ route('admin.tour.store') }}">
                @csrf
                <input type="hidden" name="_method" id="tourFormMethod" value="POST">
                <input type="hidden" name="id" id="tourId">
                <div class="modal-header">
                    <h5 class="modal-title" id="tourModalLabel">Tour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body space-y-4">
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name" id="tourName" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Description</label>
                        <textarea name="desc" id="tourDesc" class="form-control"></textarea>
                    </div>
                    <div>
                        <label class="block font-medium">Price</label>
                        <input type="number" name="price" id="tourPrice" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Hotel</label>
                        <input type="text" name="hotel" id="tourHotel" class="form-control">
                    </div>
                    <div>
                        <label class="block font-medium">Rental</label>
                        <input type="text" name="rental" id="tourRental" class="form-control">
                    </div>
                    <div>
                        <label class="block font-medium">Tour Guide</label>
                        <input type="text" name="tour_guide" id="tourGuide" class="form-control">
                    </div>
                    <div>
                        <label class="block font-medium">Places</label>
                        <select name="places[]" id="tourPlaces" class="form-select" multiple>
                            @foreach($places as $place)
                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Package Modal -->
<div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="packageForm" method="POST" action="{{ route('admin.package.store') }}">
                @csrf
                <input type="hidden" name="_method" id="packageFormMethod" value="POST">
                <input type="hidden" name="id" id="packageId">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body space-y-4">
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name" id="packageName" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Tour</label>
                        <select name="tour_id" id="packageTourId" class="form-select" required>
                            <option value="">Select Tour</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}">{{ $tour->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">Price</label>
                        <input type="number" name="price" id="packagePrice" class="form-control" required>
                    </div>
                    <div>
                        <label class="block font-medium">Description</label>
                        <textarea name="desc" id="packageDesc" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection