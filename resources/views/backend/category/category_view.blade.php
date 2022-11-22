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

                                             <th>Action</th>

                                         </tr>
                                     </thead>
                                     <tbody>

                                         @foreach ($category as $item)
                                             <tr>
                                                 <td><span><i class="{{ $item->category_icon }}"></i></span></td>
                                                 <td>{{ $item->category_name_eng }}</td>


                                                 <td width="30%">
                                                     <a href="{{ route('category.edit', $item->id) }}"
                                                         class="btn btn-success" title="Edit Data"><i
                                                             class="fa fa-pencil"></i></a>
                                                     <a href="{{ route('category.delete', $item->id) }}"
                                                         class="btn btn-danger button" title="Delete Data"
                                                         data-toggle="tooltip" title='Delete' id="Delete"><i
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

                 {{-- ------------------- Add Category  Page -------------- --}}

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
                                         <h5>Category English<span class="text-danger">*</span></h5>
                                         <div class="controls">
                                             <input type="text" name="category_name_eng" class="form-control">

                                             @error('category_name_eng')
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

     <script type="text/javascript">
         function openModel(route, id) {
             Swal.fire({
                 title: 'Are you sure to delete this record?',
                 icon: 'error',
                 showCancelButton: true,
                 confirmButtonColor: 'darkred',
                 confirmButtonText: 'Yes delete it',
                 showLoaderOnConfirm: true,
                 preConfirm: (login) => {
                     // function() {
                     $.ajax({
                         url: '16',
                         type: 'DELETE',
                         DataType: 'json',
                         data: {
                             "_token": "{{ csrf_token() }}"
                         },
                         success: function(response) {

                             Swal.fire({
                                 title: `ldkfjalkdjflak`,
                                 icon: "success",
                             })
                         },
                         error: function(error) {
                             Swal.fire({
                                 title: `ldkfjalkdjflak`,
                                 icon: "error",
                             })
                         }
                     });
                     // });
                     // return fetch(`/${route}/${id}`)
                     //     .then(response => {
                     //         console.log(response);
                     //         // if (!response.ok) {
                     //         //     throw new Error(response.statusText)
                     //         // }
                     //         // return response.json()
                     //     })
                     //     .catch(error => {
                     //         // Swal.showValidationMessage(
                     //         //     `Request failed: ${error}`
                     //         // )
                     //     })
                 },
                 allowOutsideClick: () => !Swal.isLoading()
             }).then((result) => {
                 // if (result.isConfirmed) {
                 //     Swal.fire({
                 //         title: `${result.value.login}'s avatar`,
                 //         imageUrl: result.value.avatar_url
                 //     })
                 // }
             })
         }
     </script>
 @endsection
