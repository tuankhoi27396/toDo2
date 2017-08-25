<!--Thay đổi thông tin user-->
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin nhận hàng của thành viên</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <div class="box-content-center register"><!-- The box-content-center -->
            <h1 style="color: red">Thông tin người nhận</h1>
            <form enctype="multipart/form-data" action="<?php echo base_url('order/check_out')?>" method="post" class="t-form form_action">

                <div class="form-row">
                    <label class="form-label" for="param_cost">Tổng số tiền cần thanh toán:</label>
                    <div class="form-item">
                        <b style="color: red" ><?php echo $total_amount;?> đ</b>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="form-row">
                    <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
                    <div class="form-item">
                        <input value="<?php echo isset($user->email) ? $user->email : '';?>" name="email" id="email" class="input" type="text">
                        <div class="clear"></div>
                        <div id="email_error" class="error"><?php echo form_error('email');?></div>
                    </div>
                    <div class="clear"></div>
                </div>


                <div class="form-row">
                    <label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
                    <div class="form-item">
                        <input value="<?php echo isset($user->name) ?$user->name : '';?>" name="name" id="name" class="input" type="text">
                        <div class="clear"></div>
                        <div id="name_error" class="error"><?php echo form_error('name');?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-row">
                    <label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                    <div class="form-item">
                        <input value="<?php echo isset($user->phone) ? $user->phone : '';?>" name="phone" id="phone" class="input" type="text">
                        <div class="clear"></div>
                        <div id="phone_error" class="error"><?php echo form_error('phone');?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="form-row">
                    <label class="form-label" for="param_message">ghi chú:<span class="req">*</span></label>
                    <div class="form-item">
                        <p>Nhập địa chỉ và thời gian nhận hàng</p>
                        <textarea name="message" id="message" class="input" ></textarea>
                        <div class="clear"></div>
                        <div id="message_error" class="error"><?php echo form_error('message');?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="form-row">
                    <label class="form-label" for="param_payment">Thanh toán qua:<span class="req">*</span></label>
                    <div class="form-item">
                        <select name="payment">
                            <option value="">--------Cổng thanh toán--------</option>
                            <option value="nganluong">Ngân lượng</option>
                            <option value="baokim">Bảo kim</option>
                            <option value="offline">Thanh toán tại nhà</option>
                        </select>
                        <div class="clear"></div>
                        <div id="payment_error" class="error"><?php echo form_error('payment');?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="form-row">
                    <label class="form-label">&nbsp;</label>
                    <div class="form-item">
                        <input name="submit" value="Thanh toán" class="button" type="submit">
                    </div>
                </div>
            </form>
        </div>

        <div class="clear"></div>
    </div><!-- End box-content-center -->
</div>

