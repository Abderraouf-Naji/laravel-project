@extends('layouts.app')
@section('title')
    {{ $task->title }} - Détails de la tâche
@endsection
@section('content')
    <div class="container">
        <h2 class="mb-4 shadow-sm p-3 rounded bg-white text-center">{{ $task->title }} - Détails de la tâche</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">{{ $task->description }}</p>
                                <p class="card-text"><strong>Date d'échéance :</strong> {{ $task->due_date }}</p>
                                <p class="card-text"><strong>Priorité :</strong> <span
                                        class="badge {{ $task->priority == 'low' ? 'bg-success' : ($task->priority == 'medium' ? 'bg-warning' : 'bg-danger') }}">{{ ucfirst($task->priority) }}</span>
                                </p>
                                <p class="card-text"><strong>Statut :</strong>
                                    @if ($task->status == 'completed')
                                        <span class="badge bg-success">Terminé</span>
                                    @elseif($task->status == 'to_do')
                                        <span class="badge bg-primary">À faire</span>
                                    @elseif($task->status == 'in_progress')
                                        <span class="badge bg-warning">En cours</span>
                                    @endif
                                </p>

                                <p class="card-text"><strong>Assigné à :</strong> {{ $task->user->name }}</p>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editTaskModal"> <i class="bi bi-pencil-square"></i> </button>
                                <a href="{{ route('projects.tasks.index', $task->project->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-90deg-left"></i> </a>
                            </div>

                            <div class="col-md-6 border-start">
                                <h5>Suivi du temps</h5>
                                <div id="time-tracker">
                                    <span id="time-display">00:00:00</span>
                                    <div>
                                        <button id="start-btn" class="btn btn-success btn-sm"><i
                                                class="bi bi-play-fill"></i></button>
                                        <button id="pause-btn" class="btn btn-warning btn-sm"><i
                                                class="bi bi-pause-fill"></i></button>
                                        <button id="reset-btn" class="btn btn-danger btn-sm"><i
                                                class="bi bi-stop-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="d-flex justify-content-between align-items-center border-top pt-2">
                                    <h5>Liste de vérification</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addChecklistModal"> <i class="bi bi-plus-circle"></i> </button>
                                </div>

                                <!-- Checklist items -->
                                <ul class="list-group mt-2" id="checklist-items">
                                    @foreach ($task->checklistItems as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            id="checklist-item-{{ $item->id }}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checklist-item-checkbox-{{ $item->id }}"
                                                    {{ $item->completed ? 'checked' : '' }}
                                                    onchange="toggleChecklistItem({{ $item->id }})">
                                                <label
                                                    class="form-check-label {{ $item->completed ? 'text-decoration-line-through' : '' }}">{{ $item->name }}</label>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editChecklistModal-{{ $item->id }}"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteChecklistItem({{ $item->id }})"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        </li>

                                        <!-- Edit Checklist Modal -->
                                    @endforeach
                                </ul>
                                {{-- <div class="modal fade" id="editChecklistModal-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editChecklistModalLabel-{{ $item->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="edit-checklist-form-{{ $item->id }}"
                                                    action="{{ route('checklist-items.update', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editChecklistModalLabel-{{ $item->id }}">Edit
                                                            Checklist Item</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="checklist-name-{{ $item->id }}"
                                                                class="form-label">Item Name</label>
                                                            <input type="text" name="name"
                                                                id="checklist-name-{{ $item->id }}"
                                                                class="form-control" value="{{ $item->name }}"
                                                                required>
                                                            <div class="invalid-feedback"
                                                                id="checklist-name-error-{{ $item->id }}"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Item</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Checklist Modal -->
        <div class="modal fade" id="addChecklistModal" tabindex="-1" aria-labelledby="addChecklistModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="add-checklist-form">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addChecklistModalLabel">Add Checklist Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="checklist-name" class="form-label">Item Name</label>
                                <input type="text" name="name" id="checklist-name" class="form-control" required>
                                <div class="invalid-feedback" id="checklist-name-error"></div>
                            </div>
                            <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal pour éditer la tâche -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Modifier la tâche</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Date d'échéance</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
                        @error('due_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priorité</label>
                        <select name="priority" id="priority" class="form-select" required>
                            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Faible</option>
                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Moyenne</option>
                            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Élevée</option>
                        </select>
                        @error('priority')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="to_do" {{ $task->status == 'to_do' ? 'selected' : '' }}>À faire</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour la tâche</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let timer;
    let seconds = 0;
    let isRunning = false;

    function formatTime(sec) {
        let hours = Math.floor(sec / 3600);
        let minutes = Math.floor((sec % 3600) / 60);
        let seconds = sec % 60;

        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function updateTimeDisplay() {
        document.getElementById('time-display').innerText = formatTime(seconds);
    }

    document.getElementById('start-btn').addEventListener('click', () => {
        if (!isRunning) {
            isRunning = true;
            timer = setInterval(() => {
                seconds++;
                updateTimeDisplay();
            }, 1000);
        }
    });

    document.getElementById('pause-btn').addEventListener('click', () => {
        if (isRunning) {
            isRunning = false;
            clearInterval(timer);
        }
    });

    document.getElementById('reset-btn').addEventListener('click', () => {
        isRunning = false;
        clearInterval(timer);
        seconds = 0;
        updateTimeDisplay();
    });

    updateTimeDisplay();

    function toggleChecklistItem(itemId) {
        const url = '{{ route('checklist-items.update-status', ':id') }}'.replace(':id', itemId);
        const checkbox = document.getElementById(`checklist-item-checkbox-${itemId}`);
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const label = checkbox.closest('.form-check').querySelector('.form-check-label');
                    label.classList.toggle('text-decoration-line-through', checkbox.checked);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function deleteChecklistItem(itemId) {
        const form = document.getElementById(`delete-checklist-form-${itemId}`);
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`checklist-item-${itemId}`).remove();
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // AJAX pour ajouter un élément de checklist
    document.getElementById('add-checklist-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch('{{ route('checklist-items.store', $task->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data)
                    const checklistItem = document.createElement('li');
                    checklistItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    checklistItem.id = `checklist-item-${data.id}`;
                    checklistItem.innerHTML = `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checklist-item-checkbox-${data.id}"
                            onchange="toggleChecklistItem(${data.id})">
                        <label class="form-check-label">${data.name}</label>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editChecklistModal-${data.id}"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteChecklistItem(${data.id})"><i class="bi bi-trash"></i></button>
                    </div>
                `;

                    document.getElementById('checklist-items').appendChild(checklistItem);
                    form.reset();
                    document.querySelector('#addChecklistModal .btn-close').click();
                } else {
                    const errorElement = document.getElementById('checklist-name-error');
                    errorElement.textContent = data.message;
                    errorElement.style.display = 'block';
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection
