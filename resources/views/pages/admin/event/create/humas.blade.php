 <div class="mb-4">
   <button class="btn btn-outline-primary btn-tambah-humas d-block ml-auto active:bg-blue-100" type='button'>
     <i class="fa-solid fa-plus mr-2"></i>
     Tambah Humas
   </button>
   <div class="humas-wrapper-list">
     <div class="humas-wrapper">
       <label for="name" class="form-label d-block text-left text-lg">Humas
         1</label>
       <div class="form-group text-left">
         <label for="nama_humas[]" class="form-label text-left text-sm">Nama
           Humas</label>
         <input type="text" class="form-control @error('nama_humas[]') is-invalid @enderror" name='nama_humas[]'
           id="nama_humas[]" autofocus='true' value="{{ old('nama_humas[]') }}" placeholder="Masukan Nama Humas">
         @error('nama_humas[]')
           <div class="invalid-feedback">
             {{ $message }}
           </div>
         @enderror
       </div>
       <div class="form-group text-left">
         <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp
           Humas</label>
         <input type="text" class="form-control @error('no_wa[]') is-invalid @enderror" name='no_wa[]' id='no_wa[]'
           autofocus='true' value="{{ old('no_wa[]') }}" placeholder="628xxxxxxxxxx"
           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^]/, '628');">
         @error('no_wa[]')
           <div class="invalid-feedback">
             {{ $message }}
           </div>
         @enderror
       </div>
     </div>
   </div>

   <button class="btn btn-primary btn-next-form" type='button'>Next</button>
 </div>

 @push('js')
   {{-- Script for add another humas --}}
   <script>
     const buttonHumas = document.querySelector('.btn-tambah-humas')
     const humasList = document.querySelector('.humas-wrapper-list')
     const firstHumas = document.querySelector('.humas-wrapper')

     buttonHumas.addEventListener('click', function() {
       console.log(humasList.children.length);
       humasList.innerHTML += `
        <div class="humas-wrapper">
            <label for="name" class="form-label d-block text-left text-lg">Humas ${humasList.children.length+1}</label>
            <div class="form-group text-left">
            <label for="nama_humas[]" class="form-label text-left text-sm">Nama Humas</label>
            <input type="text" class="form-control" name='nama_humas[]' id="nama_humas[]" autofocus='true'
                placeholder="Masukan Nama Humas">
            </div>
            <div class="form-group text-left">
            <label for="no_wa[]" class="form-label text-left text-sm">No Whatsapp Humas</label>
            <input type="text" class="form-control" name='no_wa[]' id='no_wa[]' autofocus='true'
                placeholder="628xxxxxxxxxx"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^]/, '628');">
            </div>
        </div>
        `;
     })
   </script>
 @endpush
