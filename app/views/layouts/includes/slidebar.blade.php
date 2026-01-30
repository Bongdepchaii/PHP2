<aside class="col-12 col-lg-3">
        <div class="card shadow-sm">
          <div class="card-header bg-white fw-semibold">Thương hiệu</div>
          <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action active">All</a>
            <a href="#" class="list-group-item list-group-item-action ">Sony</a>
            <a href="#" class="list-group-item list-group-item-action ">Panasonic</a>
          </div>
        </div>
        <div class="card shadow-sm mt-2">
          <div class="card-header bg-white fw-semibold">Danh mục</div>
          <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action active">All</a>
            <a href="" class="list-group-item list-group-item-action" >{{$catMap[$item['id_category']]}}</a>
          </div>
        </div>

        <div class="card shadow-sm mt-2">
          <div class="card-body">
            <div class="fw-semibold mb-2">Lọc giá</div>
            <div class="d-flex gap-2">
              <input class="form-control" placeholder="Thấp" />
              <input class="form-control" placeholder="Cao" />
            </div>
            <button class="btn btn-primary w-100 mt-3">Áp dụng</button>
          </div>
        </div>
      </aside>