<style>
    .select {
        color: #25396f;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0);
        outline: none;
        margin-bottom: 10px;
        font-size: 16px;
        height: 30px;
        width: 400px;
        outline-style: none;
        border: none;
        font-weight: bold;
    }

    .select::-ms-expand {
        display:block;
    }
</style>
<div class="table-responsive ">
    <table class="table mb-0 table-danger table-exam" id="title-thongke">
        <thead>
            <tr>
                <th>Mã sinh viên</th>
                <th>Họ tên sinh viên</th>
                <th>Điểm trung bình</th>
                <th>Xếp loại</th>
            </tr>
        </thead>
        <tbody id="row-thongke">
        </tbody>
    </table>
    <table class="table mb-0 table-danger table-exam" id="title-sinhvien">
        <thead>
            <tr>
                <th>Mã môn</th>
                <th>Tên môn</th>
                <th>Điểm thi</th>
                <th>Xếp loại</th>
            </tr>
        </thead>
        <tbody id="row-sinhvien">
        </tbody>
    </table>
    <table class="table mb-0 table-danger table-exam" id="title-mon">
        <thead>
            <tr>
                <th>Mã sinh viên</th>
                <th>Họ tên sinh viên</th>
                <th>Mã đề</th>
                <th>Điểm thi</th>
                <th>Xếp loại</th>
            </tr>
        </thead>
        <tbody id="row-mon">
        </tbody>
    </table>
    <nav class="mt-5">
        <ul id="pagination" class="pagination justify-content-center">
        </ul>
    </nav>
</div>