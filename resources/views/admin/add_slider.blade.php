@extends('admin_layout')
@section('admin_content')
<div class="box span12">
    <div class="box-header" data-original-title>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
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
        <form class="form-horizontal" action="{{url('/save-slider')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
            <div class="control-group">
                <label class="control-label">Product Image</label>
                <div class="controls">
                    <input type="file" name="slider_image" required="">
                </div>
            </div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Publication Status</label>
                <div class="controls">
                    <input type="checkbox" name="publication_status" class="input-xlarge" value="1" required="">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Slider</button>
                <button type="reset" class="btn">Cancel</button>
            </div>
            </fieldset>
        </form>   

    </div>
</div><!--/span-->
@endsection