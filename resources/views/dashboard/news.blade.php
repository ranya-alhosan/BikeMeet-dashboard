@extends('dashboard.layout')

@section('news-active', 'active')

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Newsletter Management</h3>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNewsletterModal">
                                <i class="fas fa-plus"></i> Create Newsletter
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="newsletterTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content Preview</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($newsletters as $newsletter)
                                    <tr>
                                        <td>{{ $newsletter->id }}</td>
                                        <td>{{ $newsletter->title }}</td>
                                        <td>{{ Str::limit($newsletter->content, 50) }}</td>
                                        <td>{{ $newsletter->created_at->format('d M Y') }}</td>
                                        <td>
                                            <button
                                                class="btn btn-info btn-sm me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailNewsletterModal"
                                                onclick="showNewsletterDetails({{ $newsletter }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="btn btn-secondary btn-sm me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editNewsletterModal"
                                                onclick="editNewsletter({{ $newsletter }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form
                                                action="{{ route('newsletters.destroy', $newsletter->id) }}"
                                                method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
        </div>
    </div>

    <!-- Newsletter Details Modal -->
    <div class="modal fade" id="detailNewsletterModal" tabindex="-1" aria-labelledby="detailNewsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailNewsletterModalLabel">Newsletter Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="detail-title"></h4>
                    <p id="detail-content" class="text-muted"></p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Created At:</strong> <span id="detail-created-at"></span></li>
                        <li class="list-group-item"><strong>Likes:</strong> <span id="detail-likes"></span></li>
                        <li class="list-group-item"><strong>Comments:</strong> <span id="detail-comments"></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Newsletter Modal -->
    <div class="modal fade" id="createNewsletterModal" tabindex="-1" aria-labelledby="createNewsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createNewsletterModalLabel">Create New Newsletter</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('newsletters.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="create-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="create-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="create-content" class="form-label">Content</label>
                            <textarea class="form-control" id="create-content" name="content" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Newsletter Modal -->
    <div class="modal fade" id="editNewsletterModal" tabindex="-1" aria-labelledby="editNewsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="editNewsletterModalLabel">Edit Newsletter</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editNewsletterForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-content" class="form-label">Content</label>
                            <textarea class="form-control" id="edit-content" name="content" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showNewsletterDetails(newsletter) {
            document.getElementById('detail-title').textContent = newsletter.title;
            document.getElementById('detail-content').textContent = newsletter.content;
            document.getElementById('detail-created-at').textContent = new Date(newsletter.created_at).toLocaleDateString();
            document.getElementById('detail-likes').textContent = newsletter.likes_count || 0;
            document.getElementById('detail-comments').textContent = newsletter.comments_count || 0;
        }

        function editNewsletter(newsletter) {
            const form = document.getElementById('editNewsletterForm');
            form.action = `/newsletters/${newsletter.id}`;
            document.getElementById('edit-title').value = newsletter.title;
            document.getElementById('edit-content').value = newsletter.content;
        }
    </script>
@endsection
