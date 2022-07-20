 <form action='{{ route('admin_events_store_pamflet') }}' method="POST" class="p-[1.5rem]" id="formStepPamflet"
   enctype="multipart/form-data">
   @csrf
   <div class="mb-3">
     {{-- <label for="image" class="form-label text-lg">Poster Event</label> --}}
     <img class="img-preview img-fluid col-sm-5 d-block mx-auto mt-3 mb-3 rounded-md shadow-md"
       src="{{ asset('image/event_image_default.png') }}" loading="lazy">
     <input class="form-control @error('famplet_acara_path') is-invalid @enderror" type="file" id="image"
       name="image" onchange="previewImage()">

     @error('famplet_acara_path')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
     @enderror

     @error('image')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
     @enderror
   </div>
   <button class="btn btn-primary btn-next-form" id="submitPamflet" type='button'>Next</button>
 </form>

 @push('js')
   {{-- Script for preview image --}}
   <script>
     function previewImage() {
       const image = document.querySelector('#image');
       const imagePreview = document.querySelector('.img-preview');
       const reader = new FileReader();
       reader.readAsDataURL(image.files[0]);
       reader.onload = function() {
         imagePreview.src = reader.result;
       }
     }
   </script>

   {{-- Script for pamflet picture humas --}}
   <script>
     /* Make Validation */
     const validationBefore = () => {
       if (!postFormValidation()) {
         return stepper3.to(1);
       }

       if (!postFormDescription()) {
         return stepper3.previous();
       }
     }

     const postHumas = () => {
       const endpoint = "{{ route('admin_events_store_pamflet') }}";
     }
   </script>
 @endpush
