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
                        <th>Slider ID</th>
                        <th>Slider Image</th>
                        <th>Slider Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                @foreach($all_slider as $slider)
                <tr>
                    <td class="center">{{ $slider->slider_id }}</td>
                    <td class="center"><img src="{{url($slider->slider_image)}}" alt="Slider Image" style="width:250px;height:150px;"></td>
                    <td class="center">
                        @if($slider->publication_status == 1)
                        <span class="label label-success">Active</span>
                        @elseif($slider->publication_status == 0)
                        <span class="label">Inactive</span>
                        @endif
                    </td>
                    <td class="center">
                        @if($slider->publication_status == 1)
                        <a class="btn btn-success" href="{{url('/inactive-slider/'.$slider->slider_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-danger" href="{{url('/active-slider/'.$slider->slider_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif
                        <a class="btn btn-danger" href="{{url('/delete-slider/'.$slider->slider_id)}}" id="delete">
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