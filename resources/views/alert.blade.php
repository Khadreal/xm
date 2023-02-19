@foreach(['danger' => 'Error', 'success' => 'Success', 'info' => 'Information', 'warning' => 'Important Warning'] as $flashMesg => $label)
    @if (session($flashMesg))
        <div class="alert alert-{{$flashMesg}} alert-dismissible fade show" role="alert">
            <strong>{{$label}}!</strong> {{ session($flashMesg) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach
