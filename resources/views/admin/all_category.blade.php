@extends('admin_layout')
@section('admin_content')
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <p class="alert-success">
        <?php
           $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message',null);
            }
        ?>
       </p>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Category Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                @foreach($all_category as $category)
                <tr>
                    <td>{{ $category->category_id }}</td>
                    <td class="center">{{ $category->category_name }}</td>
                    <td class="center">{{ $category->category_description }}</td>
                    <td class="center">
                        @if($category->publication_status == 1)
                        <span class="label label-success">Active</span>
                        @elseif($category->publication_status == 0)
                        <span class="label">Inactive</span>
                        @endif
                    </td>
                    <td class="center">
                        @if($category->publication_status == 1)
                        <a class="btn btn-success" href="{{url('/inactive-category/'.$category->category_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-danger" href="{{url('/active-category/'.$category->category_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif
                        <a class="btn btn-info" href="{{url('/edit-category/'.$category->category_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" href="{{url('/delete-category/'.$category->category_id)}}" id="delete">
                            <i class="halflings-icon white trash"></i> 
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>            
        </div>
    </div><!--/span-->  
</div><!--/row-->
@endsection