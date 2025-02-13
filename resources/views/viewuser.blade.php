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
                    <input type="text" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4">
            {{-- search --}}
            <form action="" class="col-5" method="">
                <div class="form-group">
                    <label for=""><b>Search</b></label>
                    <input type="search" name="search" class="form-control" id="search"
                        placeholder="search by name or email" />
                </div>
                {{-- <button class="btn btn-primary">Search</button> --}}
            </form>

            {{-- end search --}}

            {{-- start date --}}
            <div class="container mt-4">
                <form action="{{route('fetchdata')}}" method="GET">
                    <div class="col-md-12 d-flex">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label"><b>Start Date</b></label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                placeholder="Select Start Date">
                        </div>
                         &nbsp;&nbsp;&nbsp;
                        <!-- End Date -->
                        <div class="col-md-4">
                            <label for="end_date" class="form-label"><b>End Date</b></label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                placeholder="Select End Date">
                        </div>
                        <div class="btn">
                            <button type="submit" class="btn  btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- end date --}}


            <div class="col-6 mt-4">
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add New Record
                </button> --}}
                {{-- <h1>All user List</h1> --}}
                <a href="/" class="btn btn-success btn-sm mb-3">+Add Record</a>

                {{-- <nav class="navbar navbar-light bg-light">
                    <form class="form-inline d-flex">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav> --}}
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>Nunber</th>
                        <th colspan="2">Action</th>
                        {{-- <th>DELETE</th>
                        <th>UPDATE</th> --}}
                    </tr>
                    <tbody class="alldata">
                    @foreach ($user as $userItem)
                        <tr>
                            <td>{{ $userItem->id }}</td>
                            <td>{{ $userItem->name }}</td>
                            <td>{{ $userItem->email }}</td>
                            <td>{{ $userItem->phone_number }}</td>

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
                </tbody>
                    <tbody id="tbody" class="searchdata"></tbody>
                </table>

            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <script>
        $('#search').on('keyup', function(){
           $value= $(this).val();
            if($value){
                $('.alldata').hide();
                $('.searchdata').show();
            }else{
                $('.alldata').show();
                $('.searchdata').hide();
            }

           $.ajax({
            type:'get',
            url:"{{ route('search')}}",
            data:{
                'search':$value
            },
            success:function(data){
                console.log(data);
                $('#tbody').html(data);
                
            }
           })
        });
    </script>

</html>
