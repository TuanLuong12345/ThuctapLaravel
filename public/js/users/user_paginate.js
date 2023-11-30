function updateItemsPerPage() {
    var itemsPerPage = document.getElementById("itemsPerPage").value;
    var currentUrl = window.location.href;

    // Sử dụng URLSearchParams để thay đổi tham số itemsPerPage trong URL
    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set("itemsPerPage", itemsPerPage);
    var newUrl = currentUrl.split('?')[0] + '?' + searchParams.toString();
    window.location.href = newUrl;
}
