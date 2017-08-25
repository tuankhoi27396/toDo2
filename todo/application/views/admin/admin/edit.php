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
                    <h6>Cập nhật thông tin Quản trị viên</h6>
                </div>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Họ tên:<span class="req">*</span></label>
                            <div class="formRight">
                                <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                <span class="oneTwo"><input name="name" id="param_name"  value="<?php echo $info->name?>" _autocheck="true" type="text"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="tab_container">
                            <div id="tab1" class="tab_content pd0">
                                <div class="formRow">
                                    <label class="formLeft" for="param_username">UserName:<span class="req">*</span></label>
                                    <div class="formRight">
                                        <span class="oneTwo"><input name="username" id="param_username" _autocheck="true" type="text" value="<?php echo $info->username?>"></span>
                                        <span name="username_autocheck" class="autocheck"></span>
                                        <div name="username_error" class="clear error"><?php echo form_error('username')?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="tab_container">
                                    <div id="tab1" class="tab_content pd0">
                                        <div class="formRow">
                                            <label class="formLeft" for="param_password">Password:<span class="req">*</span></label>
                                            <div class="formRight">
                                                <span class="oneTwo"><input name="password" id="param_password" _autocheck="true" type="password">
                                                    <p style="color: #69A505">Nếu cập nhật mật khẩu thì mới nhập vào giá trị</p>
                                                </span>
                                                <span name="password_autocheck" class="autocheck"></span>
                                                <div name="password_error" class="clear error"><?php echo form_error('password')?></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="tab_container">
                                            <div id="tab1" class="tab_content pd0">
                                                <div class="formRow">
                                                    <label class="formLeft" for="param_repassword">Re-Password:<span class="req">*</span></label>
                                                    <div class="formRight">
                                                        <span class="oneTwo"><input name="repassword" _autocheck="true" type="password"></span>
                                                        <span name="repassword_autocheck" class="autocheck"></span>
                                                        <div name="repassword_error" class="clear error"><?php echo form_error('repassword')?></div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear mt30"></div>

                                            </div><!-- End tab_container-->

                                            <div class="formSubmit">
                                                <input value="Cập nhật" class="redB" type="submit" >
                                                <input value="Hủy bỏ" class="basic" type="reset" onclick="window.location='<?php echo admin_url('admin/index');?>'">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
        </fieldset>
    </form>
</div>