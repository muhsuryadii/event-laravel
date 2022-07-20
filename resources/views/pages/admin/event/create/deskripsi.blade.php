  @push('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  @endpush

  <form action='{{ route('admin_events_store_desc') }}' method="POST" class="p-[1.5rem]" id="formStepDescription">
    @csrf
    {{-- Deskripsi Event --}}
    <div class="mb-4">
      <div class="form-group">
        <label for="deskripsi_acara" class="form-label text-lg">Deskripsi Event
          <span class="text-danger text-sm">(*)</span>
        </label>
        <span class="is-none invalid-feedback d-block d-none mb-3">Deskripsi Event Wajib Diisi</span>

        <textarea rows="10" class="form-control @error('deskripsi_acara') is-invalid @enderror mb-5" name='deskripsi_acara'
          autofocus='true' required="required" value="{{ old('deskripsi_acara') }}" id="ckeditor"
          placeholder="Masukan Deskripsi Event">{{ old('deskripsi_acara') }}</textarea>

        @error('deskripsi_acara')
          <div id="deskripsi_acara_feedback" class="invalid-feedback">
            @if (isset($message) && $message == 'validation.required')
              Deskripsi Event Wajib Diisi
            @endif
          </div>
        @enderror
      </div>
    </div>
    {{-- <button class="btn btn-primary btn-next-form" type='button'>Next</button> --}}
    <button class="btn btn-primary btn-next-form w-full" id="submitDescription" type='button'>Next</button>
  </form>

  @push('js')
    {{-- CK editor --}}

    <script>
      let myEditor;
      ClassicEditor
        .create(document.querySelector('#ckeditor'), {
          removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'CKTable', 'EasyImage', 'Image',
            'ImageCaption', 'ImageStyle',
            'ImageToolbar', 'ImageUpload', 'MediaEmbed', 'insertTable '
          ],
        })
        .then(editor => {
          //   console.log(editor);
          //   editor.getData();
          //   editor.updateSourceElement();
          myEditor = editor;

        })
        .catch(error => {
          console.error(error);
        });
    </script>

    {{-- Post Deskripsi Event --}}
    <script>
      const postFormDescription = () => {
        const descriptionFeedback = document.querySelector('.is-none');
        const descriptionTextareaValue = myEditor.getData();

        console.log(descriptionTextareaValue.length);

        if (descriptionTextareaValue.length == 0) {
          descriptionFeedback.classList.add('d-block');
          descriptionFeedback.classList.remove('d-none');
          return false;
        } else {
          descriptionFeedback.classList.remove('d-block');
          descriptionFeedback.classList.add('d-none');
        }
        return true;

      }

      const postDescription = () => {
        const endpoint = "{{ route('admin_events_store_desc') }}";

        if (!postFormValidation()) {
          return stepper3.previous();
        }

        if (postFormDescription()) {
          let data = {
            'uuid_event': uuidEvent,
            'deskripsi_acara': myEditor.getData()
          };
          console.log(data);

          axios.post(endpoint, {
              ...data
            })
            .then(function(response) {
              console.log(response);
              if (response.data.success || response.statusCode === 201) {
                stepper3.next();
              } else {
                alert('Something went wrong');
              }
            })
            .catch(function(error) {
              console.log(error);
            });
        }
      }


      const buttonDescription = document.querySelector('#submitDescription');
      buttonDescription.addEventListener('click', function(e) {
        e.preventDefault();
        postDescription();
      })
    </script>
  @endpush
