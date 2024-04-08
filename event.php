<?php require_once "head.php" ?>
<div class="eventDetails loadingData">
    <img src="https://placehold.co/1920x400/png" alt="">
    <div class="eventContent">
        <div class="eventInformation">
            <h1>Etkinlik İsmi...</h1>
            <p>Etkinlik Tarihi ve Yer...</p>
            <p>Kategori...</p>
            <p>Bilet Durumu...</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p>Etkinlik Bağlantısı...</p>
            <form action="">
                <h2>
                    Etkinlik Hakkında
                </h2>
                <textarea name="" id="" placeholder="hislerinizi ve beklentileriniz girebilirsiniz..."></textarea>
                <button type="button" onclick="window.location.reload()">gönder</button>
            </form>
            <div class="comments">
                <ul>
                    <li>
                        <p><b>John Doe:</b></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </li>
                    <li>
                        <p><b>Jane Doe:</b></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </li>
                    <li>
                        <p><b>John Doe:</b></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </li>
                    <li>
                        <p><b>Jane Doe:</b></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="image-gallery">
        </div>
    </div>
</div>

</body>
<script>
    eventID = <?php echo "'{$_GET['id']}'" ?? "null";
                echo "\n"; ?>
</script>
<script src="assets/scriptEvent.js"></script>

</html>