@extends('admin.layout_admin')

@section('content')


<div class="row border-bottom2">
  <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
    <ul class="nav navbar-top-links navbar-left">
      <li>
        <a class="mt-sbrand" href="#">
          <h3 id="product_counts"></h3>
        </a>

    </ul>
    <ul class="nav navbar-top-links navbar-right">
      <li>
        <a href="addPromotion"><button class="btn btn-primary  " type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เพิ่มโปรโมชัน</span></button></a>
      </li>
    </ul>

  </nav>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-content">
          <h2>จัดการโปรโมชั่น</h2><br>

          </nav>


          <div class="form-group">


          </div>
          <br><br><br>
          <hr>
          <div id="table">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Mainly scripts -->

<script src="../js/jquery-2.1.1.js"></script>
<script src="../js/inspinia.js"></script>
<script src="../js/plugins/pace/pace.min.js"></script>
<script src="../js/plugins/toastr/toastr.min.js"></script>

<script src="../js/plugins/dataTables/datatables.min.js"></script>

<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

<script>
  var token = localStorage.getItem("a_token");

  function getPromotion() {
    $.ajax({
      type: "GET",
      url: "/api/getPromotion",
      headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json'
      },
      success: function(data) {
        console.log(data);
        document.title = 'Admin : Promotion';
        var p_count = data['promotion_count'];
        if (p_count == null) {
          p_count = 0;
        }
        document.getElementById("product_counts").innerHTML = "พบโปรโมชั่น " + p_count + " รายการ";
        $('#table').empty();
        $("#table").append('<table id="tblEntAttributes" class="table table-striped dataTables-example" data-page-size="10" data-filter=#filter>' +
          '<thead>' +
          '<tr>' +
          '<th class="text-left" data-sort-ignore="true" id="selectall"><div class="checkbox checkbox-success"><input name="select-all" id="select-all" type="checkbox" onchange="selectalls(this)"><label for="checkAll" id="all">(0)</label></div></th>' +
          '<th data-toggle="true">ชื่อโปรโมชัน</th>' +
          '<th data-toggle="true">ผู้บันทึก</th>' +
          '<th data-hide="phone">วันที่บันทึก</th>' +
          '<th class="text-right" data-sort-ignore="true">Action</th>' +
          '</tr>' +
          '</thead>' +
          '<tbody id="t_body">' +
          '</tbody>'
        );
        $("#select-all").prop('checked', false);
        for (var i = 0; i < p_count; i++) {

          $('#tblEntAttributes tbody').append(
            '<tr id="tr_' + data['promotion'][i]['promotion_id'] + '">' +
            '<td>' +
            '<div class="checkbox checkbox-success">' +
            '<input id="checkbox_' + data['promotion'][i]['promotion_id'] + '" type="checkbox" value="' + data['promotion'][i]['promotion_id'] + '" onchange="editGroupADD(this,' + data['promotion'][i]['promotion_id'] + ');"><label for="checkbox_' + data['promotion'][i]['Prod_id'] + '"></label>' +
            '</div>' +
            '</td>' +
            '<td style="width:290px;"><a href="../../promotion/' + data['promotion'][i]['promotion_id'] + '">' + data['promotion'][i]['promotion_name'] + '</a></td>' +
            '<td>' + data['promotion'][i]['username'] + '</td>' +
            '<td>' + data['promotion'][i]['created_at'] + '</td>' +
            '<td class="text-right">' +
            '<div class="tooltip-demo">' +
            '<a  data-toggle="tooltip" data-placement="top" title="แก้ไข" href="editPromotion/' + data['promotion'][i]['promotion_id'] + '"><i class="fas fa-pen i-prod"></i></a>' +
            '<a  data-toggle="tooltip" data-placement="top" title="ลบ" onclick="deletePro (' + data['promotion'][i]['promotion_id'] + ')"><i class="far fa-trash-alt i-prod"></i></a>' +
            '</div>' +
            '</td>' +
            '</tr>'
          );
        }
        $("#table").append('</table>');
        $('.dataTables-example').DataTable({
          "searching": false,
          "buttons": false
        });
        $('.footable').footable();
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function deletePro($id) {

    Swal.fire({
      title: 'คุณต้องการลบโปรโมชันหรือไม่?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'ยกเลิก',
      confirmButtonText: 'ใช่, ฉันต้องการลบโปรโมชัน'
    }).then((result) => {
      if (result.value) {

        $.ajax({
          type: "POST",
          url: "/api/delPromotion",
          headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json'
          },
          data: JSON.stringify({
            "promotion_id": $id
          }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data) {
            var s = JSON.stringify(data['success']).replace(/['"]+/g, '');
            if (s == "1") {
              swal(
                "ลบโปรโมชัน!",
                "ลบโปรโมชันสำเร็จ!",
                "success"
              )
              window.setTimeout(function() {
                location.reload();
              }, 2500);
            } else {
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'มีบางอย่างผิดพลาด!',
                footer: '<a href>กรุณาติดต่อผู้ดูแลระบบ</a>'
              })
              location.reload();
            }
          }
        });
      }
    })

  }


  function load() {
    console.log("load");
    getPromotion();
  }
  window.onload = load();
</script>


@endsection