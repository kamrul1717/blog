<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">


<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-title"><strong>Role Create</strong></div>
            {!! Form::open(array('url' => 'rights/roles/update/'.$roleInfo->id,'method' => 'post','id' => 'roleEditForm','role'=>'form','files'=>true)) !!}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <div class="col-md-12">
                <div class="form-group " style="">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('role_name','Role Name :',['class'=>'col-md-5 text-left required-star']) !!}
                            <div class="col-md-7 {{$errors->has('carrier_type') ? 'has-error': ''}}">
                                {!! Form::text('role_name', $roleInfo->name, ['class' => 'form-control required input-sm']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md" value="submit" name="actionBtn">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<script src="{{ asset("assets/scripts/jquery.min.js") }}"></script>
<script src="{{ asset("assets/scripts/jquery.validate.min.js") }}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    // Jquery Validation form
    $(document).ready(function () {
        $('#roleEditForm').validate();
    });
</script>
