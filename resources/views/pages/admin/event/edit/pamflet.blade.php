 @push('head')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 @endpush

 <form action='{{ route('admin_events_update_pamflet', $event->uuid) }}' method="POST" class="p-[1.5rem]"
   id="formStepPamflet" enctype="multipart/form-data">
   @csrf
   @method('put')

   <div class="mb-3">
     <div class="mb-3" id="dropzone-section">
       <label for="image" class="form-label text-lg">Pamflet Event</label>
       <div class="needsclick dropzone" id="document-dropzone"></div>
       <small class="my-2 mb-2 text-sm font-semibold text-slate-800">Disarankan menggunakan dimensi gambar 4:3</small>
     </div>

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
   {{-- Dropzone --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

   {{-- Script for preview image --}}

   {{-- Dropzone Image --}}

   <script>
     async function convertToFile(url) {
       let response = await fetch(url);
       let blob = await response.blob();

       return new File([blob], 'pamflet.jpg', {
         type: 'image/jpeg',
       });

     }
   </script>

   <script>
     var uploadedDocumentMap = {}
     Dropzone.options.documentDropzone = {
       url: "{{ route('admin_events_update_media', $event->uuid) }}",
       addRemoveLinks: true,
       acceptedFiles: ".jpeg,.jpg,.png,.gif",
       thumbnailWidth: 400,
       thumbnailHeight: null,
       renameFile: function(file) {
         var dt = new Date();
         var time = dt.getTime();
         return time + file.name;
       },
       headers: {
         'X-CSRF-TOKEN': "{{ csrf_token() }}"
       },
       success: function(file, response) {

         const input = document.querySelectorAll('#dropzone-section [name="image"]');
         if (input.length > 0) {
           input[0].value = response.path;
         } else {
           $('#dropzone-section').append('<input type="hidden" name="image" value="' + response.path + '">')
         }
       },
       removedfile: function(file) {
         file.previewElement.remove()
         var name = ''
         if (typeof file.file_name !== 'undefined') {
           name = file.file_name
         } else {
           name = uploadedDocumentMap[file.name]
         }

         $('#dropzone-section').find('input[name="image"][value="' + name + '"]').remove();
       },
       maxFiles: 1,
       init: async function() {
         this.on('addedfile', function(file) {
           if (this.files.length > 1) {
             this.removeFile(this.files[0]);
           }
         });

         @if (isset($event->famplet_acara_path))
           //  var file = {!! json_encode($event->famplet_acara_path) !!}
           const url = "{{ asset('storage/' . $event->famplet_acara_path) }}";
           let file = await convertToFile(url);

           var mock = {
             name: file.name,
             size: file.size,
             file_name: file.name
           };
           this.emit('addedfile', mock)
           this.emit('thumbnail', mock, url)
           this.emit('complete', mock)
           this.files.push(mock)
         @endif

       },
     }
   </script>

   {{-- Script for pamflet picture humas --}}
   <script>
     const postPamflet = () => {
       const endpoint = "{{ route('admin_events_update_pamflet', $event->uuid) }}";

       if (!postFormValidation()) {
         return stepper3.to(1);
       }

       if (!postFormDescription()) {
         return stepper3.to(2);
       }

       const form = document.querySelector('#formStepPamflet');
       let formData = new FormData(form);

       let data = {};

       for (let pair of formData.entries()) {
         Object.assign(data, {
           [pair[0]]: pair[1]
         });
       }


       axios.put(endpoint, data)
         .then(function(response) {
           if (response.data.success || response.statusCode === 201) {
             console.log(response.data);
             stepper3.next();
           } else {
             alert('Something went wrong');
           }
         })
         .catch(function(error) {
           console.log(error);
         });
     }

     const buttonSubmitPamflet = document.querySelector('#submitPamflet');
     buttonSubmitPamflet.addEventListener('click', function(e) {
       e.preventDefault();
       postPamflet();
     })
   </script>
 @endpush
