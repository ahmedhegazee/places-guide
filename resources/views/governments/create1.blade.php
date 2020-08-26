@extends('layouts.app')

@section('page_title')
    Governments
@endsection
@section('additional_scripts')
    <script src="{{asset('admintle/plugins/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('admintle/plugins/js/additional-methods.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
        
      },
    },
    messages: {
      email: {
        required: "Please enter a government name",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection
@section('content')
        <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Add Government</h3>

        </div>
        <div class="card-body">
             <form role="form" id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Government Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter government name">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

        </div>
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

