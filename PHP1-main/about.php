<?php require('layout/header.php') ?>

<main>
    <style>
        main {
            font-family: "Encode Sans SC", sans-serif;
            padding: 20px; /* Thêm padding cho phần nội dung chính */
        }

        .container {
            max-width: 1200px; /* Giới hạn chiều rộng của container */
            margin: 0 auto; /* Canh giữa container */
        }

        .row {
            margin-bottom: 30px; /* Khoảng cách giữa các hàng */
        }

        .row h3 {
            font-size: 24px; /* Kích thước tiêu đề */
            margin-bottom: 10px; /* Khoảng cách giữa tiêu đề và nội dung */
        }

        .row p {
            font-size: 16px; /* Kích thước văn bản */
            line-height: 1.6; /* Độ cao dòng */
        }

        .row img {
            max-width: 100%; /* Ảnh tự động điều chỉnh kích thước */
            height: auto; /* Chống biến dạng ảnh */
            display: block; /* Đảm bảo ảnh hiển thị dưới dạng block */
            margin-bottom: 20px; /* Khoảng cách dưới của ảnh */
            border-radius: 8px; /* Bo góc cho ảnh */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho ảnh */
        }

        iframe {
            max-width: 100%; /* Đảm bảo iframe phản ánh kích thước tối đa */
            display: block; /* Đảm bảo iframe hiển thị dưới dạng block */
            margin-bottom: 20px; /* Khoảng cách dưới của iframe */
            border-radius: 8px; /* Bo góc cho iframe */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho iframe */
        }
    </style>

    <div class="container">
        <div id="ant-layout">
            <section class="search-quan">
                <i class="fas fa-search"></i>
                <form action="thucdon.php" method="GET">
                    <input name="search" type="text" placeholder="Tìm món hoặc thức ăn">
                </form>
            </section>
            <section class="main">
                <div class="row">
                    <h3>Ý nghĩa tiệm bánh thơm ngon này là gì?</h3>
                    <p>Tại tiệm bánh này, chúng tôi hiểu rằng một bữa ăn ngon có thể mang lại cho bạn sức khoẻ và tinh thần thoải mái nhất. Vì vậy, tiệm bánh chúng tôi cho ra mắt dịch vụ bán hàng trực tuyến, nhằm phục vụ các món ngon tại quán với tất cả mọi người. Bạn chỉ cần đặt món ăn yêu thích trên cửa hàng trực tuyến, đội ngũ giao hàng của chúng tôi sẽ nhanh chóng mang đến cho bạn bữa ăn nóng hổi và ngon lành.</p>
                </div>
                <div class="row">
                    <h3>Tiệm bánh thơm ngon này hoạt động như thế nào?</h3>
                    <p>Tiệm bánh hoạt động từ 7h đến 22h hằng ngày, tuỳ theo khu vực của bạn và thời gian mở cửa cụ thể của từng nhà hàng, quán ăn.</p>
                </div>
                <div class="row">
                    <img src="images/bg/GrabFood.jpg" alt="">
                    <h3>Những địa chỉ giới hạn dưới 5km trong khu vực tiệm bánh ,chúng tôi sẽ giao hàng qua miễn phí</h3>
                    <p>Để xem danh sách các tiệm bánh chi nhánh khác, bạn chỉ cần nhập địa chỉ của mình trên ứng dụng. Để đảm bảo đồ ăn nóng hổi, tươi ngon và được giao đến bạn nhanh chóng, Tiệm bánh thơm ngon sẽ quét vị trí của bạn và gợi ý danh sách các chi nhánh ở gần vị trí bạn nhất.</p>
                </div>
                <div class="row">
                    <h3>Tôi có thể thanh toán bằng tiền mặt không?</h3>
                    <p>Có nhé!</p>
                </div>
                <div class="row">
                    <h3>Tôi có thể thanh toán bằng GrabPay không?</h3>
                    <p>Hiện tại bạn chưa thể thanh toán GrabFood bằng GrabPay. Chúng tôi đang cố gắng để áp dụng phương thức thanh toán này cho dịch vụ trong thời gian sớm nhất</p>
                </div>
                <div class="row">
                    <h3>Chi phí được tính như thế nào?</h3>
                    <p>Chi phí hiển thị trên ứng dụng bao gồm chi phí của phần ăn theo đơn giá của nhà hàng và phí vận chuyển.</p>
                </div>
                <div class="row">
                    <h3>Tôi có thể đặt giao nhận những món ăn nào qua Tiệm bánh thơm ngon?</h3>
                    <p>Danh sách đa dạng các món ăn của chúng tôi bao gồm: món Việt, Tây, Á, món theo phong cách Fusion,… có thể phục vụ cho mọi nhu cầu ăn uống của bạn.</p>
                </div>
                <div class="row">
                    <h3>Tôi có thể tìm thấy những nhà hàng, quán ăn nào trong khu vực của mình?</h3>
                    <p>Danh sách tiệm bánh thơm ngon, các chi nhánh tiệm bánh được sắp xếp dựa theo khoảng cách và thời gian giao hàng dự kiến từ Địa chỉ giao thức ăn đến vị trí của bạn.</p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.280539447332!2d107.29400661486774!3d16.762712588455788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x80f122cab2275a42!2zTmd1eeG7hW4gxJDEg25nIFRow6BuaA!5e0!3m2!1svi!2s!4v1629007864673!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/jJoFCFcJHsI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </section>
        </div>
    </div>
</main>

<?php require('layout/footer.php') ?>
