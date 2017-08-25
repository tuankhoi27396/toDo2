<!-- lay slide -->
<script src="<?php echo public_url();?>site/royalslider/jquery.royalslider.min.js"></script>
<link type="text/css" href="<?php echo public_url();?>site/royalslider/royalslider.css" rel="stylesheet">
<link type="text/css" href="<?php echo public_url();?>site/royalslider/skins/minimal-white/rs-minimal-white.css" rel="stylesheet">


<script type="text/javascript">
    (function($)
    {
        $(document).ready(function()
        {
            $("#HomeSlide").royalSlider({
                arrowsNav:true,
                loop:false,
                keyboardNavEnabled:true,
                controlsInside:false,
                imageScaleMode:"fill",
                arrowsNavAutoHide:false,
                autoScaleSlider:true,
                autoScaleSliderWidth:580,//chiều rộng slide
                autoScaleSliderHeight:205,//chiều cao slide
                controlNavigation:"bullets",
                thumbsFitInViewport:false,
                navigateByClick:true,
                startSlideId:0,
                autoPlay:{enabled:true, stopAtAction:false, pauseOnHover:true, delay:5000},
                transitionType:"move",
                slideshowEnabled:true,
                slideshowDelay:5000,
                slideshowPauseOnHover:true,
                slideshowAutoStart:true,
                globalCaption:false
            });
        });
    })(jQuery);
</script>


<style>
    #HomeSlide.royalSlider {
        width: 580px;
        height: 205px;
        overflow:hidden;
    }
</style>

<div id='slide'>
    <div id="img-slide" class="sliderContainer" style='width:580px'>
        <div id="HomeSlide" class="royalSlider rsMinW">
            <?php foreach ($slide_list as $row):?>
                <a href="<?php echo $row->link;?>" target='_blank'><img src="<?php echo base_url();?>/upload/slide/<?php echo $row->image_link;?>" alt="<?php echo $row->name;?>" />
                </a>
            <?php endforeach;?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear pb20"></div>
<!--Lấy sản phẩm mới-->
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Sản phẩm mới</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <?php foreach ($product_new as $row):?>
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

<!--Lấy sản phẩm mua nhiều-->

<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Sản phẩm mua nhiều</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <?php foreach ($product_buy as $row):?>
            <div class="product_item">
                <h3>
                    <a href="" title="<?php echo $row->name;?>">
                        <?php echo $row->name;?>
                    </a>
                </h3>
                <div class="product_img">
                    <a href="san-pham-Tivi-LG-520/9.html" title="Sản phẩm">
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
                    <p style="float:left;margin-left:10px">Lượt mua: <b> <?php echo $row->buyed;?></b></p>
                    <a class="button" href="them-vao-gio-9.html" title="Mua ngay">Mua ngay</a>
                    <div class="clear"></div>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="clear"></div>
    </div><!-- End box-content-center -->
</div>
