@extends('templates.main')

@section('title','Overview')
@section('sub','Data Reseller')

@section('konten')
<a href="" class="btn btn-outline-primary mb-3"><i class="fas fa-user-plus"></i> Tambah data</a>
      <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">Data Reseller</h6>
                    <!-- search  -->
                     <form action="#" class="main-sidebar__search border-left d-sm-flex float-right">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Cari Reseller..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Name</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">No.Telepon</th>
                          <th scope="col" class="border-0">City</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        <tr>
                          <td>1</td>
                          <td>Diki</td>
                          <td>diki@gmail.com</td>
                          <td>08944522122</td>
                          <td>Jakarta Timur</td>
                          <td>
                              <a href="" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <a href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</a>
                          </td>
                        </tr>
                        <!-- end looping  -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection('konten')
