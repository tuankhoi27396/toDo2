<!--Lấy sản phẩm mới-->
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Kết quả tìm kiếm theo giá từ "<?php echo $price_from;?>" tới "<?php echo $price_to;?> "</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <?php foreach ($list as $row):?>
            <div class="product_item">
                <h3>
                    <a href="<?php echo base_url('product/view/'.$row->id);?>" title="<?php echo $row->name;?>">
                        <?php echo $row->name;?>
                    </a>
                </h3>
                <div class="product_img">
                    <a href="<?php echo base_url('product/view/'.$row->id);?>" title="Sản phẩm">
                        <img src="<?php echo base_url('upload/product/').$row->image_link;?>" style="height: 80px" alt="">
                    </a>
                </div>
                <?php if($row->discount>0):?>
                    <p class="price">
                        <?php $price_new=$row->price-(($row->discount*$row->price)/100);?>
                        <?php echo number_format($price_new,0);?> đ
                        <br>
                        <span class="price_old"><?php echo number_format($row->price,0);?> đ</span>
                    </p>
                <?php else:?>
                    <p class="price">
                        <?php echo number_format($row->price,0);?> đ
                        <br><br>
                    </p>
                <?php endif;?>
                <center>
                    <div class='raty' style='margin:10px 0px' id='9' data-score='4'></div>
                </center>
                <div class="action">
                    <p style="float:left;margin-left:10px">Lượt xem: <b> <?php echo $row->view;?></b></p>
                    <a class="button" href="them-vao-gio-9.html" title="Mua ngay">Mua ngay</a>
                    <div class="clear"></div>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="clear"></div>
    </div><!-- End box-content-center -->
</div>

<div class="pagination">
    <?php echo $this->pagination->create_links();?>
</div>
