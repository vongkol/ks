@extends("layouts.company")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Company List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/company/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>address</th>
                    <th>Office Phone</th>
                    <th>Office Email</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $pagex = @$_GET['page'];
                if(!$pagex)
                    $pagex = 1;
                $i = 12 * ($pagex - 1) + 1;
                ?>
                @foreach($companies as $company)
                    <tr>
                        <td>{{$i++}}</td>
                        <td><img src="{{asset('uploads/companies/logo/'.$company->logo)}}" alt="" width="50"></td>
                        <td>{{$company->name}}</td>
                        <td>{{$company->address}}</td>
                        <td>{{$company->office_phone}}</td>
                        <td>{{$company->office_email}}</td>
                        <td>{{$company->website}}</td>
                        <td>
                            <a href="{{url('/admin/company/detail/'.$company->id)}}" title="Detail"><i class="fa fa-eye"></i></a>
                            &nbsp;<a href="{{url('/admin/company/edit/'.$company->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a  href="{{url('/admin/company/delete/'.$company->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$companies->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_company").addClass("current");
        })
    </script>
@endsection