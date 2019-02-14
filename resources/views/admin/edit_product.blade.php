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
        <form class="form-horizontal" action="{{url('/update-product/'.$product_details->product_id)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>
            <div class="control-group">
                <label class="control-label" for="date01">Product Name</label>
                <div class="controls">
                <input type="text" class="input-xlarge" name="product_name" required="" value="{{$product_details->product_name}}">
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label" for="selectError3">Product Category</label>
                <div class="controls">
                    <select id="selectError3" name="category_id">
                    <option>Select Category</option>
                    @foreach($product_categories as $category)
                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Manufacture Name</label>
                <div class="controls">
                    <select id="selectError3" name="manufacture_id">
                    <option>Select Brand</option>
                    @foreach($product_brands as $brand)
                    <option value="{{$brand->manufacture_id}}">{{$brand->manufacture_name}}</option>
                    @endforeach
                    </select>
                </div>
			</div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Product Short Description</label>
                <div class="controls">
                <textarea class="cleditor" id="textarea2" rows="3" name="product_short_description">{{$product_details->product_short_description}}</textarea>
                </div>
            </div>
            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Product Long Description</label>
                <div class="controls">
                <textarea class="cleditor" id="textarea2" rows="3" name="product_long_description">{{$product_details->product_long_description}}</textarea>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">Product Image</label>
                <div class="controls">
                    <input type="file" name="product_image">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="date01">Product Price</label>
                <div class="controls">
                <input type="text" class="input-xlarge" name="product_price" required="" value="{{$product_details->product_price}}">
                </div>
            </div> 
            <div class="control-group">
                <label class="control-label" for="date01">Product Size</label>
                <div class="controls">
                <input type="text" class="input-xlarge" name="product_size" required="" value="{{$product_details->product_size}}">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="date01">Product Color</label>
                <div class="controls">
                <input type="text" class="input-xlarge" name="product_color" required="" value="{{$product_details->product_color}}">
                </div>
            </div>  
          
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Edit Product</button>
                <button type="reset" class="btn">Cancel</button>
            </div>
            </fieldset>
        </form>   

    </div>
</div><!--/span-->
@endsection