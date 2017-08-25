<!--Load file header-->
<?php $this->load->view('admin/catalog/head');?>
<!--Load line-->
<div class="line"></div>
<!--Load danh sách-->
<div class="wrapper">
    <?php $this->load->view('admin/message',$this->data)?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><div class="checker" id="uniform-titleCheck"><span><input id="titleCheck" name="titleCheck" style="opacity: 0;" type="checkbox"></span></div></span>
            <h6>Danh sách danh mục sản phẩm</h6>
            <div class="num f12">Tổng số: <b><?php echo $total?></b></div>
        </div>

        <form action="http://localhost/webphp/index.php/admin/user.html" method="get" class="form" name="filter">
            <table class="sTable mTable myTable withCheck" id="checkAll" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <td style="width:10px;"><img src="<?php echo public_url();?>admin/images/icons/tableArrows.png"></td>
                    <td style="width:160px;">Mã số</td>
                    <td style="width:320px; ">Tên danh mục</td>
                    <td>Thứ tự hiển thị</td>
                    <td style="width:100px;">Hành động</td>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('catalog/delete_all');?>">
                                <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>

                        <div class="pagination">
                        </div>
                    </td>
                </tr>
                </tfoot>

                <tbody>
                <!-- Filter -->
                <?php foreach ($list as $row):?>
                    <tr class="row_<?php echo $row->id;?>">
                        <td><div class="checker" id="uniform-undefined"><span><input name="id[]" value="<?php echo $row->id;?>" style="opacity: 0;" type="checkbox"></span></div></td>

                        <td class="textC"><?php echo $row->id;?></td>


                        <td>
                        <span class="tipS" original-title="<?php echo $row->name;?>">
                            <?php echo $row->name;?>
                        </span>
                        </td>


                        <td>
                        <span class="tipS" original-title="<?php echo $row->sort_order;?>">
							<?php echo $row->sort_order;?>
                        </span>
                        </td>


                        <td class="option">
                            <a href="<?php echo admin_url('catalog/edit/'.$row->id)?>" class="tipS " original-title="Chỉnh sửa">
                                <img src="<?php echo public_url();?>admin/images/icons/color/edit.png">
                            </a>

                            <a href="<?php echo admin_url('catalog/delete/'.$row->id)?>" class="tipS verify_action" original-title="Xóa">
                                <img src="<?php echo public_url();?>admin/images/icons/color/delete.png">
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div class="clear mt30">

</div>