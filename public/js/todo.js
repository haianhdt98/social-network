$('#btnEditProfile').on("click", function (e) {
    e.preventDefault()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var avatar = $("input[name=avatar]").val();
    var name = $("input[name=name]").val();
    var email = $("input[name=email]").val();
    var address = $("input[name=address]").val();

    $.ajax({
        data: $('#editProfile').serialize(),
        url: "/user/" + $("#user_id").val() + "/edit",
        type: "POST",
        dataType: 'json',
        // data: {
        //     comment:comment,
        //     post_id:post_id,
        //     user_id:user_id,
        //     parent_id:parent_id,
        // },
        success:function(data){
            alert("success");
            $('#editProfileForm').append(
                `
                <div class="row">
                    <div class="col-md-3 form-group">
                        <div class="text-center">  
                            <label for="avatar">
                                <img src="{{ asset(config('media.image') . $user->avatar) }}" class="avatar img-circle edit-avatar-img" alt="{{ trans('profile.user_avt') }}" id="avt-img-edit">
                            </label>
                        </div>  
                    </div>  
                    <div class="col-md-9 personal-info info-style">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('edit.user_name') }}</label>
                            <div class="col-lg-8">
                                <h4>{{ $user->name }}</h4>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label  ="col-lg-3 control-label">{{ trans('edit.email') }}</label>
                            <div class="col-lg-8">
                                <h4>{{ $user->email }}</h4>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('edit.address') }}</label>
                            <div class="col-lg-8">
                                <h4>{{ $user->address }}</h4>
                            </div>
                        </div>  
                    </div>  
                </div>
                `
            );
        }
    });

});

    
