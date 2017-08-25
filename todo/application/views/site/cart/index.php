<style>

    table {
        border-collapse: collapse;
        width: 95%;
    }

    th {
        text-align: left;
    }


    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    tr:hover {background-color: #f5f5f5}
    tr:nth-child(even) {background-color: #f2f2f2}
    th {
        background-color: #003399;
        color: white;
    }
    .button {
        padding: 15px 40px;
        font-size: 20px;
        text-align: center;
        cursor: pointer;
        outline: none;
        color: #00a0dc;
        background-color: #893f3f;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
        height: 30px;
    }
    .button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
    .button:hover {background-color: #3e8e41}

</style>
<!--Lấy sản phẩm mới-->
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin giỏ hàng (có <?php echo $total_items;?> sản phẩm)</h2>
    </div>
    <?php if($total_items>0):?>
    <div class="box-content-center product">
        <form action="<?php echo base_url('cart/update');?>" method="post">
        <table id="cart_content" cellpadding="0" cellspacing="0" style="text-align: left;">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                    <th>Tổng số</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_amount=0;?>
                <?php foreach ($carts as $row):?>
                    <?php $total_amount=$total_amount+$row['subtotal'];?>
                <tr>
                    <td>
                        <?php echo $row['name'];?>
                    </td>
                    <td>
                        <?php echo number_format($row['price']);?>
                    </td>
                    <td>
                        <input size="5" name="qty_<?php echo $row['id']?>" value=" <?php echo $row['qty'];?> ">
                    </td>
                    <td>
                        <?php echo number_format($row['subtotal']);?>
                    </td>
                    <td>
                        <a style="color: #003399;" href="<?php echo base_url('cart/del/'.$row['id'])?>">Xóa</a>
                    </td>
                </tr>

                <?php endforeach;?>

                <tr>
                    <td colspan="5">
                        Tổng số tiền thanh toán: <b style="color: red;"><?php echo number_format($total_amount);?> đ</b>
                        - <a style="color: #003399;" href="<?php echo base_url('cart/del')?>">Xóa toàn bộ</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <button class="button"''type="submit">Cập nhật</button>
                        <a href="<?php echo base_url('order/check_out');?>" class="button">Mua hàng</a>
                    </td>
                </tr>
        </form>
        <?php else:?>
            <br><br><h4 style="margin-left: 20px;padding-top: 20px;color: red;">Không có sản phẩm nào trong giỏ hàng</h4>
        <?php endif;?>
            </tbody>
        </table>
    </div>
</div>