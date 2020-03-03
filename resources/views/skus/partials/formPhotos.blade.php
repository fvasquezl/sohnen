@if ($sku->photos->count())
<div class="card shadow-sm card-outline card-success">
   <div class="card-body">
        <div class="row">
            @foreach ($sku->photos as $photo)
            <div class="col-md-1">
                <form method="POST" action="{{ route('photos.destroy',$photo)}}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs" style="position: absolute">
                        <i class="fas fa-times-circle"></i>
                    </button>
                    <img class="img-fluid" src="{{url($photo->URL)}}">
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif