@extends('dashboard.layout')
@section('rentals-active','active')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1>Motorcycle Rentals</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">Rent a Motorcycle</div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Motorcycle</label>
                                        <select class="form-control">
                                            <option>Sport Bike</option>
                                            <option>Cruiser</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary">Submit Rental</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Available Motorcycles</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/path/to/sport-bike.jpg" class="card-img-top" alt="Sport Bike">
                                    <div class="card-body">
                                        <h5 class="card-title">Sport Bike</h5>
                                        <p class="card-text">High-performance racing motorcycle</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0">$99/day</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="/path/to/cruiser.jpg" class="card-img-top" alt="Cruiser">
                                    <div class="card-body">
                                        <h5 class="card-title">Cruiser</h5>
                                        <p class="card-text">Comfortable long-distance motorcycle</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h5 mb-0">$79/day</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Existing code remains the same -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Current Rentals</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Rental ID</th>
                                    <th>Motorcycle</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sport Bike</td>
                                    <td>2024-02-15</td>
                                    <td>2024-02-20</td>
                                    <td><span class="badge bg-warning">Active</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#rentalDetailsModal1">View</button>
                                            <button class="btn btn-sm btn-danger">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Cruiser</td>
                                    <td>2024-02-10</td>
                                    <td>2024-02-15</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#rentalDetailsModal2">View</button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Details Modal 1 -->
            <div class="modal fade" id="rentalDetailsModal1" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rental Details - Sport Bike</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Rental ID</label>
                                        <input type="text" class="form-control" value="#1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Motorcycle</label>
                                        <input type="text" class="form-control" value="Sport Bike" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="text" class="form-control" value="2024-02-15" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="text" class="form-control" value="2024-02-20" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Total Days</label>
                                        <input type="text" class="form-control" value="5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" value="Active" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Total Cost</label>
                                        <input type="text" class="form-control" value="$495.00" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Cancel Rental</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Details Modal 2 -->
            <div class="modal fade" id="rentalDetailsModal2" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rental Details - Cruiser</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Rental ID</label>
                                        <input type="text" class="form-control" value="#2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Motorcycle</label>
                                        <input type="text" class="form-control" value="Cruiser" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="text" class="form-control" value="2024-02-10" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="text" class="form-control" value="2024-02-15" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Total Days</label>
                                        <input type="text" class="form-control" value="5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control" value="Completed" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Total Cost</label>
                                        <input type="text" class="form-control" value="$395.00" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
