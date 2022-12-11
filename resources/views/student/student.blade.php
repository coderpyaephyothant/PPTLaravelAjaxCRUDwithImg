<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Page</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <!-- Create Modal -->
        <div class="modal fade" id="studentCreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="AddedImageForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <ul id="showMessage"></ul>
                    <label for="name" class="text-danger">Name</label>
                    <input type="text" required name="name" class="name form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="email" class="text-danger">Email</label>
                    <input type="text" required name="email" class="email form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="name" class="text-danger">Phone</label>
                    <input type="number" required name="phone" class="phone form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="name" class="text-danger">Course</label>
                    <input type="text" required name="course" class="course form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="img" class="text-danger">image</label>
                        <input type="file" name="image" class="image form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-danger btn-sm add-student">Create</button> --}}
                <button type="submit" class="btn btn-danger btn-sm add-student">Create</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        {{-- End Create Modal  --}}

        {{-- Edit Modal --}}

        <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit/Update Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="UpdatedImageForm" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <ul id="editMessage"></ul>
                        <input type="hidden" id="edit_student_id">
                    <label for="edit_name" class="text-success">Name</label>
                    <input type="text" id="edit_name" required name="edit_name" class="edit_name form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="edit_email" class="text-success">Email</label>
                    <input type="text" id="edit_email" required name="edit_email" class="edit_email form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="edit_phone" class="text-success">Phone</label>
                    <input type="number" id="edit_phone" required name="edit_phone" class="edit_phone form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="edit_course" class="text-success">Course</label>
                    <input type="text" id="edit_course" required name="edit_course" class="edit_course form-control">
                    </div>
                    <div class="form-group mb-3">
                    <label for="edit_image" class="text-success">Image</label>
                    <div id="originalImage" class="mb-1"></div>
                    <input type="file" id="edit_image"  name="edit_image" class="edit_image form-control">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm update-student">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        {{-- End Edit Modal --}}
        <main class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                <div id="successMessage"></div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="p-3">Students
                                    <a href="" class="btn btn-danger float-end btn-sm" data-bs-target="#studentCreateModal" data-bs-toggle="modal" >Create Student</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                <thead>
                                    <tr >
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $(document).on('submit','#AddedImageForm', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
            $.ajax({
                type: "POST",
                url: "/students",
                data: formData,
                contentType:false,
                processData:false,
                // dataType: "json",
                success: function (response) {
                    if(response.status == 400){
                        $('#showMessage').html("");
                        $('#showMessage').addClass("alert alert-warning");
                        $.each(response.errors, function (key, value) {
                        $('#showMessage').append('<li>'+value+'</li>');
                        });
                    }else{
                        $('#showMessage').html("");
                        $('#successMessage').addClass("alert alert-success");
                        $('#successMessage').text(response.success)
                        $('#studentCreateModal').find("input").val('')
                        $('#studentCreateModal').modal('hide')
                        fetchStudent()
                    }
                }
            });
        });
        fetchStudent()
        function fetchStudent(){
            $.ajax({
                type: "GET",
                url: "/fetch-students",
                dataType: "json",
                success: function (response) {
                    $('tbody').html("");
                    $.each(response.students, function (key, value) {
                        $('tbody').append(
                            '<tr>\
                                        <td>'+value.id+'</td>\
                                        <td>'+value.name+'</td>\
                                        <td>'+value.email+'</td>\
                                        <td>'+value.phone+'</td>\
                                        <td>'+value.course+'</td>\
                                        <td><img src="upload/students/'+value.image+'" width="100px">\
                                        </td>\
                                        <td>\
                                            <button value="'+value.id+'" class="btn btn-sm btn-warning edit_student">Edit</button>\
                                            <button value="'+value.id+'" class="btn btn-sm btn-dark delete_student">Delete</button>\
                                        </td>\
                                    </tr>'
                        )
                    });
                }
            });
        }

// edit process
        $(document).on('click','.edit_student', function(e){
            e.preventDefault();
            var studentId = $(this).val();
            $('#studentEditModal').find("input").val('')
            $('#studentEditModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/edit-student/"+studentId,
                success: function (response) {
                    // console.log(response);
                    if(response.status == 400){
                        $('#editMessage').html("");
                        $('#editMessage').addClass("alert alert-warning");
                        $('#editMessage').append('<li>'+response.error+'</li>');
                    }else{
                        $('#edit_student_id').val(response.data.id)
                        $('#edit_name').val(response.data.name)
                        $('#edit_email').val(response.data.email)
                        $('#edit_phone').val(response.data.phone)
                        $('#edit_course').val(response.data.course)
                        // $('#edit_image').val(response.data.image)
                        $('#originalImage').html("");
                        $('#originalImage').append(
                            '<img src="upload/students/'+response.data.image+'" width="100px">'
                        );
                    }
                }
            });
        })

//Update Process
        $(document).on('submit','#UpdatedImageForm', function(e){
            e.preventDefault();
            var student_id = $('#edit_student_id').val();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
        $.ajax({
            type: "POST",
            url: "/update-student/"+student_id,
            data: formData,
            contentType:false,
            processData:false,
            success: function (response) {
                if(response.status == 400){
                    $('#editMessage').html("");
                        $('#editMessage').addClass("alert alert-warning");
                        $.each(response.errors, function (key, value) {
                        $('#editMessage').append('<li>'+value+'</li>');
                        })
                }else if(response.status == 200){
                    $('#editMessage').html("");
                        $('#successMessage').addClass("alert alert-success");
                        $('#successMessage').text(response.success)
                        $('#studentEditModal').find("input").val('')
                        $('#studentEditModal').modal('hide')
                        fetchStudent()
                }else{
                    $('#editMessage').html("");
                        $('#editMessage').addClass("alert alert-warning");
                        $('#editMessage').text(response.notFound)
                }
            }
        });

        })

        // delete process
        $(document).on('click', '.delete_student',function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
            var student_id = $(this).val();
            $.ajax({
                type: "delete",
                url: "/delete-student/"+student_id,
                success: function (response) {
                    if(response.status == 200){
                        $('#editMessage').html("");
                        $('#successMessage').addClass("alert alert-dark");
                        $('#successMessage').text(response.success)
                        fetchStudent()
                    }else{
                        $('#editMessage').html("");
                        $('#successMessage').addClass("alert alert-danger");
                        $('#successMessage').text(response.notFound)
                    }
                }
            });

        });



    });
</script>
</body>
</html>
