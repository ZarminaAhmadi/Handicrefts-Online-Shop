 @extends('admin.admin_master')
 @include('layouts.DeleteConformation')
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
                             <h3 class="box-title">UnderSub List</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="table-responsive">
                                 <table id="example1" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>


                                             <th>name</th>
                                             <th>SubCategory</th>
                                             <th>Action</th>


                                         </tr>
                                     </thead>
                                     <tbody>
                                         @foreach ($under_sub as $item)
                                             <tr>
                                                 <td> {{ $item->name }} </td>
                                                 <td> {{ $item->subcategory->subcategory_name_eng }} </td>
                                                 <td width="30%">
                                                     <a href="{{ route('subcategory.edit', $item->id) }}"
                                                         class="btn btn-success" title="Edit Data"><i
                                                             class="fa fa-pencil"></i>
                                                     </a>
                                                     <a href="{{ route('subcategory.delete', $item->id) }}"
                                                         class="btn btn-danger" title="Delete Data" id="delete"><i
                                                             class="fa fa-trash"></i></a>
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

                 {{-- ------------------- Add subCategory  Page -------------- --}}

                 <div class="col-4">

                     <div class="box">
                         <div class="box-header with-border">
                             <h3 class="box-title">Add SubCategory</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="table-responsive">

                                 <form method="POST" action="{{ route('under_sub.store') }}">
                                     @csrf

                                     <div class="form-group">
                                         <h5>Category Select <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <select name="sub_category_id" class="form-control">
                                                 <option value="" selected="" disabled="">Select SubCategory
                                                 </option>
                                                 @foreach ($subcategory as $sub)
                                                     <option value="{{ $sub->id }}">{{ $sub->subcategory_name_eng }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                             @error('sub_category_id')
                                                 <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                         </div>

                                     </div>
                             </div>


                             <div class="form-group">
                                 <h5>underSubCategory <span class="text-danger">*</span></h5>
                                 <div class="controls">
                                     <input type="text" name="name" class="form-control">

                                     @error('name')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>


                             <div class="text-xs-right">
                                 <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                             </div>
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
