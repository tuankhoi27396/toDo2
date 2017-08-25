<style>

    table, th, td {
        border: 1px solid gainsboro;
    }
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
        <h2>Thông tin thành viên</h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <table>
            <tr>
                <td>Họ tên:</td>
                <td><?php echo $user->name;?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $user->email;?></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td><?php echo $user->phone;?></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><?php echo $user->address;?></td>
            </tr>
            <tr>
                <td colspan="2"><a style="height: 20px;padding-bottom: 1px" href="<?php echo base_url('user/edit')?>" class="button"> Sửa thông tin</a></td>
            </tr>
        </table>
    </div>
</div>