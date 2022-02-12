$('#validate_editProfile').click(function() {

    var flag = false;
    var username = $("#username").val();
    var profile_img = $('#profile_img');
    var password = $('#new_password').val();
    var password_confirm = $('#new_password_confirm').val();
    var format = /[ `!@#$%^&*()+\-=\[\]{};':"\\|,.<>\/?~]/;

    // Check Username; 
    // if(format.test(username)){
    //     $("#username").removeClass("form-control").addClass("form-control border border-danger is-invalid");
    //     var span = document.createElement("span");
    //     span.setAttribute("class",'invalid-feedback');
    //     span.setAttribute("role",'alert');
    //     span.appendChild(document.createTextNode("- ชื่อผู้ใช้ต้องเป็นตัวอักษร A-Z, a-z 0-9, _ เท่านั้น"));
    //     document.getElementById("input_username").appendChild(span);
    //     var flag = true;
    // }else{
    //     $("#username").removeClass("form-control border border-danger is-invalid").addClass("form-control");
    // }

    // Check Profile img
    function getExtension(filename) {
        var parts = filename.split('.');
        return parts[parts.length - 1];
    }

    function isImage(filename) {
        console.log(filename);
        var ext = getExtension(filename);
        switch (ext.toLowerCase()) {
          case 'jpg':
          case 'png':
            //etc
            return true;
        }
        return false;
    }
    if(!isImage(profile_img.val())){
        $("#profile_img").removeClass("custom-file-input").addClass("custom-file-input border border-danger is-invalid");
        alert("ชนิดไฟล์ไม่ถูกต้อง ไฟล์ต้องเป็นรูปภาพนามสกุล .jpg หรือ .png เท่านั้น");
        var flag = true;
    }

    // Check Password
    var temp_type = "";  
    if(password.length<6){
        $("#new_password").removeClass("form-control").addClass("form-control border border-danger is-invalid");
        $('#input_new_password').find('span').remove()
        var span = document.createElement("span");
        span.setAttribute("class",'invalid-feedback');
        span.setAttribute("role",'alert');
        span.appendChild(document.createTextNode("- รหัสผ่านต้องมีความยาว 6 ตัวอักษรขึ้นไป"));
        document.getElementById("input_new_password").appendChild(span);
        var flag = true;
    }
    for(var i=0;i<password.length;i++){
        if(i != 0){
            if(isNaN(password[i]) != isNaN(password[i-1])){
                
            }else{
                $("#new_password").removeClass("form-control").addClass("form-control border border-danger is-invalid");
                $('#input_new_password').find('span').remove()
                var span = document.createElement("span");
                span.setAttribute("class",'invalid-feedback');
                span.setAttribute("role",'alert');
                span.appendChild(document.createTextNode("- รหัสผ่านต้องเป็นตัวอักษรหรือตัวเลข ที่ไม่เรียงต่อกัน"));
                document.getElementById("input_new_password").appendChild(span);
                var flag = true;
                break;
            }
        }
    }
    if(password != password_confirm){
        $("#new_password_confirm").removeClass("form-control").addClass("form-control border border-danger is-invalid");
        $('#input_new_password_confirm').find('span').remove()
        var span = document.createElement("span");
        span.setAttribute("class",'invalid-feedback');
        span.setAttribute("role",'alert');
        span.appendChild(document.createTextNode("- รหัสผ่านไม่ตรงกัน"));
        document.getElementById("input_new_password_confirm").appendChild(span);
        var flag = true;
    }
    
    if(flag == false){
        document.getElementById('register').submit();
    }
});