<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset("assets/css/select2.min.css") }}">


<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="card-title"><strong>Assign Role</strong></div>
            {!! Form::open(array('url' => "rights/roles/save-role/".$userInfo->id,'method' => 'post','id' => 'assignRoleForm','role'=>'form','files'=>true)) !!}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            <div class="col-md-12">
                <div class="form-group " style="">
                    <div class="col-md-6">
                        {!! Form::label('role_name','User Name :',['class'=>'col-md-5 text-left']) !!}
                        <div class="col-md-7">
                            {{ $userInfo->name }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('role','Role :',['class'=>'col-md-5 text-left']) !!}
                        <div class="col-md-7 {{$errors->has('role') ? 'has-error': ''}}">
                            {!! Form::select('role[]', $roles, '', ['class' => 'form-control select2 input-sm required', 'multiple'=>'true', 'placeholder' => 'Select One']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md" value="submit" name="actionBtn">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<script src="{{ asset("assets/scripts/select2.min.js") }}"></script>

<script src="{{ asset("assets/scripts/jquery.min.js") }}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>


<script>
    $(document).ready(function(){
        //Select2
        $(".select2").select2({

        });
    });
</script>
