<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    <!-- Button trigger modal -->
    

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">



        <div class="row">
            <div class="col-6 mt-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  Add New Record
                </button>
                {{-- <h1>All user List</h1> --}}
                <a href="/" class="btn btn-success btn-sm mb-3">+Add Record</a>

                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline d-flex">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th colspan="2">Action</th>
                        {{-- <th>DELETE</th>
                        <th>UPDATE</th> --}}
                    </tr>
                    @foreach ($user as $userItem)
                        <tr>
                            <td>{{ $userItem->id }}</td>
                            <td>{{ $userItem->name }}</td>
                            <td>{{ $userItem->email }}</td>

                            <form method="post" action="{{ route('delete', $userItem->id) }}">
                                @csrf
                                @method('DELETE')
                                <td><button class="btn btn-danger btn-sm">DELETE</button>
                                </td>
                            </form>


                            <td><a href="{{ route('update.page', $userItem->id) }}"
                                    class="btn btn-warning btn-sm">UPDATE</a>
                            </td>

                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</body>

</html>




{{-- @foreach ($data as $id => $user)
    <h3>
        {{$user->name}}|
        {{$user->email}}|
        {{$user->age}}|
        {{$user->city}}|
    </h3>
@endforeach --}}
