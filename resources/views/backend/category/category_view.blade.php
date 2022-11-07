 @extends('admin.admin_master')
 @section('admin')
     <!-- Content Wrapper. Contains page content -->

     <div class="container-full">
         <!-- Content Header (Page header) -->

         <!-- Main content -->
         <section class="content">
             <div class="row">


                 <div class="col-8">

                     <div class="box">
                         <div class="box-header with-border">
                             <h3 class="box-title">Category List</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="table-responsive">
                                 <table id="example1" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>
                                             <th>Category Icon</th>
                                             <th>Category Eng</th>
                                             <th>Category Dari</th>
                                             <th>Action</th>

                                         </tr>
                                     </thead>
                                     <tbody>

                                         @foreach ($category as $item)
                                             <tr>
                                                 <td> <span><i class="{{ $item->category_icon }}"></i></span></td>
                                                 <td>{{ $item->category_name_eng }}</td>
                                                 <td>{{ $item->category_name_dari }}</td>
                                                 <td>
                                                     <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-success"
                                                         title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                     <a href="{{ route('brand.delete', $item->id) }}" class="btn btn-danger"
                                                         title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                                 </td>

                                             </tr>
                                         @endforeach
                                     </tbody>

                                 </table>
                             </div>
                         </div>
                         <!-- /.box-body -->
                     </div>
                     <!-- /.box -->


                 </div>
                 <!-- /.col -->

                 {{-- ------------------- Add Category Page -------------- --}}

                 <div class="col-4">

                     <div class="box">
                         <div class="box-header with-border">
                             <h3 class="box-title">Add Category</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="table-responsive">

                                 <form method="post" action="{{ route('category.store') }}">
                                     @csrf


                                     <div class="form-group">
                                         <h5>Category English <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <input type="text" name="category_name_eng" class="form-control">

                                             @error('category_name_eng')
                                                 <span class="text-danger">{{ $message }}</span>
                                             @enderror

                                         </div>
                                     </div>


                                     <div class="form-group">
                                         <h5>Category Dari <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <input type="text" name="category_name_dari" class="form-control">

                                             @error('category_name_dari')
                                                 <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <h5>Category Icon<span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <input type="text" name="category_icon" class="form-control">

                                             @error('category_icon')
                                                 <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                         </div>
                                     </div>


                                     <div class="text-xs-right">
                                         <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                     </div>
                                 </form>

                             </div>
                         </div>



                     </div>
                 </div>
                 <!-- /.box-body -->
             </div>
             <!-- /.box -->


     </div>



     </div>
     <!-- /.row -->
     </section>
     <!-- /.content -->

     </div>
 @endsection
