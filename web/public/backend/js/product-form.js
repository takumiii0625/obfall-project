function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const serviceSelect = document.getElementById('service_flg');
    const priceBlock = document.getElementById('priceBlock');

    if (!serviceSelect || !priceBlock) return; // 要素がなければ何もしない

    function togglePriceVisibility() {
        priceBlock.style.display = serviceSelect.value === '0' ? '' : 'none';
    }

    togglePriceVisibility();
    serviceSelect.addEventListener('change', togglePriceVisibility);
});

// 削除確認のポップアップ表示
window.confirmDelete = function () {
    return confirm('本当に削除しますか？');
}

document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleNewsBtn');
    let expanded = false;

    // ✅ ボタンが存在する場合のみ処理を続ける
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const newsItems = document.querySelectorAll('.news-item');

            if (!expanded) {
                // もっと見る → 全表示
                newsItems.forEach(el => el.classList.remove('d-none'));
                toggleBtn.textContent = '閉じる';
                expanded = true;
            } else {
                // 閉じる → 最初の3件だけ表示
                newsItems.forEach((el, index) => {
                    el.classList.toggle('d-none', index >= 3);
                });
                toggleBtn.textContent = 'もっと見る >';
                expanded = false;
            }
        });
    }
});

