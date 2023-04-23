@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.credential.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credentials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.id') }}
                        </th>
                        <td>
                            <input type="hidden" value="{{ $credential->id }}" id="credential_id">
                            {{ $credential->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.platform') }}
                        </th>
                        <td>
                            {{ $credential->platform }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.email') }}
                        </th>
                        <td>
                            {{ $credential->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.password') }}
                        </th>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                                Verify Password
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.credential.fields.comment') }}
                        </th>
                        <td>
                            {{ $credential->comment }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.credentials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Enter Password To Verify</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="match-response"></div>
        <div class="form-group">
            <input type="text" placeholder="Enter Password to Verify" name="verify_password" id="verify_password" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-success" id="verify_btn">Verify</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

<script>
    let matched = '<div class="alert alert-success"><small>Password Matched</small></div>';
    let not_matched = '<div class="alert alert-danger"><small>Password Not Matched</small></div>';
    $(document).on('click','#verify_btn',function(){
        var pass = $('#verify_password').val();
        if(pass != '')
        {
            VerifyPassword(pass);
        }
    });

    function VerifyPassword(pass){
        var credential_id = $('#credential_id').val();
        $.ajax({
          headers: {'x-csrf-token': "{{ csrf_token() }}"},
          method: 'POST',
          url: "{{ route('admin.verify_password') }}",
          data: { 
            credential_id: credential_id,
            password: pass
         },
         success: function(result)
            {
                if(result.matched == true)
                {
                    $('.match-response').html(matched);
                }
                else{
                    $('.match-response').html(not_matched);
                }
            }
        });
         
    }
</script>

@endsection