<!--Load file header-->
<?php $this->load->view('admin/catalog/head');?>
<!--Load line-->
<div class="line"></div>

<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/')?>images/icons/dark/add.png" class="titleIcon">
                    <h6>Thêm mới Danh mục sản phẩm</h6>
                </div>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Tên danh mục:<span class="req">*</span></label>
                            <div class="formRight">
                                <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                <span class="oneTwo"><input name="name" id="param_name" value="<?php echo $info->name;?>"  _autocheck="true" type="text"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="tab_container">
                            <div id="tab1" class="tab_content pd0">
                                <div class="formRow">
                                    <label class="formLeft" for="param_parent_id">Danh mục cha:</label>
                                    <div class="formRight">
                                        <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                        <span class="oneTwo">
                                 <select name="parent_id" id="param_parent_id" _autocheck="true" type="text">
                                     <option value="0">Là danh mục cha</option>
                                     <?php foreach ($list as $row):?>
                                         <option value="<?php echo $row->id ?>" <?php echo ($row->id == $info->parent_id) ? 'selected': '';?>><?php echo $row->name;?></option>
                                     <?php endforeach;?>
                                 </select>
                             </span>
                                        <span name="parent_id_autocheck" class="autocheck"></span>
                                        <div name="parent_id_error" class="clear error"><?php echo form_error('parent_id')?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="tab_container">
                                    <div id="tab1" class="tab_content pd0">
                                        <div class="formRow">
                                            <label class="formLeft" for="param_sort_order">Thứ tự hiển thì:</label>
                                            <div class="formRight">
                                                <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                                <span class="oneTwo"><input name="sort_order" id="param_sort_order"  value="<?php echo $info->sort_order;?>" _autocheck="true" type="text"></span>
                                                <span name="sort_order_autocheck" class="autocheck"></span>
                                                <div name="sort_order_error" class="clear error"><?php echo form_error('sort_order')?></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="clear mt30"></div>

                                    </div><!-- End tab_container-->

                                    <div class="formSubmit">
                                        <input value="Cập nhật" class="redB" type="submit" >
                                        <input value="Hủy bỏ" class="basic" type="reset" onclick="window.location='<?php echo admin_url('catalog/index');?>'">
                                    </div>
                                    <div class="clear"></div>
                                </div>
        </fieldset>
    </form>
</div>