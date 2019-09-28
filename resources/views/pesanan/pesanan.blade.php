@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Input Pesanan')

    @section('konten')
        <!--start row main conten -->
        <div class="row">
            <!-- start looping  -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1">
                  <div class="card-post__image" style="background-image: url('images/content-management/17.jpg');">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">Stock 150</a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" href="#">Siwak</a>
                    </h5>
                    <form action="">
                        <div class="input-group">
                          <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white" type="button">Add</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1">
                  <div class="card-post__image" style="background-image: url('images/content-management/17.jpg');">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">Stock 150</a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" href="#">Siwak</a>
                    </h5>
                    <form action="">
                        <div class="input-group">
                          <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white" type="button">Add</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1">
                  <div class="card-post__image" style="background-image: url('images/content-management/17.jpg');">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">Stock 150</a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" href="#">Siwak</a>
                    </h5>
                    <form action="">
                        <div class="input-group">
                          <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white" type="button">Add</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-small card-post card-post--1">
                  <div class="card-post__image" style="background-image: url('images/content-management/17.jpg');">
                    <a href="#" class="card-post__category badge badge-pill badge-dark">Stock 150</a>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a class="text-fiord-blue" href="#">Siwak</a>
                    </h5>
                    <form action="">
                        <div class="input-group">
                          <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                          <div class="input-group-append">
                            <button class="btn btn-white" type="button">Add</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <!-- end looping card  -->

            <!-- data list -->
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4 mt-5">
                <div class="card card-small">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Daftar Produk - bentuk list</h6>
                  </div>
                  <!-- start looping -->
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Siwak</span>
                        <span class="text-semibold text-fiord-blue">Stock : 60</span>
                        <form action="" class="ml-auto text-right">
                            <div class="input-group">
                            <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Add</button>
                            </div>
                            </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Siwak</span>
                        <span class="text-semibold text-fiord-blue">Stock : 60</span>
                        <form action="" class="ml-auto text-right">
                            <div class="input-group">
                            <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Add</button>
                            </div>
                            </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Siwak</span>
                        <span class="text-semibold text-fiord-blue">Stock : 60</span>
                        <form action="" class="ml-auto text-right">
                            <div class="input-group">
                            <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Add</button>
                            </div>
                            </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Siwak</span>
                        <span class="text-semibold text-fiord-blue">Stock : 60</span>
                        <form action="" class="ml-auto text-right">
                            <div class="input-group">
                            <input type="number" class="form-control" placeholder="Beli berapa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Add</button>
                            </div>
                            </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <!-- end looping  -->
                </div>
              </div>
            <!-- end data list  -->

             <!-- bentuk form start  -->
            <div class="col-lg-8 mb-4">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Form Inputs</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <strong class="text-muted d-block mb-2">Input pesanan</strong>
                          <form>
                            <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <input type="number" class="form-control" id="inputCity" placeholder="Beli berapa"> 
                                </div>
                                <div class="form-group col-md-5">
                                    <select id="inputState" class="form-control">
                                        <option selected="">Pilih produk...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <button class="btn btn-outline-info"><i class="fas fa-plus"></i> Tambah produk</button> 
                                </div>
                                <div class="form-group">
                                    <p class="text-muted">Total harga : Rp.200000</p>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <select id="inputState" class="form-control">
                                            <option selected="">Nama Pembeli...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button class="btn btn-outline-info"><i class="fas fa-user-plus"></i> Tambah Pembeli</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select id="inputState" class="form-control">
                                    <option selected="">Pilih E-Commerce...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="inputState" class="form-control">
                                    <option selected="">Pilih Expedisi...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button class="btn btn-primary"><i class="fas fa-shipping-fast"></i> Proses Order</button> 
                                <a class="btn btn-warning text-white"><i class="fas fa-undo"></i> Kembali</a> 
                            </div>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
                  <!-- end bentuk form  -->

        </div><!-- end row  -->

    @endsection('konten')
