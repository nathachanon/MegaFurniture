@extends('admin.layout_admin')

@section('content')
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin : Edit Promotion</title>

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
<!--
{!! $promotionDetail->promotion_name !!}
 {!! $promotionDetail->promotion_des !!}
-->
    <div id="wrapper">

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>แก้ไขโปรโมชัน</h2>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        <div class="wrapper wrapper-content">

            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>เลือกรูปภาพโปรโมชัน</h5><br>
                        <div>  <img id='promotion_pic_show' src="#" class="preview" hidden="true"  ></img>
                         <div>
                          <input id="promotion_pic" type="file" name="promotion_pic" class="form-control" onchange="logoSelect(this)">
                        </div>
                        <h5>ชื่อโปรโมชัน</h5>
                      <input id="promotion_name" maxlength="200" type="text" name="promotion_name" class="form-control" value="{!! $promotionDetail->promotion_name !!}"  >

                        <h5>รายละเอียดโปรโมชัน</h5>


                    </div>
                    </div>

                    <div class="ibox-content no-padding">
                        <div class="summernote">
                        {!!$promotionDetail->promotion_des!!}
                        </div>
                      <button id='editPro'>บันทึก</button>
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



<script src="../../js/jquery-2.1.1.js"></script>
    <script>
    $("#test").click(function(){
    console.log($(".note-editable").html());
    });
        $(document).ready(function(){

            function load(){       
      
            $('.summernote').summernote();
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };
        
            }
    window.load = load();

       });
        function logoSelect(input) {
          if (!input.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){

              $('#promotion_pic').val('');
              alert('โปรดเลือกไฟล์รูปภาพ');
          }else{

         $('#promotion_pic_show').attr('hidden',false);
         if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
             $('#promotion_pic_show')
             .attr('src', e.target.result);
                 };
           reader.readAsDataURL(input.files[0]);
         }
       }
       }


       $("#editPro").click(function(){
          var token = localStorage.getItem("a_token");
          var promotion_id = '{{$promotionDetail->promotion_id}}';
          var promotion_name = $("#promotion_name").val();
          var promotion_des = $(".note-editable").html();
          var promotion_pic = $('#promotion_pic').prop('files')[0];
            var formData = new FormData();
            formData.append("promotion_pic",$('#promotion_pic').prop('files')[0]);
            formData.append("promotion_name",promotion_name);
            formData.append("promotion_des",promotion_des);
            formData.append("promotion_status",1);
            formData.append("promotion_id",promotion_id);
           if(promotion_name != '' && promotion_des != '' ){
              $.ajax({
                 url: '/api/editPromotion',
                 headers: {
                   'Authorization':'Bearer '+token,
                 },
                 method: 'POST',
                 data: formData,
                 contentType: false,
                 processData: false,
                 dataType: 'json',
                 success: function(data){
                  var s = JSON.stringify(data['success']).replace(/['"]+/g, '');
                  if(s == "1")
                  {
                    alert("แก้ไขโปรโมชันสำเร็จ !");
                    window.location.replace('/admin/promotion');
                  }else{
                    alert(s);
                  }
                },
                failure: function(errMsg) {
                  alert(errMsg);
                },error: function(result) {
                  localStorage.removeItem("a_token");
                     window.location.replace('/admin');
                }
              });
            }else if(promotion_name != '' && promotion_des != ''){

              
              alert('กรุณากรอกข้อมูลให้ครบ');
            
          }
          else{
              alert('กรุณากรอกข้อมูลให้ครบ');
            }


        });

    </script>

</body>

</html>




 @endsection
