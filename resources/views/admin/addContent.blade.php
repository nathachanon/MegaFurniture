@extends('admin.layout_admin')

@section('content')
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin : AddContent</title>



    <style>
    .preview{
      margin-left: 0px;
      max-height: 500px;
      width: 100%;
    }
  </style>

</head>

<body>
  @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

    <div id="wrapper">

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>เพิ่มคอนเทนต์</h2>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        <div class="wrapper wrapper-content">

            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>เลือกรูปภาพคอนเทนต์</h5><br>
                        <div>  <img id='content_pic_show' src="#" class="preview" hidden="true"  >
                         <div>
                          <input id="content_pic" type="file" name="content_pic" class="form-control" onchange="logoSelect(this)">
                        </div>
                        <h5>ชื่อคอนเทนต์</h5>
                      <input id="content_name" maxlength="200" type="text" name="content_name" class="form-control" >

                        <h5>รายละเอียดคอนเทนต์</h5>
                        <textarea id="content_name" maxlength="1000" type="text" name="content_des" class="form-control" ></textarea>
                        <br>
                        <h5>เนื้อหาคอนเทนต์</h5>
                        


                    </div>
                    </div>

                    <div class="ibox-content no-padding">
                        <div class="summernote">
                        </div>
                      <button id='addPro'>บันทึก</button>
                    </div>
                </div>
            </div>
            </div>
            </div>
        <div class="footer">
            <div class="pull-right">

            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>

        </div>
        </div>


        <!-- Mainly scripts -->
        <script src="../js/jquery-2.1.1.js"></script>

    <script>
    $("#test").click(function(){
    console.log($(".note-editable").html());
    });
        $(document).ready(function(){

            $('.summernote').summernote({
              disableDragAndDrop: false

            });



        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };

       });
        function logoSelect(input) {
          if (!input.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){

              $('#Content_pic').val('');
              alert('โปรดเลือกไฟล์รูปภาพ');
          }else{

         $('#content_pic_show').attr('hidden',false);
         if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
             $('#content_pic_show')
             .attr('src', e.target.result);
                 };
           reader.readAsDataURL(input.files[0]);
         }
       }
       }


       $("#addPro").click(function(){
          var token = localStorage.getItem("a_token");
          var id = localStorage.getItem("admin_id");
          var content_name = $("#content_name").val();
          var content_des = $("#content_des").val(); 
          var content_all = $(".note-editable").html();
          var content_pic = $('#content_pic').prop('files')[0];
            var formData = new FormData();
            formData.append("content_pic",$('#content_pic').prop('files')[0]);
            formData.append("content_name",content_name);
            formData.append("content_des",content_des);
            formData.append("content_all",content_all);
            formData.append("content_status",1);
            formData.append("admin_id",id);
           if(content_name != '' && content_des != '' && $('#content_pic').prop('files')[0] != undefined){
              $.ajax({
                 url: '/api/addContent',
                 headers: {
                   'Authorization':'Bearer '+token,
                 },
                 method: 'POST',
                 data: formData,
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 success: function(data){
                   console.log(data);
                  var s = JSON.stringify(data['success']).replace(/['"]+/g, '');
                  if(s == "1")
                  {
                    alert("เพิ่มคอนเทนต์สำเร็จ !");
                    window.location.replace('content');
                  }else{
                    alert(s);
                  }
                },
                failure: function(errMsg) {
                  alert(errMsg);
                },error: function(result) {
                   window.location.replace('/admin');
                }
              });
            }else if(content_name != '' && content_des != ''){

              if($('#content_pic').prop('files')[0] == undefined ){
                alert('กรุณาเลือกรูปภาพคอนเทนต์');
              }else{
              alert('กรุณากรอกข้อมูลคอนเทนต์');
            }
          }
          else{
              alert('กรุณากรอกข้อมูลและเลือกูปภาพคอนเทนต์');
            }


        });

    </script>

</body>

</html>




@endsection
