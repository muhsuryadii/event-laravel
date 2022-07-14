<div class="bg-gray-100 leading-normal tracking-wider text-gray-900">
  <div class="bg-white px-4 pt-2">

    <div class="row mb-4 items-end">
      <div class="col-lg-3 form-inline mb-[12px] lg:mb-0">
        Per Page: &nbsp;
        <select wire:model="perPage" class="form-control mt-1 lg:mt-0">
          <option>10</option>
          <option>15</option>
          <option>25</option>
        </select>
      </div>

      <div class="col">
        <input wire:model="search" class="form-control" type="text" placeholder="Cari Nama Peserta">
      </div>
    </div>

    <div class="row">
      <div class="table-responsive">
        <table class="table-bordered table-striped table text-sm text-gray-600">
          <thead>
            {{ $head }}
          </thead>
          <tbody>
            {{ $body }}
          </tbody>
        </table>
      </div>
    </div>

    <div id="table_pagination" class="py-3">
      {{ $model->onEachSide(1)->links() }}
    </div>
  </div>
</div>
