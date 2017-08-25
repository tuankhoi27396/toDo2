<!--Load file header-->
<?php $this->load->view('admin/admin/head');?>
<!--Load line-->
<div class="line"></div>

<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/')?>images/icons/dark/add.png" class="titleIcon">
                    <h6>Update Category</h6>
                </div>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Name:<span class="req">*</span></label>
                            <div class="formRight">
                                <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                <span class="oneTwo"><input name="name" id="param_name"  value="<?php echo $info->name?>" _autocheck="true" type="text"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                                                <div class="clear mt30"></div>

                                            </div><!-- End tab_container-->

                                            <div class="formSubmit">
                                                <input value="Cập nhật" class="redB" type="submit" >
                                                <input value="Hủy bỏ" class="basic" type="reset" onclick="window.location='<?php echo base_url('admin_Category/index');?>'">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
        </fieldset>
    </form>
</div>