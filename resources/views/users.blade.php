<?php 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
    <div class="container-fluid vh-100">
        <div class="container d-flex justify-content-center align-items-center w-100 h-100">

            <div class="card shadow w-75 p-3">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('users.export') }}" class="btn btn-success">
                        Export CSV
                    </a>
                </div>
                
                <table class="table overflow-hidden rounded align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($users->count() > 0)

                            @foreach($users as $key => $user)
                            <tr>
                                <td> {{$key + 1}} </td>
                                <td class="d-flex gap-3 align-items-center">
                                    <div class="icon  rounded-circle overflow-hidden" style="height: 50px; width:50px">
                                        <img src={{ asset('storage/'. $user['profile_pic'] )  }} alt="" srcset="" class="w-100 h-100">
                                    </div>
                                    {{$user['username']}} 
                                </td>
                                <td> {{$user['email']}} </td>
                                <td> {{$user['mobile']}} </td>
                                <td class="d-flex gap-2 align-items-center">
                                    <a href= {{ "/admin/edit/". $user['id'] }} class="btn btn-primary ">Edit</a>

                                    <form action={{route('users.destroy', $user->id)}} method="post" onSubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-danger">
                                    No Record Found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>