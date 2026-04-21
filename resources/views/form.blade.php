<?php 

// echo "<pre>";
// print_r($errors);
// echo "</pre>";    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid vh-100 ">
        <div class="container  d-flex justify-content-center align-items-center w-100 h-100">

            <div class="card shadow w-50 p-3">

                {{-- <div class="title text-center p-2 border-bottom border-bottom-primary">
                    <h4 class="text-primary fs-2">Registration Form</h4>
                </div> --}}

                <form action={{ url('/formSubmit') }} method="post" enctype="multipart/form-data">

                    @if(session('success'))
                        <div class="alert alert-success"> {{session('success')}} </div>
                    @endif


                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Name</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Enter Name.." value={{old('name')}}>

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Email</label>
                            <input type="text" name="email" id="" class="form-control" placeholder="Enter Email.." value={{old('email')}}>

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Mobile No.</label>
                            <input type="text" name="mobile" id="" class="form-control" placeholder="Enter Mobile No.." value={{old('mobile')}}>

                            @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="" class="form-control" placeholder="Enter Password.." value={{old('password')}}>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="confirm_password" id="" class="form-control" placeholder="Enter Confirm Password.." value={{old('confirm_password')}}>

                            @error('confirm_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12  mb-2" >
                            <label for="" class="form-label fw-bold">Upload Profile Pic</label>
                            <input type="file" name="profile_pic" id="" class="form-control" value={{old('profile_pic')}} >

                            @error('profile_pic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <div class="d-grid">
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>