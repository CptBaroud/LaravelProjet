@extends('template')

@section('content')
<main>
<div class="container">
<table id="users-table" class="table">
  <thead>
    <tr>
      <td> ID </td>
      <td> Last Name </td>
      <td> First Name </td>
      <td> Location </td>
      <td> Email </td>
      <td> Permission </td>
      <th>Action</th>
    </tr>
  </thead>
</table>
</div>

<br>

<div id="studentModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="student_form">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group">
                        <label>Enter First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Location</label>
                        <input type="text" name="location" id="location" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="text" name="email" id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="text" name="password" id="password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <select name="permissions" id="permissions" class="form-control">
                          <option value="0" selected>Student</option>
                          <option value="1">BDE member</option>
                          <option value="2">CESI Staff</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" name="student_id" id="student_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection

@section('script')

<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'http://127.0.0.1:8000/admin/get_datatable',
      columns : [
        {data: 'id'},
        {data: 'last_name'},
        {data: 'first_name'},
        {data: 'location'},
        {data: 'email'},
        {data: 'permissions'},
        {data: "action", orderable:false, searchable: false}


      ]
    });

    $(document).on('click', '.delete', function(){
       var id = $(this).attr('id');
       if(confirm("Are you sure you want to Delete this data?"))
       {
           $.ajax({
               url:"{{route('admin_remove')}}",
               mehtod:"get",
               data:{id:id},
               success:function(data)
               {
                   alert(data);
                   $('#users-table').DataTable().ajax.reload();
               }
           })
       }
       else
       {
           return false;
       }
   });


   $('#student_form').on('submit', function(event){
         event.preventDefault();
         var form_data = $(this).serialize();
         $.ajax({
             url:"{{ route('admin_postdata') }}",
             method:"POST",
             data:form_data,
             dataType:"json",
             success:function(data)
             {

                     $('#form_output').html(data.success);
                     $('#student_form')[0].reset();
                     $('#action').val('Add');
                     $('.modal-title').text('Add Data');
                     $('#button_action').val('insert');
                     $('#users-table').DataTable().ajax.reload();

             }
         })
     });




$(document).on('click', '.edit', function(){
    var id = $(this).attr("id");
    $('#form_output').html('');
    $.ajax({
        url:"{{route('admin_fetchdata')}}",
        method:'get',
        data:{id:id},
        dataType:'json',
        success:function(data)
        {
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#location').val(data.location);
            $('#email').val(data.email);
            $('#permissions').val(data.permissions);
            $('#student_id').val(id);
            $('#studentModal').modal('show');
            $('#action').val('Edit');
            $('.modal-title').text('Edit Data');
            $('#button_action').val('update');
        }
    })
});


});

</script>
@endsection
