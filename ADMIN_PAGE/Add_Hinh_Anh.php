<?php
require_once '../config.php';
require_once './component/header.php';
require_once './component/slidebar.php';
require_once './ControllerHinhAnh.php';

$maDM = $_GET['maDM'] ?? ''; // Nếu "maDM" không tồn tại, gán giá trị mặc định là ''

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maSP = isset($_POST['maSP']) ? $_POST['maSP'] : '';
    $duongDan  = isset($_FILES['userfile']) ? $_FILES['userfile']['name'] : '';

    echo $maSP;
    for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {
        $f1 = $_FILES['userfile']['name'][$i];
        echo "</pre>";
        var_dump($f1);
    }
    exit;
}
?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-12">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Thêm Ảnh</h3>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="bank-inner-details">
                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <!-- Mã Sản Phẩm: -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Mã Sản Phẩm<span class="text-danger">*</span></label>
                                            <?php if ($maDM == null) { ?>
                                                <!-- <input type="text" readonly class="form-control" value="<?php // htmlspecialchars($maDM)
                                                                                                                ?>"> -->
                                                <input name="maSP" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                                <datalist id="datalistOptions">
                                                    <?php
                                                    $allSP = getAllSP();
                                                    foreach ($allSP as $sp) {
                                                        echo "<option value='" . $sp['tenSP'] . "'>";
                                                    }
                                                    ?>
                                                </datalist>
                                            <?php } else { ?>
                                                <input name="maSP" type="text" readonly class="form-control" value="<?= htmlspecialchars($maSP) ?>">
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- Upload Hình Ảnh -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Hình Ảnh</label>
                                            <div class="change-photo-btn">
                                                <div>
                                                    <p>Thêm Hình Ảnh</p>
                                                </div>
                                                <!-- Input file -->
                                                <input class="upload" name="userfile[]" type="file" id="fileInput" accept="image/*" multiple>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- Khu vực hiển thị ảnh -->
                                    <div class="preview-container" id="previewContainer"></div>

                                    <!-- Modal -->
                                    <div class="modal" id="modal">
                                        <div class="modal-content">
                                            <!-- Nút đóng modal -->
                                            <button class="close-btn" id="closeModal">&times;</button>
                                            <img id="modalImage" src="" alt="Image Preview">
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class=" blog-categories-btn pt-0">
                        <div class="bank-details-btn ">
                            <input type="submit" class="btn bank-cancel-btn me-2">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');

    // Khi người dùng chọn tệp ảnh
    fileInput.addEventListener('change', function(event) {
        previewContainer.innerHTML = ''; // Xóa nội dung cũ trong container
        const files = event.target.files;

        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const fileURL = URL.createObjectURL(file);

                const wrapper = document.createElement('div');
                wrapper.classList.add('image-wrapper');

                const img = document.createElement('img');
                img.src = fileURL;
                img.alt = file.name;

                const removeBtn = document.createElement('button');
                removeBtn.classList.add('remove-btn');
                removeBtn.innerText = 'X';

                // Lắng nghe sự kiện khi nhấn vào nút xóa
                removeBtn.addEventListener('click', function() {
                    try {
                        previewContainer.removeChild(wrapper);
                        removeFileFromInput(index);
                    } catch (error) {
                        console.error('Có lỗi khi xóa ảnh:', error);
                    }
                });

                // Lắng nghe sự kiện click vào ảnh để mở modal
                img.addEventListener('click', function() {
                    modal.classList.add('show'); // Thêm class để hiển thị modal
                    modalImage.src = fileURL; // Gán ảnh vào modal
                    modalImage.classList.remove('zoom-in'); // Đảm bảo không có zoom trước
                    setTimeout(() => {
                        modalImage.classList.add('zoom-in'); // Thêm lớp zoom-in để phóng to ảnh
                    }, 50); // Dùng setTimeout để tránh conflict với trạng thái ban đầu
                });

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            } else {
                alert('Vui lòng chỉ chọn các tệp hình ảnh!');
            }
        });
    });

    // Hàm xóa tệp khỏi input file
    function removeFileFromInput(index) {
        try {
            const dt = new DataTransfer(); // Khởi tạo một DataTransfer mới
            const files = fileInput.files;

            // Thêm tất cả các file còn lại vào DataTransfer, bỏ qua tệp bị xóa
            Array.from(files).forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file); // Thêm tệp không bị xóa vào DataTransfer
                }
            });

            // Cập nhật lại files cho input
            fileInput.files = dt.files;

            console.log('Danh sách tệp sau khi xóa:', fileInput.files);
        } catch (error) {
            console.error('Có lỗi khi xóa tệp khỏi input:', error);
        }
    }


    // Đóng modal khi nhấn nút đóng hoặc click ra ngoài modal
    closeModal.addEventListener('click', function() {
        modal.classList.remove('show'); // Ẩn modal
        modalImage.classList.remove('zoom-in'); // Loại bỏ zoom-out khi đóng modal
    });

    modal.addEventListener('click', function(event) {
        if (event.target === modal) { // Nếu click ra ngoài hình ảnh (nền)
            modal.classList.remove('show'); // Ẩn modal
            modalImage.classList.remove('zoom-in'); // Loại bỏ zoom-out khi đóng modal
        }
    });
</script>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/ckeditor.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script src="assets/js/script.js"></script>

<style>
    body {
        position: relative;
    }

    /* Các kiểu cho preview và nút xóa */
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .image-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        /* Thêm con trỏ pointer khi hover vào ảnh */
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: none;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .image-wrapper:hover .remove-btn {
        display: flex;
        /* Hiển thị nút xóa khi rê chuột vào */
    }

    .remove-btn:hover {
        background-color: darkred;
        transform: scale(1.2);
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Nền mờ */
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Đảm bảo modal luôn hiển thị trên tất cả các phần tử */
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        /* Thêm hiệu ứng mờ dần */
    }

    .modal.show {
        display: flex;
        opacity: 1;
        transform: translateY(0);
    }

    .modal img {
        max-width: 50%;
        max-height: 50%;
        object-fit: contain;
        transition: transform 0.3s ease;
        /* Thêm hiệu ứng zoom */
    }

    .modal-content {
        /* position: relative; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: white;
        color: black;
        border: none;
        font-size: 30px;
        cursor: pointer;
        border-radius: 50%;
        padding: 8px;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Hiệu ứng hover cho nút đóng */
    .close-btn:hover {
        background-color: #f1f1f1;
        transform: scale(1.1);
    }

    /* Hiệu ứng zoom cho hình ảnh trong modal */
    .modal img.zoom-in {
        transform: scale(1.5);
        /* Phóng to ảnh */
    }
</style>
</body>

</html>