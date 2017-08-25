<!--Load file header-->
<?php $this->load->view('admin/item/head');?>
<!--Load line-->
<div class="line"></div>

<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/')?>images/icons/dark/add.png" class="titleIcon">
                    <h6>Update Item</h6>
                </div>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">

                        <div class="formRow">
                            <label class="formLeft" for="param_title">Title:<span class="req">*</span></label>
                            <div class="formRight">
                                <!-- Hàm set_value để dùng lại giá trị đã nhập,không bị xóa đi khi gặp lỗi.-->
                                <span class="oneTwo"><input name="title" id="param_title"  value="<?php echo $info->title?>" _autocheck="true" type="text"></span>
                                <span name="title_autocheck" class="autocheck"></span>
                                <div name="title_error" class="clear error"><?php echo form_error('title')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_cat">Category:<span class="req">*</span></label>
                            <div class="formRight">

                                <select name="category" _autocheck="true" id="param_cat" value="" class="left">
                                    <option value=""></option>
                                    <?php foreach ($category as $row):?>
                                        <option value="<?php echo $row->id;?> "<?php if($row->id==$info->category_id) echo 'selected';?>>
                                            <?php echo $row->name;?>
                                        </option>
                                    <?php endforeach;?>

                                </select>

                                <span name="cat_autocheck" class="autocheck"></span>
                                <div name="cat_error" class="clear error"></div>
                            </div>


                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_des">Description:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="des" id="param_des" rows="4" cols=""><?php echo $info->description?></textarea></span>
                                <span name="des_autocheck" class="autocheck"></span>
                                <div name="des_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>


                        <div class="clear mt30"></div>

                    </div><!-- End tab_container-->

                    <div class="formSubmit">
                        <input value="Update" class="redB" type="submit" >
                        <input value="Abort" class="basic" type="reset" onclick="window.location='<?php echo base_url('admin_Item/index');?>'">
                    </div>
                    <div class="clear"></div>
                </div>
        </fieldset>
    </form>
</div>