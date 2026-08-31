@use('App\Services\Operations')

<div class="col">
    <div class="card mb-3" style="max-width: 60rem; max-height: 40rem;">
        <a href="{{ route('view_media', ["id"=> Operations::encryptId($media->id)]) }}" class="link-underline link-underline-opacity-0" draggable="false">
          <div class="card-img-top d-flex flex-row justify-content-center bg-dark">
            <img src="{{ asset('storage/'.$media->image) }}" class="img-fluid" style="height: 10rem;" alt="">
          </div>
          
          <div class="card-body">
              <h5 class="card-title">{{ $media->title }}</h5>
              <p class="card-text">{{ $media->description }}</p>
          </div>
        </a>
        <div class="card-footer">
            <a href="#" draggable="false">
              <div class="d-flex flex-row align-items-center mb-2">
                <img src="{{ asset('assets/images/unknownuser.jpg') }}" style="max-width: 2rem; max-height: 2rem;" alt="">
                
                <div class="container-fluid">{{ $media->user->name }}</div>
              </div>
            </a>
            <p class="card-text"><small class="text-body-secondary">Postado em {{ date('d/m/Y \á\s H:i:s', strtotime($media->posted_at)) }}</small></p>
        </div>
    </div>
</div>