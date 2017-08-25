<!--Load file header-->
<?php $this->load->view('admin/slide/head');?>
<!--Load line-->
<div class="line"></div>

<div class="wrapper">

    <!-- Form -->
    <form class="form" id="form" action="<?php echo admin_url()?>/slide/add" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url()?>admin/images/icons/dark/add.png" class="titleIcon">
                    <h6>Thêm mới slide</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>

                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Tên slide:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name')?></div>
                                <?php echo form_error('name')?>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            <div class="formRight">
                                <div class="left">
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_info">Thông tin:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="info" id="param_info" _autocheck="true" type="text"></span>
                                <span name="info_autocheck" class="autocheck"></span>
                                <div name="info_error" class="clear error"><?php echo form_error('info')?></div>
                                <?php echo form_error('info')?>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_link">Link:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="link" id="param_link" _autocheck="true" type="text"></span>
                                <span name="link_autocheck" class="autocheck"></span>
                                <div name="link_error" class="clear error"><?php echo form_error('link')?></div>
                                <?php echo form_error('link')?>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_sort_order">Thứ tự:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="sort_order" id="param_sort_order" _autocheck="true" type="text"></span>
                                <span name="sort_order_autocheck" class="autocheck"></span>
                                <div name="sort_order_error" class="clear error"><?php echo form_error('sort_order')?></div>
                                <?php echo form_error('sort_order')?>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow hide"></div>
                    </div>

                    <div id="tab2" class="tab_content pd0">



                        <div class="formRow">
                            <label class="formLeft" for="param_meta_desc">Meta description:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""></textarea></span>
                                <span name="meta_desc_autocheck" class="autocheck"></span>
                                <div name="meta_desc_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_meta_key">Meta keywords:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""></textarea></span>
                                <span name="meta_key_autocheck" class="autocheck"></span>
                                <div name="meta_key_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>

                    <div id="tab3" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft">Nội dung:</label>
                            <div class="formRight">
                                <textarea name="content" id="param_content" class="editor"></textarea>
                                <div name="content_error" class="clear error"></div>
                                <div name="title_error" class="clear error"><?php echo form_error('content')?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>


                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input type="submit" value="Thêm mới" class="redB">
                    <input type="reset" value="Hủy bỏ" class="basic" onclick="window.location='<?php echo admin_url('product/index');?>'" >
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>