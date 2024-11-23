    @extends('dashboard.layout')

    @section('events-active', 'active')

    @section('content')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Event Management</h3>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">
                                    <i class="fas fa-plus"></i> Create New Event
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="eventsTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Fee</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->description }}</td>
                                            <td>{{ $event->location }}</td>
                                            <td>{{ $event->start_date->format('F j, Y') }}</td>
                                            <td>{{ $event->end_date->format('F j, Y') }}</td>
                                            <td>${{ number_format($event->fee, 2) }}</td>
                                            <td>
                                                    <span class="badge {{ $event->status == 'upcoming' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($event->status) }}
                                                    </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- View Button -->
                                                    <button class="btn btn-info btn-sm me-1 view-event-btn"
                                                            data-id="{{ $event->id }}"
                                                            data-name="{{ $event->name }}"
                                                            data-description="{{ $event->description }}"
                                                            data-location="{{ $event->location }}"
                                                            data-start-date="{{ $event->start_date->format('Y-m-d\TH:i') }}"
                                                            data-end-date="{{ $event->end_date->format('Y-m-d\TH:i') }}"
                                                            data-fee="{{ $event->fee }}"
                                                            data-status="{{ $event->status }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewEventModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Edit Button -->
                                                    <button class="btn btn-secondary btn-sm me-1 edit-event-btn"
                                                            data-id="{{ $event->id }}"
                                                            data-name="{{ $event->name }}"
                                                            data-description="{{ $event->description }}"
                                                            data-location="{{ $event->location }}"
                                                            data-start-date="{{ $event->start_date->format('Y-m-d\TH:i') }}"
                                                            data-end-date="{{ $event->end_date->format('Y-m-d\TH:i') }}"
                                                            data-fee="{{ $event->fee }}"
                                                            data-status="{{ $event->status }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editEventModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm delete-event-btn" onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Event Modal -->
            <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="createEventModalLabel">Create New Event</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('events.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-name" class="form-label">Event Name</label>
                                        <input type="text" name="name" class="form-control" id="create-event-name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-location" class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" id="create-event-location" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="create-event-description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="create-event-description" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-start-date" class="form-label">Start Date</label>
                                        <input type="datetime-local" name="start_date" class="form-control" id="create-event-start-date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-end-date" class="form-label">End Date</label>
                                        <input type="datetime-local" name="end_date" class="form-control" id="create-event-end-date" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-fee" class="form-label">Event Fee ($)</label>
                                        <input type="number" name="fee" class="form-control" id="create-event-fee" step="0.01" min="0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="create-event-status" class="form-label">Event Status</label>
                                        <select name="status" class="form-select" id="create-event-status">
                                            <option value="upcoming" selected>Upcoming</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Create Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Event Modal -->
            <div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="viewEventModalLabel">Event Details</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 id="view-event-name"></h4>
                            <p id="view-event-description"></p>
                            <p><strong>Location:</strong> <span id="view-event-location"></span></p>
                            <p><strong>Start Date:</strong> <span id="view-event-start-date"></span></p>
                            <p><strong>End Date:</strong> <span id="view-event-end-date"></span></p>
                            <p><strong>Fee:</strong> $<span id="view-event-fee"></span></p>
                            <p><strong>Status:</strong> <span id="view-event-status" class="badge"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Event Modal -->
            <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('events.update', ':id') }}" method="POST" id="editEventForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-name" class="form-label">Event Name</label>
                                        <input type="text" name="name" class="form-control" id="edit-event-name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-location" class="form-label">Location</label>
                                        <input type="text" name="location" class="form-control" id="edit-event-location" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-event-description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="edit-event-description" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-start-date" class="form-label">Start Date</label>
                                        <input type="datetime-local" name="start_date" class="form-control" id="edit-event-start-date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-end-date" class="form-label">End Date</label>
                                        <input type="datetime-local" name="end_date" class="form-control" id="edit-event-end-date" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-fee" class="form-label">Event Fee ($)</label>
                                        <input type="number" name="fee" class="form-control" id="edit-event-fee" step="0.01" min="0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-event-status" class="form-label">Event Status</label>
                                        <select name="status" class="form-select" id="edit-event-status">
                                            <option value="upcoming">Upcoming</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Event</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // View Event Modal
                const viewEventModal = document.getElementById('viewEventModal');
                viewEventModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const eventId = button.dataset.id;
                    const eventName = button.dataset.name;
                    const eventDescription = button.dataset.description;
                    const eventLocation = button.dataset.location;
                    const eventStartDate = button.dataset.startDate;
                    const eventEndDate = button.dataset.endDate;
                    const eventFee = button.dataset.fee;
                    const eventStatus = button.dataset.status;

                    // Populate the modal
                    document.getElementById('view-event-name').textContent = eventName;
                    document.getElementById('view-event-description').textContent = eventDescription;
                    document.getElementById('view-event-location').textContent = eventLocation;
                    document.getElementById('view-event-start-date').textContent = new Date(eventStartDate).toLocaleString();
                    document.getElementById('view-event-end-date').textContent = new Date(eventEndDate).toLocaleString();
                    document.getElementById('view-event-fee').textContent = `${eventFee}`;
                    document.getElementById('view-event-status').textContent = eventStatus;

                    // Dynamic status badge class
                    const statusBadge = document.getElementById('view-event-status');
                    statusBadge.className = `badge ${eventStatus === 'upcoming' ? 'bg-success' : 'bg-secondary'}`;
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const editEventModal = document.getElementById('editEventModal');
                editEventModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    // Retrieve data attributes
                    const eventId = button.dataset.id;
                    const eventName = button.dataset.name;
                    const eventDescription = button.dataset.description;
                    const eventLocation = button.dataset.location;
                    const eventStartDate = button.dataset.startDate;
                    const eventEndDate = button.dataset.endDate;
                    const eventFee = button.dataset.fee;
                    const eventStatus = button.dataset.status;

                    // Populate form inputs
                    document.getElementById('edit-event-name').value = eventName;
                    document.getElementById('edit-event-description').value = eventDescription;
                    document.getElementById('edit-event-location').value = eventLocation;
                    document.getElementById('edit-event-start-date').value = eventStartDate;
                    document.getElementById('edit-event-end-date').value = eventEndDate;
                    document.getElementById('edit-event-fee').value = eventFee;
                    document.getElementById('edit-event-status').value = eventStatus;

                    // Update form action URL
                    editEventForm.action = `{{ url('events') }}/${eventId}`;
                });
            });


        </script>
    @endsection
