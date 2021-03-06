<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container">
         <div class="row mb-2">
            <div class="col-sm-6">
               <?php $segment =  $this->uri->segment(3); ?>
               <h1 class="m-0 text-dark"><?php echo ($segment=="form" ? 'เพิ่มข้อมูล' : 'แก้ไขข้อมูล') ?></h1>
            </div>
            <div class="col-sm-6 text-right">
				<div class="btn-manage">
					<button type="submit" class="btn btn-success" id="btn_submit">บันทึก</button>
						<a href="<?php echo base_url('admin/Shipping'); ?>" class="btn btn-warning">ยกเลิก</a>
					</div>
            </div>
         </div>
      </div>
   </div>

   <!-- Main content -->
   <section class="content pb-5">
      <div class="container">
         <form id="frm_submit" action="<?php echo base_url('admin/Shipping/'.$action); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="hd_id" value="<?php echo (isset($info) ? $info->id : ''); ?>">
            <div class="form-group">
               <label for="txt_name">บริการการจัดส่ง</label>
               <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="ชื่อบริการ" value="<?php echo (isset($info->name) ? $info->name : set_value('txt_name')); ?>" require>
					<?php echo form_error('txt_name', '<div class="text-danger small">*', '</div>'); ?>
            </div>				            
				<div class="form-group">
               <label for="txt_desc">คำอธิบาย</label>
					<textarea name="txt_desc" id="txt_desc" rows="5" class="form-control"><?php echo (isset($info->desc) ? $info->desc : set_value('txt_desc')); ?></textarea>
            </div>
            <div class="form-group">
               <label for="txt_description">การใช้งาน</label>
               <select name="ddl_status" id="ddl_status" class="form-control">
                  <option value="1" <?php echo (isset($info) ? ($info->status == '1' ? 'selected=selected' : '') : '' ); ?>>เปิด</option>
                  <option value="0" <?php echo (isset($info) ? ($info->status == '0' ? 'selected=selected' : '') : '' ); ?>>ปิด</option>
               </select>      
            </div>				
         </form>
      </div>
   </section>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<script src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
<script>
   $(function(){		
      $('#btn_submit').on('click',function(){
			$('#frm_submit').submit();
		});
		
		$('#txt_firstQty').on('change',function(){
			var id = $(this).attr('id');
			var val =$(this).val();
			checkNum(id,val);
		});

		$('#txt_lastQty').on('change',function(){
			var id = $(this).attr('id');
			var val =Number($(this).val().toLocaleString());
			var fval = Number($('#txt_firstQty').val());
			
			if(val > fval){
				checkNum(id,val);
			}else{
				$(this).val('');
				$(this).addClass('error-validate');
				$(this).attr('placeholder','* จำนวนสุดท้ายต้องมากว่า จำนวนเริ่มต้น');
			}

		});

		$('#txt_shippingRate').on('change',function(){
			var id = $(this).attr('id');
			var val =$(this).val();
			checkNum(id,val);
		});
	});
	
	function checkNum(id,val){
		var fqty = $.isNumeric( val );
		if(!fqty){
			$('#'+id).val('');
			$('#'+id).addClass('error-validate');
			$('#'+id).attr('placeholder','* กรอกเฉพาะตัวเลข');
		}else{
			$('#'+id).removeClass('error-validate');
		}
	}
</script>
