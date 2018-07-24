@extends("layouts.company")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <strong>Company Category List</strong>&nbsp;&nbsp;
            <a href="{{url('/admin/company-category/create')}}"><i class="fa fa-plus"></i> New</a>
            <hr>
            <table class="tbl">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Icon</th>
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
                @foreach($company_categories as $company_category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$company_category->name}}</td>
                        <td>{{$company_category->parent_name}}</td>
                        <td><img src="{{asset('uploads/companies/icon/'.$company_category->icon)}}" alt="" width="25"></td>
                        <td>
                            <a href="{{url('/admin/company-category/edit/'.$company_category->id)}}" title="Edit"><i class="fa fa-pencil text-success"></i></a>
                            &nbsp;<a href="{{url('/admin/company-category/delete/'.$company_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav>
                {{$company_categories->links()}}
            </nav>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_company_category").addClass("current");
        })
    </script>
@endsection